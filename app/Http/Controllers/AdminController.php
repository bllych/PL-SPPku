<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Transaction;

class AdminController extends Controller
{
    public function dashboard()
    {
        $title = 'SPPku - Halaman Admin';

        $students = Student::with(['user', 'bills'])
            ->paginate(10)
            ->through(function ($student) {
                $latestBill =$student->bills->first();
                $unpaidAmount =$student->bills->where('status', 'unpaid')->sum('amount');
                $displayAmount =$unpaidAmount > 0 ? $unpaidAmount : ($latestBill->amount ?? 840000);

                return [
                    'id' => $student->id,
                    'name' => $student->user->name ?? '-',
                    'class' => $student->class,
                    'tuition' => 'Rp. ' . number_format($displayAmount, 2, ',', '.'), 'status' =>$unpaidAmount == 0 ? 'Lunas' : 'Belum Lunas',
                ];
            });

        return view('admin.dashboard', compact('title', 'students'));
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
                'no' => $payments->firstItem() +$index,
                'nama' => $tx->user->name ?? '-',
                'nisn' => $tx->bill->student->nisn ?? '-',
                'kelas' => $tx->bill->student->class ?? '-',
                'nominal' => 'Rp. ' . number_format($tx->amount, 2, ',', '.'), 'metode' =>$tx->payment_method,
                'tanggal' => $tx->transaction_date->translatedFormat('d M Y'),
                'jam' => $tx->transaction_date->format('H:i') . ' WIB',
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