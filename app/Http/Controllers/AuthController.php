<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function login()
    {
        $title = "SPPku - Halaman Login";
        return view('auth.login', compact('title'));
    }
}
