<?php

namespace App\Http\Controllers;

use App\Models\AdminNote;
use App\Models\Student;
use App\Models\Transaction;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard(Request $request): View
    {
        $title = 'SPPku - Halaman Admin';
        $schoolYear = '2026/2027';
        [$startYear, $endYear] = array_map('intval', explode('/', $schoolYear));

        // Buat opsi periode Jul-Des (2026) & Jan-Jun (2027)
        $periodOptions = [];
        foreach ([...range(7, 12), ...range(1, 6)] as $m) {
            $y = $m >= 7 ? $startYear : $endYear;
            $periodOptions[sprintf('%04d-%02d', $y, $m)] = Carbon::create($y, $m, 1)->translatedFormat('F Y');
        }

        $selectedPeriod = array_key_exists((string) $request->query('period'), $periodOptions)
            ? $request->query('period')
            : (array_key_exists(now()->format('Y-m'), $periodOptions) ? now()->format('Y-m') : array_key_first($periodOptions));

        [$calendarYear, $selectedMonth] = array_map('intval', explode('-', $selectedPeriod));
        $selectedPeriodLabel = $periodOptions[$selectedPeriod];

        $baseQuery = Student::where('school_year', $schoolYear);

        // Statistik kartu atas (berdasarkan seluruh siswa tahun ajaran aktif)
        $totalStudents = (clone $baseQuery)->count();
        $paidStudents = (clone $baseQuery)->whereHas('bills', fn($q) => $q->where('month', $selectedMonth)->where('school_year', $schoolYear)->whereYear('due_date', $calendarYear)->where('status', 'paid'))->count();
        $unpaidStudents = (clone $baseQuery)->whereHas('bills', fn($q) => $q->where('month', $selectedMonth)->where('school_year', $schoolYear)->whereYear('due_date', $calendarYear)->whereIn('status', ['unpaid', 'overdue']))->count();

        // Terapkan filter SEBELUM paginate()
        $search = trim((string) $request->query('search', ''));
        $status = trim((string) $request->query('status', ''));
        $grade = trim((string) $request->query('grade', ''));

        $studentsQuery = (clone $baseQuery)
            ->when($search !== '', function ($q) use ($search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('nisn', 'like', "{$search}%")
                        ->orWhereHas('user', function ($u) use ($search) {
                            $u->where('name', 'like', "{$search}%")
                                ->orWhere('name', 'like', "% {$search}%");
                        });
                });
            })
            ->when(in_array($grade, ['10', '11', '12'], true), fn($q) => $q->where('class', 'like', "{$grade} %"))
            ->when(in_array($status, ['paid', 'unpaid', 'overdue'], true), function ($q) use ($status, $selectedMonth, $calendarYear) {
                $q->whereHas('bills', function ($bq) use ($status, $selectedMonth, $calendarYear) {
                    $bq->where('month', $selectedMonth)->whereYear('due_date', $calendarYear);
                    match ($status) {
                        'paid' => $bq->where('status', 'paid'),
                        'overdue' => $bq->where(fn($sub) => $sub->where('status', 'overdue')->orWhere(fn($s) => $s->where('status', 'unpaid')->whereDate('due_date', '<', today()))),
                        'unpaid' => $bq->where('status', 'unpaid')->whereDate('due_date', '>=', today()),
                    };
                });
            });

        $students = $studentsQuery->with(['user:id,name', 'bills'])->paginate(10)->withQueryString();
        $firstNumber = $students->firstItem() ?? 1;

        $students->through(function ($student, $index) use ($selectedMonth, $schoolYear, $calendarYear, $firstNumber) {
            $bills = $student->bills->where('month', $selectedMonth)->where('school_year', $schoolYear)->filter(fn($b) => $b->due_date?->year === $calendarYear);
            $unpaid = $bills->whereIn('status', ['unpaid', 'overdue']);
            $isOverdue = $unpaid->contains(fn($b) => $b->status === 'overdue' || ($b->due_date?->isBefore(today()) ?? false));

            return [
                'number' => $firstNumber + $index,
                'id' => $student->id,
                'name' => $student->user->name ?? '-',
                'class' => $student->class,
                'tuition' => $bills->isEmpty() ? '-' : 'Rp. ' . number_format($bills->sum('amount'), 0, ',', '.'),
                'status' => match (true) {
                    $bills->isEmpty() => 'Belum Ada Tagihan',
                    $isOverdue => 'Terlambat',
                    $unpaid->isNotEmpty() => 'Belum Lunas',
                    default => 'Lunas',
                },
            ];
        });

        return view('admin.dashboard', compact(
            'title',
            'students',
            'schoolYear',
            'periodOptions',
            'selectedPeriod',
            'selectedPeriodLabel',
            'selectedMonth',
            'totalStudents',
            'paidStudents',
            'unpaidStudents',
        ));
    }

    public function payments(Request $request): View
    {
        $title = 'SPPku - Halaman Laporan Pembayaran Admin';

        $search = trim((string) $request->query('search', ''));
        $class = trim((string) $request->query('class', ''));
        $status = trim((string) $request->query('status', ''));
        $month = trim((string) $request->query('month', ''));

        $query = Transaction::with(['user.student'])
            ->orderByRaw("CASE status WHEN 'pending' THEN 1 WHEN 'rejected' THEN 2 WHEN 'verified' THEN 3 ELSE 4 END")
            ->latest('transaction_date');

        // 1. Filter Pencarian Awal Nama (Depan/Belakang) atau Awal NISN
        if ($search !== '') {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where(function ($nameQuery) use ($search) {
                    $nameQuery->where('name', 'like', "{$search}%")
                        ->orWhere('name', 'like', "% {$search}%");
                })->orWhereHas('student', function ($sq) use ($search) {
                    $sq->where('nisn', 'like', "{$search}%");
                });
            });
        }

        // 2. Filter Kelas Siswa
        if ($class !== '') {
            $query->whereHas('user.student', function ($q) use ($class) {
                $q->where('class', $class);
            });
        }

        // 3. Filter Status Transaksi (verified / pending / rejected)
        if (in_array($status, ['verified', 'pending', 'rejected'], true)) {
            $query->where('status', $status);
        }

        // 4. Filter Bulan & Tahun (format: YYYY-MM, misal 2026-09)
        if (preg_match('/^(\d{4})-(\d{2})$/', $month, $matches)) {
            $query->whereYear('transaction_date', (int) $matches[1])
                ->whereMonth('transaction_date', (int) $matches[2]);
        }

        $payments = $query->paginate(10)->withQueryString();

        $stats = [
            ['title' => 'Menunggu Verifikasi', 'count' => Transaction::where('status', 'pending')->count(), 'icon' => 'pending.png'],
            ['title' => 'Terverifikasi', 'count' => Transaction::where('status', 'verified')->count(), 'icon' => 'verified.png'],
            ['title' => 'Ditolak', 'count' => Transaction::where('status', 'rejected')->count(), 'icon' => 'rejected.png'],
            ['title' => 'Total Bulan Ini', 'count' => Transaction::whereMonth('transaction_date', now()->month)->whereYear('transaction_date', now()->year)->count(), 'icon' => 'total.png'],
        ];

        $selectedId = $request->query('selected');
        $selectedPayment = $selectedId
            ? Transaction::with(['user.student'])->find($selectedId)
            : $payments->first();

        return view('admin.payment-view', compact('title', 'payments', 'stats', 'selectedPayment'));
    }

    public function verifyPayment(Request $request, $id): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:verified,rejected',
            'note' => 'nullable|string|max:500',
        ]);

        $payment = Transaction::with('user.student')->findOrFail($id);

        $payment->update([
            'status' => $validated['status'],
            'note' => $validated['note'] ?? null,
            'verified_at' => $validated['status'] === 'verified' ? now() : null,
        ]);

        // Jika di-ACC, otomatis lunasi tagihan SPP siswa yang masih unpaid/overdue
        if ($validated['status'] === 'verified' && $payment->user?->student) {
            if ($payment->bill_id) {
                $payment->user->student->bills()
                    ->where('id', $payment->bill_id)
                    ->update(['status' => 'paid']);
            } else {
                $bill = $payment->user->student->bills()
                    ->whereIn('status', ['unpaid', 'overdue'])
                    ->orderBy('due_date')
                    ->first();

                if ($bill) {
                    $bill->update(['status' => 'paid']);
                }
            }
        }

        $pesan = $validated['status'] === 'verified'
            ? 'Pembayaran atas nama ' . ($payment->user->name ?? 'siswa') . ' berhasil DISETUJUI dan tagihan siswa telah dilunasi.'
            : 'Pembayaran atas nama ' . ($payment->user->name ?? 'siswa') . ' telah DITOLAK.';

        return back()->with('success', $pesan);
    }

    public function notification(Request $request): View
    {
        $title = 'SPPku - Notifikasi Pembayaran Siswa';
        $status = trim((string) $request->query('status', ''));

        $query = Transaction::with(['user.student'])
            ->orderByRaw("CASE status WHEN 'pending' THEN 1 WHEN 'rejected' THEN 2 WHEN 'verified' THEN 3 ELSE 4 END")
            ->latest('transaction_date');

        if (in_array($status, ['pending', 'verified', 'rejected'], true)) {
            $query->where('status', $status);
        }

        $notifications = $query->paginate(10)->withQueryString();

        return view('admin.notification-view', compact('title', 'notifications'));
    }

    public function show(): View
    {
        $title = 'SPPku - Halaman Profile Admin';

        $admin = [
            'name' => 'Rayson Velnoc',
            'username' => 'Ray_Velnoc',
            'phone' => '0899 9099 9909',
            'email' => 'rayson_V@ski.sch.id',
            'account_status' => 'Aktif',
            'admin_id' => 'ADM001',
            'position' => 'Staff Administrasi',
            'institution' => 'SMK Kristen Immanuel',
        ];

        // Ambil catatan terbaru dari DB, dikelompokkan berdasarkan tanggal (terbaru di atas)
        $groupedNotes = AdminNote::where('user_id', Auth::id())
            ->latest()
            ->get()
            ->groupBy(fn($note) => $note->created_at->translatedFormat('j/M/Y'));

        return view('admin.show', compact('title', 'admin', 'groupedNotes'));
    }

    public function storeNote(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'content' => 'required|string|max:500',
        ]);

        AdminNote::create([
            'user_id' => Auth::id(),
            'content' => trim($validated['content']),
        ]);

        return back()->with('success', 'Catatan pribadi berhasil ditambahkan.');
    }

    public function destroyNote(int $id): RedirectResponse
    {
        $note = AdminNote::where('user_id', Auth::id())->findOrFail($id);
        $note->delete();

        return back()->with('success', 'Catatan pribadi berhasil dihapus.');
    }

    public function reports(): View
    {
        $title = 'SPPku - Halaman Laporan Keuangan Admin';

        return view('admin.report-view', compact('title'));
    }
}