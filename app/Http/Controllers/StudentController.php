<?php

namespace App\Http\Controllers;

use App\Http\Requests\Student\StoreRequest;
use App\Models\Student;
use App\Models\Transaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function index(Request $request, int $id): View
    {
        $title = 'SPPku - Halaman Siswa';
        $student = Student::query()
            ->with('user:id,name')
            ->where('user_id', $request->user()->id)
            ->findOrFail($id);

        $monthNames = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        $currentDate = now();
        $defaultSemester = $currentDate->month >= 7 ? 'ganjil' : 'genap';
        $activeSemester = in_array($request->query('semester'), ['ganjil', 'genap'], true)
            ? $request->query('semester')
            : $defaultSemester;

        [$schoolYearStart, $schoolYearEnd] = array_pad(explode('/', $student->school_year), 2, now()->year);

        // Semua tagihan tahun ajaran aktif untuk hitung ringkasan & tentukan tagihan aktif
        $allYearBills = $student->bills()
            ->with(['transactions' => fn($q) => $q->latest('transaction_date')])
            ->where('school_year', $student->school_year)
            ->orderBy('due_date')
            ->get();

        // Tagihan aktif: tagihan bulan berjalan, atau tagihan paling awal yang belum lunas
        $activeBill = $allYearBills->first(fn($b) => $b->month === $currentDate->month && $b->due_date?->year === $currentDate->year)
            ?? $allYearBills->first(fn($b) => $b->status !== 'paid')
            ?? $allYearBills->first();

        $semesterMonths = $activeSemester === 'genap'
            ? [1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'Mei', 6 => 'Jun']
            : [7 => 'Jul', 8 => 'Agu', 9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'];

        $displayYear = $activeSemester === 'genap' ? $schoolYearEnd : $schoolYearStart;
        $semesterBills = $allYearBills->whereIn('month', array_keys($semesterMonths))->keyBy('month');

        $semesterPaymentStatuses = [];

        foreach ($semesterMonths as $month => $monthLabel) {
            $bill = $semesterBills->get($month);
            $isCurrentHighlighted = $bill !== null
                && $bill->status !== 'paid'
                && ($month === $currentDate->month || ($activeBill && $bill->id === $activeBill->id));

            $status = match (true) {
                $bill === null => 'Belum Ada Tagihan',
                $bill->status === 'paid' => 'Lunas',
                $isCurrentHighlighted => 'Tagihan Berjalan',
                $bill->status === 'overdue' || ($bill->due_date?->isBefore(today()) ?? false) => 'Terlambat',
                default => 'Belum Lunas',
            };

            $statusClass = match ($status) {
                'Lunas' => 'bg-[#45C0F4] text-white font-semibold',
                'Tagihan Berjalan' => 'bg-[#FFB83E] text-white font-semibold shadow-sm',
                'Terlambat' => 'bg-[#F43F5E] text-white font-semibold',
                'Belum Ada Tagihan' => 'border border-dashed border-gray-400 bg-white text-gray-500',
                default => 'bg-[#999999] text-white',
            };

            $semesterPaymentStatuses[] = [
                'month' => $monthLabel,
                'period' => $monthLabel . ' ' . $displayYear,
                'status' => $status,
                'class' => $statusClass,
            ];
        }

        $semesterPaidCount = $semesterBills->where('status', 'paid')->count();
        $semesterOutstandingCount = $semesterBills->where('status', '!=', 'paid')->count();

        $currentDateLabel = $currentDate->format('d') . ' ' . $monthNames[$currentDate->month] . ' ' . $currentDate->year;
        $latestTx = $activeBill?->transactions->first();

        $currentPeriod = $activeBill
            ? ($monthNames[$activeBill->month] . ' ' . $activeBill->due_date->format('Y'))
            : ($monthNames[$currentDate->month] . ' ' . $currentDate->year);

        $currentBillAmount = $activeBill
            ? 'Rp ' . number_format((float) $activeBill->amount, 0, ',', '.')
            : 'Tagihan belum tersedia';

        $currentBillDueDate = $activeBill?->due_date
            ? ($activeBill->due_date->format('d') . ' ' . $monthNames[$activeBill->due_date->month] . ' ' . $activeBill->due_date->year)
            : ('15 ' . $monthNames[$currentDate->month] . ' ' . $currentDate->year);

        $currentBillStatus = match (true) {
            $activeBill === null => 'Tidak Ada Tagihan',
            $activeBill->status === 'paid' => 'Lunas',
            $latestTx?->status === 'pending' => 'Menunggu Verifikasi Admin',
            $activeBill->status === 'overdue' || ($activeBill->due_date?->isBefore(today()) ?? false) => 'Terlambat',
            default => 'Belum Dibayar',
        };

        return view('student.index', compact(
            'title',
            'student',
            'activeSemester',
            'semesterPaymentStatuses',
            'semesterPaidCount',
            'semesterOutstandingCount',
            'activeBill',
            'currentPeriod',
            'currentBillAmount',
            'currentBillDueDate',
            'currentBillStatus',
            'currentDateLabel',
        ));
    }

    public function createPayment(Request $request, int $id): View
    {
        $title = 'SPPku - Form Pembayaran Siswa';
        $student = Student::query()
            ->with('user:id,name')
            ->where('user_id', $request->user()->id)
            ->findOrFail($id);

        $monthNames = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        $unpaidBills = $student->bills()
            ->where('school_year', $student->school_year)
            ->where('status', '!=', 'paid')
            ->orderBy('due_date')
            ->get()
            ->map(function ($bill) use ($monthNames): array {
                $year = $bill->due_date?->format('Y') ?? now()->year;
                $shortLabel = $monthNames[$bill->month] . ' ' . $year;
                $statusSuffix = $bill->status === 'overdue' ? ' (Terlambat)' : '';

                return [
                    'id' => $bill->id,
                    'short_label' => $shortLabel,
                    'label' => $shortLabel . $statusSuffix,
                    'amount_raw' => (float) $bill->amount,
                    'amount_formatted' => 'Rp ' . number_format((float) $bill->amount, 0, ',', '.'),
                    'due_date_formatted' => $bill->due_date ? $bill->due_date->format('d/m/Y') : '-',
                ];
            });

        $selectedBillId = $request->query('bill_id');

        return view('student.payment-form', compact(
            'title',
            'student',
            'unpaidBills',
            'selectedBillId',
        ));
    }

    public function storePayment(Request $request, int $id): RedirectResponse
    {
        $student = Student::query()
            ->where('user_id', $request->user()->id)
            ->findOrFail($id);

        $isCash = str_starts_with((string) $request->input('payment_method'), 'Tunai');

        $validated = $request->validate([
            'bill_ids' => ['required', 'array', 'min:1'],
            'bill_ids.*' => ['integer'],
            'payment_method' => ['required', 'string', 'max:100'],
            'proof_image' => [$isCash ? 'nullable' : 'required', 'image', 'max:2048'],
        ], [
            'bill_ids.required' => 'Silakan pilih minimal 1 bulan periode pembayaran.',
            'bill_ids.min' => 'Silakan pilih minimal 1 bulan periode pembayaran.',
            'payment_method.required' => 'Silakan pilih metode pembayaran.',
            'proof_image.required' => 'Metode Transfer Bank dan QRIS wajib mengunggah bukti pembayaran.',
        ]);

        $bills = $student->bills()
            ->whereIn('id', $validated['bill_ids'])
            ->where('status', '!=', 'paid')
            ->orderBy('due_date')
            ->get();

        if ($bills->isEmpty()) {
            return to_route('students.index', ['id' => $student->id])
                ->with('success', 'Tagihan yang dipilih sudah berstatus Lunas.');
        }

        $proofPath = null;
        if ($request->hasFile('proof_image')) {
            $proofPath = $request->file('proof_image')->store('payment-proofs', 'public');
        }

        foreach ($bills as $bill) {
            Transaction::create([
                'user_id' => $request->user()->id,
                'bill_id' => $bill->id,
                'amount' => $bill->amount,
                'payment_method' => $validated['payment_method'],
                'transaction_date' => now(),
                'proof_image' => $proofPath,
                'status' => 'pending',
            ]);
        }

        $count = $bills->count();
        $pesan = $count > 1
            ? "Pengajuan pembayaran untuk {$count} bulan berhasil dikirim dan sedang menunggu verifikasi admin."
            : 'Pengajuan pembayaran berhasil dikirim dan sedang menunggu verifikasi admin.';

        return to_route('students.index', ['id' => $student->id])
            ->with('success', $pesan);
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $student = Student::create($request->validated());

        return to_route('students.index', ['id' => $student->id])
            ->with('success', 'Data siswa berhasil disimpan.');
    }

    public function show(Request $request, int $id): View
    {
        $title = 'SPPku - Halaman Profile Siswa';
        $student = Student::with('user')
            ->where('user_id', $request->user()->id)
            ->findOrFail($id);

        return view('student.show', compact('title', 'student'));
    }

    public function payments(Request $request, int $id): View
    {
        $title = 'SPPku - Halaman Riwayat Pembayaran Siswa';
        $student = Student::query()
            ->with('user:id,name')
            ->where('user_id', $request->user()->id)
            ->findOrFail($id);

        $filters = $request->validate([
            'q' => ['nullable', 'string', 'max:100'],
            'status' => ['nullable', 'in:paid,unpaid,overdue'],
            'school_year' => ['nullable', 'string', 'max:9'],
        ]);

        $schoolYears = $student->bills()
            ->distinct()
            ->orderByDesc('school_year')
            ->pluck('school_year');

        if (!$schoolYears->contains($student->school_year)) {
            $schoolYears->prepend($student->school_year);
        }

        $selectedSchoolYear = $filters['school_year'] ?? $student->school_year;

        if (!$schoolYears->contains($selectedSchoolYear)) {
            $selectedSchoolYear = $student->school_year;
        }

        $selectedStatus = $filters['status'] ?? '';
        $search = trim($filters['q'] ?? '');
        $monthNames = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        $billsQuery = $student->bills()
            ->with([
                'transactions' => fn($query) => $query
                    ->select('id', 'bill_id', 'payment_method', 'transaction_date', 'proof_image', 'status')
                    ->latest('transaction_date'),
            ])
            ->where('school_year', $selectedSchoolYear);

        if ($selectedStatus === 'paid') {
            $billsQuery->where('status', 'paid');
        } elseif ($selectedStatus === 'overdue') {
            $billsQuery->where(function ($query): void {
                $query->where('status', 'overdue')
                    ->orWhere(function ($unpaidQuery): void {
                        $unpaidQuery->where('status', 'unpaid')
                            ->whereDate('due_date', '<', today());
                    });
            });
        } elseif ($selectedStatus === 'unpaid') {
            $billsQuery->where('status', 'unpaid')
                ->whereDate('due_date', '>=', today());
        }

        // Urutkan kronologis dari Juli sampai Juni berdasarkan due_date
        $payments = $billsQuery
            ->orderBy('due_date')
            ->get()
            ->filter(function ($bill) use ($monthNames, $search): bool {
                $monthLabel = $monthNames[$bill->month] . ' ' . $bill->due_date->format('Y');

                return $search === '' || Str::contains(Str::lower($monthLabel), Str::lower($search));
            })
            ->map(function ($bill) use ($monthNames): array {
                $transaction = $bill->transactions->first();
                $billStatus = match ($bill->status) {
                    'paid' => 'Lunas',
                    'overdue' => 'Terlambat',
                    default => $bill->due_date->isBefore(today()) ? 'Terlambat' : 'Belum Lunas',
                };

                $transactionStatus = match ($transaction?->status) {
                    'verified' => 'Terverifikasi',
                    'rejected' => 'Ditolak',
                    'pending' => 'Menunggu Verifikasi',
                    default => 'Belum Ada Pengajuan',
                };

                return [
                    'month' => $monthNames[$bill->month] . ' ' . $bill->due_date->format('Y'),
                    'amount' => 'Rp ' . number_format((float) $bill->amount, 0, ',', '.'),
                    'due_date' => 'Jatuh tempo ' . $bill->due_date->format('d/m/Y'),
                    'payment_method' => $transaction?->payment_method ?? 'Belum ada transaksi',
                    'bill_status' => $billStatus,
                    'transaction_status' => $transactionStatus,
                    'proof_image' => $transaction?->proof_image,
                ];
            })
            ->values();

        return view('student.payment-view', compact(
            'title',
            'student',
            'payments',
            'schoolYears',
            'selectedSchoolYear',
            'selectedStatus',
            'search',
        ));
    }

    public function notifications(Request $request, int $id): View
    {
        $title = 'SPPku - Notifikasi Siswa';
        $student = Student::query()
            ->with('user:id,name')
            ->where('user_id', $request->user()->id)
            ->findOrFail($id);

        $monthNames = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        $notifications = collect();

        // 1. Pengingat tagihan SPP (termasuk yang baru dikirim reminder oleh Admin)
        $unpaidBills = $student->bills()
            ->where('school_year', $student->school_year)
            ->where(function ($q) {
                $q->where('status', 'overdue')
                    ->orWhere(function ($sub) {
                        $sub->where('status', 'unpaid')
                            ->whereDate('due_date', '<=', now()->endOfMonth());
                    });
            })
            ->orderByDesc('updated_at')
            ->get();

        foreach ($unpaidBills as $bill) {
            $bulanLabel = $monthNames[$bill->month] . ' ' . $bill->due_date->format('Y');
            $nominalLabel = 'Rp ' . number_format((float) $bill->amount, 0, ',', '.');
            $isOverdue = $bill->status === 'overdue' || $bill->due_date->isBefore(today());

            $notifications->push([
                'icon' => $isOverdue ? 'overdue' : 'available',
                'type' => $isOverdue ? 'Pengingat Pembayaran SPP' : 'Tagihan Tersedia',
                'title' => $isOverdue ? "Pengingat Pembayaran SPP {$bulanLabel}" : "Tagihan SPP {$bulanLabel} Tersedia",
                'message' => "Tagihan SPP bulan {$bulanLabel} sebesar {$nominalLabel} (jatuh tempo {$bill->due_date->format('d/m/Y')}) belum dilunasi. Segera lakukan pembayaran.",
                'time' => ($bill->updated_at ?? $bill->due_date)->diffForHumans(),
                'read' => false,
            ]);
        }

        $notifications = $notifications->all();

        return view('student.notification-view', compact('title', 'student', 'notifications'));
    }
}