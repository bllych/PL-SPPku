<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $title = "SPPku - Halaman Admin";

        return view('Admin.index', compact('title', 'students'));
    }

    public function payments()
    {
        return view('Admin.payments');
    }
}
