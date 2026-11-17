<?php

namespace App\Http\Controllers;

use App\Http\Requests\Student\StoreRequest;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function index(int $id): View
    {
        $title = 'SPPku - Halaman Siswa';
        $student = Student::with('user')->findOrFail($id);

        return view('student.index', compact('title', 'student'));
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

    public function payments($id)
    {
        $title = 'SPPku - Halaman Riwayat Pembayaran Siswa';

        return view('student.payment-view', compact('title', 'id'));
    }

    public function notifications($id)
    {
        $title = 'SPPku - Halaman Notifikasi Siswa';

        return view('student.notification-view', compact('title', 'id'));
    }
}
