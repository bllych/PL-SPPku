<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $title = "SPPku - Halaman Siswa";

        return view('student.index', compact('title'));
    }

    public function show($id)
    {
        $title = "SPPku - Halaman Profile Siswa";

        $students = [
            [
                'profile' => [
                    'id'          => 1,
                    'name'        => 'Alfredy Rudi',
                    'nisn'        => '0091237740',
                    'nis'         => '7740',
                    'class'       => '12 TKJ 1',
                    'major'       => 'Teknik Komputer dan Jaringan',
                    'school_year' => '2026/2027',
                ],
                'account' => [
                    'password'       => '********',
                    'email'          => 'alfredy.rudi@gmail.com',
                    'phone'          => '081234567890',
                    'last_login'     => '26 Maret 2026',
                    'account_status' => 'Aktif',
                ],
                'attendance' => [
                    'warning'    => 1,
                    'sick'       => 2,
                    'permission' => 1,
                    'late'       => 0,
                ],
            ],
            [
                'profile' => [
                    'id'          => 2,
                    'name'        => 'Alice Holly Kristy',
                    'nisn'        => '0091237741',
                    'nis'         => '7741',
                    'class'       => '12 AKL',
                    'major'       => 'Akuntansi dan Keuangan Lembaga',
                    'school_year' => '2026/2027',
                ],
                'account' => [
                    'password'       => '********',
                    'email'          => 'alice.holly@gmail.com',
                    'phone'          => '081234567891',
                    'last_login'     => '26 Maret 2026',
                    'account_status' => 'Aktif',
                ],
                'attendance' => [
                    'warning'    => 0,
                    'sick'       => 1,
                    'permission' => 0,
                    'late'       => 2,
                ],
            ],
            [
                'profile' => [
                    'id'          => 3,
                    'name'        => 'Amos Mikhael',
                    'nisn'        => '0091237742',
                    'nis'         => '7742',
                    'class'       => '12 TKJ 2',
                    'major'       => 'Teknik Komputer dan Jaringan',
                    'school_year' => '2026/2027',
                ],
                'account' => [
                    'password'       => '********',
                    'email'          => 'amos.mikhael@gmail.com',
                    'phone'          => '081234567892',
                    'last_login'     => '26 Maret 2026',
                    'account_status' => 'Aktif',
                ],
                'attendance' => [
                    'warning'    => 2,
                    'sick'       => 0,
                    'permission' => 1,
                    'late'       => 1,
                ],
            ],
        ];

        $student = collect($students)->firstWhere('profile.id', (int) $id);

        if (!$student) {
            abort(404);
        }

        $student = collect($students)->firstWhere('profile.id', $id);

        return view('student.show', compact('title', 'id', 'student'));
    }

    public function payments($id)
    {
        $title = "SPPku - Halaman Riwayat Pembayaran Siswa";

        return view('student.payment-view', compact('title', 'id'));
    }

    public function notifications($id)
    {
        $title = "SPPku - Halaman Notifikasi Siswa";

        $notifications = [
            [
                'icon' => 'berhasil',
                'type' => 'Berhasil',
                'title' => 'Pembayaran SPP Berhasil',
                'message' => 'Pembayaran SPP bulan Agustus 2026 telah berhasil dikonfirmasi oleh sistem.',
                'time' => '5 menit yang lalu',
                'read' => false,
            ],
            [
                'icon' => 'proses',
                'type' => 'Proses',
                'title' => 'Pembayaran Sedang Diproses',
                'message' => 'Kami akan memberi tahu Anda setelah pembayaran berhasil dikonfirmasi.',
                'time' => '1 hari yang lalu',
                'read' => false,
            ],
            [
                'icon' => 'tersedia',
                'type' => 'Tersedia',
                'title' => 'Bukti Pembayaran Tersedia',
                'message' => 'Bukti pembayaran SPP bulan Agustus 2026 telah tersedia dan dapat dilihat pada riwayat pembayaran.',
                'time' => '16 hari yang lalu',
                'read' => true,
            ],
            [
                'icon' => 'berhasil',
                'type' => 'Berhasil',
                'title' => 'Pembayaran SPP Berhasil',
                'message' => 'Pembayaran SPP bulan Juli 2026 telah berhasil dikonfirmasi oleh sistem.',
                'time' => '16 hari yang lalu',
                'read' => true,
            ],
            [
                'icon' => 'proses',
                'type' => 'Proses',
                'title' => 'Pembayaran Sedang Diproses',
                'message' => 'Kami akan memberi tahu Anda setelah pembayaran berhasil dikonfirmasi.',
                'time' => '17 hari yang lalu',
                'read' => true,
            ],
            [
                'icon' => 'tempo',
                'type' => 'Terlambat',
                'title' => 'Pembayaran SPP Melewati Jatuh Tempo',
                'message' => 'Silakan lakukan pembayaran untuk bulan Juli sesegera mungkin.',
                'time' => '18 hari yang lalu',
                'read' => true,
            ],
        ];

        return view('student.notification-view', compact('title', 'id', 'notifications'));
    }
}
