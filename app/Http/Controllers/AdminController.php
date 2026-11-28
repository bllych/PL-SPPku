<?php

namespace App\Http\Controllers;

use App\Models\AdminNote;
use App\Models\Student;
use App\Models\Transaction;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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

        // Cari bulan terakhir yang punya data tagihan di database sebagai fallback jika bulan ini kosong
        $latestBillMonth = \App\Models\Bill::where('school_year', $schoolYear)
            ->orderByRaw('CASE WHEN month >= 7 THEN month - 6 ELSE month + 6 END DESC')
            ->value('month');

        $fallbackPeriod = $latestBillMonth
            ? sprintf('%04d-%02d', $latestBillMonth >= 7 ? $startYear : $endYear, $latestBillMonth)
            : array_key_first($periodOptions);

        $currentYm = now()->format('Y-m');
        $hasCurrentMonthBills = \App\Models\Bill::where('school_year', $schoolYear)
            ->where('month', now()->month)
            ->exists();

        $defaultPeriod = ($hasCurrentMonthBills && array_key_exists($currentYm, $periodOptions))
            ? $currentYm
            : $fallbackPeriod;

        $selectedPeriod = array_key_exists((string) $request->query('period'), $periodOptions)
            ? $request->query('period')
            : $defaultPeriod;

        [$calendarYear, $selectedMonth] = array_map('intval', explode('-', $selectedPeriod));
        $selectedPeriodLabel = $periodOptions[$selectedPeriod];

        $baseQuery = Student::where('school_year', $schoolYear);

        // Statistik kartu atas (cukup cocokkan month & school_year)
        $totalStudents = (clone $baseQuery)->count();
        $paidStudents = (clone $baseQuery)->whereHas(
            'bills',
            fn($q) => $q
                ->where('month', $selectedMonth)
                ->where('school_year', $schoolYear)
                ->where('status', 'paid')
        )->count();

        $unpaidStudents = (clone $baseQuery)->whereHas(
            'bills',
            fn($q) => $q
                ->where('month', $selectedMonth)
                ->where('school_year', $schoolYear)
                ->whereIn('status', ['unpaid', 'overdue'])
        )->count();

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
            ->when(in_array($status, ['paid', 'unpaid', 'overdue'], true), function ($q) use ($status, $selectedMonth, $schoolYear) {
                $q->whereHas('bills', function ($bq) use ($status, $selectedMonth, $schoolYear) {
                    $bq->where('month', $selectedMonth)->where('school_year', $schoolYear);
                    match ($status) {
                        'paid' => $bq->where('status', 'paid'),
                        'overdue' => $bq->where(fn($sub) => $sub->where('status', 'overdue')->orWhere(fn($s) => $s->where('status', 'unpaid')->whereDate('due_date', '<', today()))),
                        'unpaid' => $bq->where('status', 'unpaid')->where(fn($s) => $s->whereNull('due_date')->orWhereDate('due_date', '>=', today())),
                    };
                });
            });

        $students = $studentsQuery->with(['user:id,name', 'bills'])->paginate(10)->withQueryString();
        $firstNumber = $students->firstItem() ?? 1;

        $students->through(function ($student, $index) use ($selectedMonth, $schoolYear, $firstNumber) {
            $bills = $student->bills
                ->where('month', $selectedMonth)
                ->where('school_year', $schoolYear);

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

    public function sendReminders(Request $request): RedirectResponse
    {
        $schoolYear = '2026/2027';
        $period = (string) $request->input('period', now()->format('Y-m'));

        if (!preg_match('/^(\d{4})-(\d{2})$/', $period, $matches)) {
            $year = now()->year;
            $month = now()->month;
        } else {
            $year = (int) $matches[1];
            $month = (int) $matches[2];
        }

        $monthLabel = Carbon::create($year, $month, 1)->translatedFormat('F Y');

        $targetBills = \App\Models\Bill::where('school_year', $schoolYear)
            ->where('month', $month)
            ->whereIn('status', ['unpaid', 'overdue'])
            ->get();

        if ($targetBills->isEmpty()) {
            return back()->with('success', "Semua siswa sudah melunasi atau belum memiliki tagihan SPP di bulan {$monthLabel}.");
        }

        // Tandai tagihan yang masih unpaid menjadi overdue agar langsung muncul sebagai pengingat di akun siswa
        \App\Models\Bill::whereIn('id', $targetBills->pluck('id'))
            ->where('status', 'unpaid')
            ->update([
                'status' => 'overdue',
                'updated_at' => now(),
            ]);

        // Sentuh updated_at pada yang sudah overdue supaya naik ke urutan teratas notifikasi siswa
        \App\Models\Bill::whereIn('id', $targetBills->pluck('id'))
            ->where('status', 'overdue')
            ->update(['updated_at' => now()]);

        return back()->with(
            'success',
            "Reminder pembayaran otomatis berhasil dikirim ke {$targetBills->count()} akun siswa untuk periode {$monthLabel}."
        );
    }

    public function reports(Request $request): View
    {
        $title = 'SPPku - Halaman Laporan Keuangan Admin';
        $schoolYear = '2026/2027';

        $availableClasses = Student::where('school_year', $schoolYear)
            ->distinct()
            ->orderBy('class')
            ->pluck('class')
            ->filter()
            ->values();

        $search = trim((string) $request->query('search', ''));
        $filterMonth = (int) $request->query('month', 0);
        $filterYear = (int) $request->query('year', 0);
        $filterClass = trim((string) $request->query('class', ''));
        $sort = trim((string) $request->query('sort', 'latest'));

        $periods = [
            ['month' => 7, 'year' => 2026],
            ['month' => 8, 'year' => 2026],
            ['month' => 9, 'year' => 2026],
        ];

        $reports = collect();

        // 1. Gabungkan file hasil Ekspor dari halaman Payments (disimpan di session)
        $exportedReports = collect($request->session()->get('exported_reports', []));
        foreach ($exportedReports as $exp) {
            $reports->push($exp);
        }

        // 2. Daftar laporan bulanan per kelas
        foreach ($periods as $p) {
            $monthAbbr = Carbon::create($p['year'], $p['month'], 1)->translatedFormat('M');
            $modifiedDate = Carbon::create($p['year'], $p['month'], 20)->format('d/M/Y');

            foreach ($availableClasses as $cls) {
                $cleanClass = str_replace(' ', '', $cls);
                $fileName = "{$cleanClass}_{$monthAbbr}_{$p['year']}.xlsx";

                // Hindari duplikat jika sudah ada di hasil ekspor session
                if ($reports->contains(fn($r) => $r['name'] === $fileName)) {
                    continue;
                }

                $reports->push([
                    'name' => $fileName,
                    'class_name' => $cls,
                    'month' => $p['month'],
                    'year' => $p['year'],
                    'modified' => $modifiedDate,
                    'timestamp' => Carbon::create($p['year'], $p['month'], 20)->timestamp,
                ]);
            }
        }

        $reports = $reports
            ->when($search !== '', fn($col) => $col->filter(fn($r) => str_contains(strtolower($r['name']), strtolower($search))))
            ->when($filterMonth >= 1 && $filterMonth <= 12, fn($col) => $col->where('month', $filterMonth))
            ->when($filterYear > 2000, fn($col) => $col->where('year', $filterYear))
            ->when($filterClass !== '', fn($col) => $col->where('class_name', $filterClass));

        $reports = match ($sort) {
            'oldest' => $reports->sortBy('timestamp')->values(),
            'name' => $reports->sortBy('name')->values(),
            default => $reports->sortByDesc('timestamp')->values(),
        };

        return view('admin.report-view', compact('title', 'reports', 'availableClasses'));
    }

    public function exportPayments(Request $request): RedirectResponse
    {
        $className = trim((string) $request->query('class', ''));
        $monthParam = trim((string) $request->query('month', ''));

        if (preg_match('/^(\d{4})-(\d{2})$/', $monthParam, $matches)) {
            $year = (int) $matches[1];
            $month = (int) $matches[2];
        } else {
            $year = 2026;
            $month = 9;
        }

        $monthAbbr = Carbon::create($year, $month, 1)->translatedFormat('M');
        $classSlug = $className !== '' ? str_replace(' ', '', $className) : 'PembayaranSPP';
        $displayFileName = "{$classSlug}_{$monthAbbr}_{$year}.xlsx";

        // Simpan ke session agar otomatis muncul sebagai card baru di halaman Reports
        $exported = $request->session()->get('exported_reports', []);
        $exported = array_values(array_filter(
            $exported,
            fn($item) => ($item['name'] ?? '') !== $displayFileName
        ));

        array_unshift($exported, [
            'name' => $displayFileName,
            'class_name' => $className,
            'month' => $month,
            'year' => $year,
            'modified' => now()->format('d/M/Y'),
            'timestamp' => now()->timestamp,
        ]);

        $request->session()->put('exported_reports', $exported);

        return back()->with(
            'success',
            "Laporan \"{$displayFileName}\" berhasil diekspor dan tersimpan ke halaman Reports."
        );
    }

    public function downloadReport(Request $request)
    {
        $schoolYear = '2026/2027';
        $className = trim((string) $request->query('class', ''));
        $month = (int) $request->query('month', now()->month);
        $year = (int) $request->query('year', now()->year);
        $customName = trim((string) $request->query('name', ''));

        $monthLabel = Carbon::create($year, $month, 1)->translatedFormat('F Y');
        $monthAbbr = Carbon::create($year, $month, 1)->translatedFormat('M');
        $classSlug = $className !== '' ? str_replace(' ', '', $className) : 'SemuaKelas';

        $filename = $customName !== ''
            ? pathinfo($customName, PATHINFO_FILENAME) . '.xls'
            : "{$classSlug}_{$monthAbbr}_{$year}.xls";

        $students = Student::with([
            'user',
            'bills' => fn($q) => $q->where('month', $month)
                ->where('school_year', $schoolYear)
                ->whereYear('due_date', $year),
            'user.transactions' => fn($q) => $q->whereMonth('transaction_date', $month)
                ->whereYear('transaction_date', $year),
        ])
            ->where('school_year', $schoolYear)
            ->when($className !== '', fn($q) => $q->where('class', $className))
            ->orderBy('class')
            ->orderBy('nisn')
            ->get();

        $rowsHtml = '';
        $totalTagihan = 0;
        $totalTerbayar = 0;

        foreach ($students as $index => $student) {
            $bill = $student->bills->first();
            $amount = $bill ? (float) $bill->amount : 0;
            $totalTagihan += $amount;

            $statusRaw = $bill?->status ?? 'none';
            $isOverdue = $bill && in_array($statusRaw, ['unpaid', 'overdue'], true) && ($bill->due_date?->isBefore(today()) ?? false);

            $statusText = match (true) {
                $statusRaw === 'paid' => 'Lunas',
                $statusRaw === 'overdue' || $isOverdue => 'Terlambat',
                $statusRaw === 'unpaid' => 'Belum Lunas',
                default => 'Belum Ada Tagihan',
            };

            if ($statusRaw === 'paid') {
                $totalTerbayar += $amount;
            }

            $trx = $student->user?->transactions?->where('status', 'verified')->first()
                ?? $student->user?->transactions?->first();

            $method = $trx?->payment_method ?? '-';
            $paidDate = $trx?->transaction_date ? $trx->transaction_date->format('d/m/Y') : '-';

            $rowsHtml .= '<tr>'
                . '<td>' . ($index + 1) . '</td>'
                . '<td style="mso-number-format:\@;">' . e($student->nisn) . '</td>'
                . '<td>' . e($student->user->name ?? '-') . '</td>'
                . '<td>' . e($student->class) . '</td>'
                . '<td>' . $amount . '</td>'
                . '<td>' . e($statusText) . '</td>'
                . '<td>' . e($method) . '</td>'
                . '<td>' . e($paidDate) . '</td>'
                . '</tr>';
        }

        $html = '<html><head><meta charset="UTF-8"></head><body>'
            . '<table border="1" cellpadding="6" cellspacing="0">'
            . '<tr><th colspan="8" style="font-size:14pt;background:#38b8ed;color:#ffffff;">LAPORAN PEMBAYARAN SPP - ' . e(strtoupper($className ?: 'SEMUA KELAS')) . ' (' . e(strtoupper($monthLabel)) . ')</th></tr>'
            . '<tr style="background:#f3f5ff;font-weight:bold;">'
            . '<th>No</th><th>NISN</th><th>Nama Siswa</th><th>Kelas</th><th>Nominal SPP (Rp)</th><th>Status Pembayaran</th><th>Metode Bayar</th><th>Tanggal Transaksi</th>'
            . '</tr>'
            . $rowsHtml
            . '<tr style="font-weight:bold;background:#eef9ff;">'
            . '<td colspan="4">TOTAL TAGIHAN / TOTAL TERBAYAR</td>'
            . '<td>' . $totalTagihan . '</td>'
            . '<td colspan="3">Terbayar: Rp ' . number_format($totalTerbayar, 0, ',', '.') . '</td>'
            . '</tr>'
            . '</table></body></html>';

        return response($html, 200, [
            'Content-Type' => 'application/vnd.ms-excel; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ]);
    }

    public function payments(Request $request): View
    {
        $title = 'SPPku - Halaman Laporan Pembayaran Admin';
        $paymentRelations = [
            'user.student',
            'bill:id,due_date',
        ];

        $search = trim((string) $request->query('search', ''));
        $class = trim((string) $request->query('class', ''));
        $status = trim((string) $request->query('status', ''));
        $month = trim((string) $request->query('month', ''));

        $query = Transaction::with($paymentRelations)
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
            ? Transaction::with($paymentRelations)->find($selectedId)
            : $payments->first();

        $selectedPaymentReceiptImage = $selectedPayment
            ? $this->paymentReceiptImage($selectedPayment)
            : null;

        return view('admin.payment-view', compact(
            'title',
            'payments',
            'stats',
            'selectedPayment',
            'selectedPaymentReceiptImage',
        ));
    }

    private function paymentReceiptImage(Transaction $payment): ?string
    {
        if ($payment->status === 'rejected') {
            return 'images/receiptInvalid.jpeg';
        }

        $dueDate = $payment->bill?->due_date;

        if ($dueDate !== null && $payment->transaction_date->toDateString() > $dueDate->toDateString()) {
            return 'images/receiptTelat.jpeg';
        }

        if ($payment->status === 'verified') {
            return 'images/receipt.png';
        }

        return null;
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
        $user = Auth::user();

        $fullName = $user?->name ?: 'Admin Keuangan';
        $generatedUsername = $user?->name
            ? Str::of($user->name)->trim()->replace(' ', '_')->title()->toString()
            : 'Admin_SPPku';

        $admin = [
            'name' => $fullName,
            'bio' => $user?->bio ?: 'Melayani administrasi keuangan siswa dengan jujur dan teliti.',
            'username' => $generatedUsername,
            'phone' => '0812 5678 9012',
            'email' => $user?->email ?: 'admin@smkkristenimmanuel.sch.id',
            'account_status' => 'Aktif',
            'admin_id' => sprintf('ADM-%03d', $user?->id ?? 1),
            'position' => 'Staff Administrasi Keuangan',
            'institution' => 'SMK Kristen Immanuel',
        ];

        $groupedNotes = AdminNote::where('user_id', Auth::id())
            ->latest()
            ->get()
            ->groupBy(fn($note) => $note->created_at->translatedFormat('j/M/Y'));

        return view('admin.show', compact('title', 'admin', 'groupedNotes'));
    }

    public function updateBio(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'bio' => 'required|string|max:150',
        ]);

        $user = Auth::user();
        $user->bio = trim($validated['bio']);
        $user->save();

        return back()->with('success', 'Bio profil berhasil diperbarui.');
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
}
