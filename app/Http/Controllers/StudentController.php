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

        $semesterBills = $student->bills()
            ->where('school_year', $student->school_year)
            ->whereBetween('month', [7, 12])
            ->get(['id', 'student_id', 'month', 'status', 'due_date'])
            ->keyBy('month');

        $semesterMonths = [
            7 => 'Jul',
            8 => 'Agu',
            9 => 'Sep',
            10 => 'Okt',
            11 => 'Nov',
            12 => 'Des',
        ];
        $schoolYearStart = explode('/', $student->school_year)[0];
        $semesterPaymentStatuses = [];

        foreach ($semesterMonths as $month => $monthLabel) {
            $bill = $semesterBills->get($month);
            $status = match (true) {
                $bill === null => 'Belum Ada Tagihan',
                $bill->status === 'paid' => 'Lunas',
                $bill->status === 'overdue' || ($bill->due_date?->isBefore(today()) ?? false) => 'Terlambat',
                default => 'Belum Lunas',
            };

            $statusClass = match ($status) {
                'Lunas' => 'bg-[#45C0F4] text-white',
                'Terlambat' => 'bg-[#F43F5E] text-white',
                'Belum Ada Tagihan' => 'border border-dashed border-gray-400 bg-white text-gray-500',
                default => 'bg-[#999999] text-white',
            };

            $semesterPaymentStatuses[] = [
                'month' => $monthLabel,
                'period' => $monthLabel.' '.$schoolYearStart,
                'status' => $status,
                'class' => $statusClass,
            ];
        }

        $semesterPaidCount = $semesterBills->where('status', 'paid')->count();
        $semesterOutstandingCount = $semesterBills->where('status', '!=', 'paid')->count();

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
        $currentDateLabel = $currentDate->format('d').' '.$monthNames[$currentDate->month].' '.$currentDate->year;
        $currentMonthBill = $student->bills()
            ->where('school_year', $student->school_year)
            ->where('month', $currentDate->month)
            ->whereYear('due_date', $currentDate->year)
            ->first(['student_id', 'amount', 'due_date']);
        $currentPeriod = $monthNames[$currentDate->month].' '.$currentDate->year;
        $currentBillAmount = $currentMonthBill
            ? 'Rp '.number_format((float) $currentMonthBill->amount, 0, ',', '.')
            : 'Tagihan belum tersedia';
        $currentBillDueDate = $currentMonthBill?->due_date
            ? $currentMonthBill->due_date->format('d').' '.$monthNames[$currentMonthBill->due_date->month].' '.$currentMonthBill->due_date->year
            : '15 '.$monthNames[$currentDate->month].' '.$currentDate->year;

        return view('student.index', compact(
            'title',
            'student',
            'semesterPaymentStatuses',
            'semesterPaidCount',
            'semesterOutstandingCount',
            'currentPeriod',
            'currentBillAmount',
            'currentBillDueDate',
            'currentDateLabel',
        ));
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $student = Student::create($request->validated());

        return to_route('students.index', ['id' => $student->id])
            ->with('success', 'Data siswa berhasil disimpan.');
    }

    public function show(int $id): View
    {
        $title = 'SPPku - Halaman Profile Siswa';
        $student = Student::with('user')->findOrFail($id);

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

        if (! $schoolYears->contains($student->school_year)) {
            $schoolYears->prepend($student->school_year);
        }

        $selectedSchoolYear = $filters['school_year'] ?? $student->school_year;

        if (! $schoolYears->contains($selectedSchoolYear)) {
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
                'transactions' => fn ($query) => $query
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

        $payments = $billsQuery
            ->orderByDesc('due_date')
            ->get()
            ->filter(function ($bill) use ($monthNames, $search): bool {
                $monthLabel = $monthNames[$bill->month].' '.$bill->due_date->format('Y');

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
                    'month' => $monthNames[$bill->month].' '.$bill->due_date->format('Y'),
                    'amount' => 'Rp '.number_format((float) $bill->amount, 0, ',', '.'),
                    'due_date' => 'Jatuh tempo '.$bill->due_date->format('d/m/Y'),
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

        $transactions = Transaction::with('bill')
            ->where('user_id', $student->user_id)
            ->latest('updated_at')
            ->get();

        $notifications = $transactions->map(function (Transaction $tx) use ($monthNames): array {
            $bulanLabel = $tx->bill
                ? ($monthNames[$tx->bill->month].' '.$tx->bill->due_date->format('Y'))
                : $tx->transaction_date->translatedFormat('F Y');
            $nominalLabel = 'Rp '.number_format((float) $tx->amount, 0, ',', '.');
            $catatan = $tx->note ? ' Catatan admin: '.$tx->note : '';

            return match ($tx->status) {
                'verified' => [
                    'icon'    => 'approved',
                    'type'    => 'Pembayaran Diterima',
                    'title'   => 'Pembayaran SPP Terverifikasi',
                    'message' => "Pembayaran SPP bulan {$bulanLabel} sebesar {$nominalLabel} ({$tx->payment_method}) telah disetujui oleh admin.{$catatan}",
                    'time'    => ($tx->verified_at ?? $tx->updated_at)->diffForHumans(),
                    'read'    => ($tx->verified_at ?? $tx->updated_at)->lt(now()->subDay()),
                ],
                'rejected' => [
                    'icon'    => 'overdue',
                    'type'    => 'Pembayaran Ditolak',
                    'title'   => 'Pembayaran SPP Ditolak',
                    'message' => "Pembayaran SPP bulan {$bulanLabel} sebesar {$nominalLabel} ditolak oleh admin.{$catatan}",
                    'time'    => $tx->updated_at->diffForHumans(),
                    'read'    => false,
                ],
                default => [
                    'icon'    => 'pending',
                    'type'    => 'Menunggu Verifikasi',
                    'title'   => 'Pembayaran Sedang Diverifikasi',
                    'message' => "Pengajuan pembayaran SPP bulan {$bulanLabel} sebesar {$nominalLabel} ({$tx->payment_method}) sedang menunggu verifikasi admin.",
                    'time'    => $tx->transaction_date->diffForHumans(),
                    'read'    => true,
                ],
            };
        })->all();

        return view('student.notification-view', compact('title', 'student', 'notifications'));
    }
}