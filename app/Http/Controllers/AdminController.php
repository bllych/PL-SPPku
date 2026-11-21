<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard(Request $request): View
    {
        $title = 'SPPku - Halaman Admin';
        $schoolYear = '2026/2027';
        [$schoolYearStart, $schoolYearEnd] = array_map('intval', explode('/', $schoolYear));
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

        $periodOptions = [];

        foreach (range(7, 12) as $month) {
            $period = sprintf('%04d-%02d', $schoolYearStart, $month);
            $periodOptions[$period] = $monthNames[$month].' '.$schoolYearStart;
        }

        foreach (range(1, 6) as $month) {
            $period = sprintf('%04d-%02d', $schoolYearEnd, $month);
            $periodOptions[$period] = $monthNames[$month].' '.$schoolYearEnd;
        }

        $defaultPeriod = now()->format('Y-m');

        if (! array_key_exists($defaultPeriod, $periodOptions)) {
            $defaultPeriod = array_key_first($periodOptions);
        }

        $selectedPeriod = $request->query('period');

        if (! is_string($selectedPeriod) || ! array_key_exists($selectedPeriod, $periodOptions)) {
            $selectedPeriod = $defaultPeriod;
        }

        [$calendarYear, $selectedMonth] = array_map('intval', explode('-', $selectedPeriod));
        $selectedPeriodLabel = $periodOptions[$selectedPeriod];

        $studentsQuery = Student::where('school_year', $schoolYear);
        $totalStudents = (clone $studentsQuery)->count();
        $paidStudents = (clone $studentsQuery)->whereHas('bills', function ($query) use ($selectedMonth, $schoolYear, $calendarYear): void {
            $query->where('month', $selectedMonth)
                ->where('status', 'paid')
                ->where('school_year', $schoolYear)
                ->whereYear('due_date', $calendarYear);
        })->count();
        $unpaidStudents = (clone $studentsQuery)->whereHas('bills', function ($query) use ($selectedMonth, $schoolYear, $calendarYear): void {
            $query->where('month', $selectedMonth)
                ->whereIn('status', ['unpaid', 'overdue'])
                ->where('school_year', $schoolYear)
                ->whereYear('due_date', $calendarYear);
        })->count();

        $students = (clone $studentsQuery)->with([
            'user:id,name',
            'bills:id,student_id,month,school_year,amount,due_date,status',
        ])->paginate(10);

        $firstStudentNumber = $students->firstItem() ?? 1;

        $students->through(function ($student, $index) use ($selectedMonth, $schoolYear, $calendarYear, $firstStudentNumber) {
            $monthlyBills = $student->bills
                ->where('month', $selectedMonth)
                ->where('school_year', $schoolYear)
                ->filter(fn ($bill): bool => $bill->due_date?->year === $calendarYear);
            $unpaidBills = $monthlyBills->whereIn('status', ['unpaid', 'overdue']);
            $hasOverdueBill = $unpaidBills->contains(function ($bill): bool {
                return $bill->status === 'overdue'
                    || ($bill->due_date?->isBefore(today()) ?? false);
            });

            $status = match (true) {
                $monthlyBills->isEmpty() => 'Belum Ada Tagihan',
                $hasOverdueBill => 'Terlambat',
                $unpaidBills->isNotEmpty() => 'Belum Lunas',
                default => 'Lunas',
            };

            return [
                'number' => $firstStudentNumber + $index,
                'id' => $student->id,
                'name' => $student->user->name ?? '-',
                'class' => $student->class,
                'tuition' => $monthlyBills->isEmpty()
                    ? '-'
                    : 'Rp. '.number_format($monthlyBills->sum('amount'), 0, ',', '.'),
                'status' => $status,
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

    public function payments()
    {
        $title = 'SPPku - Halaman Laporan Pembayaran Admin';

        $payments = Transaction::with(['user', 'bill.student'])
            ->latest('transaction_date')
            ->paginate(10);

        $payments->through(function ($tx, $index) use ($payments) {
            $statusLabel = match ($tx->status) {
                'verified' => 'Terverifikasi',
                'rejected' => 'Ditolak',
                default => 'Menunggu',
            };

            return [
                'no' => $payments->firstItem() + $index,
                'nama' => $tx->user->name ?? '-',
                'nisn' => $tx->bill->student->nisn ?? '-',
                'kelas' => $tx->bill->student->class ?? '-',
                'nominal' => 'Rp. '.number_format($tx->amount, 2, ',', '.'), 'metode' => $tx->payment_method,
                'tanggal' => $tx->transaction_date->translatedFormat('d M Y'),
                'jam' => $tx->transaction_date->format('H:i').' WIB',
                'status' => $statusLabel,
            ];
        });

        return view('admin.payment-view', compact('title', 'payments'));
    }

    public function notification()
    {
        $title = 'SPPku - Halaman Notifikasi Admin';

        return view('admin.notification-view', compact('title'));
    }

    public function show()
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

        return view('admin.show', compact('title', 'admin'));
    }

    public function reports()
    {
        $title = 'SPPku - Halaman Laporan Keuangan Admin';

        return view('admin.report-view', compact('title'));
    }
}
