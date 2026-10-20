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

        return view('student.show', compact('title', 'id'));
    }
    public function payments($id)
    {
        $title = "SPPku - Halaman Riwayat Pembayaran Siswa";

        return view('student.payment-view', compact('title', 'id'));
    }

    public function notifications($id)
    {
        $title = "SPPku - Halaman Notifikasi Siswa";
        return view('student.notification-view', compact('title', 'id'));
    }
}
