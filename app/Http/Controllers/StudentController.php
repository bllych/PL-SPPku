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
        return view('Students.show', ['id' => $id]);
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
