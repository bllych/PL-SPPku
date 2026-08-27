<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return view('Students.index');
    }

    public function show($id)
    {
        $title = "SPPku - Halaman Profile Siswa";

        $student = [[
            'profile' => [
                'id'          => $id,
                'name'        => 'Alfredy Rudi',
                'nisn'        => '0091237740',
                'nis'         => '7740',
                'class'       => '12 TKJ 1',
                'major'     => 'Teknik Komputer dan Jaringan',
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
                'warning'    => 1, // Pelanggaran
                'sick'       => 2, // Sakit
                'permission' => 1, // Izin
                'late'       => 0, // Terlambat
            ],
        ],
        [
            'profile' => [
                'id'          => $id,
                'name'        => 'Alice Holly Kristy',
                'nisn'        => '0091237741',
                'nis'         => '7741',
                'class'       => '12 AKL',
                'major'     => 'Akuntansi dan Keuangan Lembaga',
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
                'id'          => $id,
                'name'        => 'Amos Mikhael',
                'nisn'        => '0091237742',
                'nis'         => '7742',
                'class'       => '12 TKJ 2',
                'major'     => 'Teknik Komputer dan Jaringan',
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
        ]
    ];

        return view('Students.show', compact('title', 'id', 'student'));
    }
    public function payments($id)
    {
        return view('Students.payments', ['id' => $id]);
    }

    public function notifications($id)
    {
        return view('Students.notification', ['id' => $id]);
    }
}
