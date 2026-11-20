<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function home(): RedirectResponse
    {
        if (! Auth::check()) {
            return to_route('login');
        }

        return $this->redirectAuthenticatedUser();
    }

    public function login(): View|RedirectResponse
    {
        if (Auth::check()) {
            return $this->redirectAuthenticatedUser();
        }

        $title = 'SPPku - Halaman Login';

        return view('auth.login', compact('title'));
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($credentials)) {
            return back()
                ->withErrors(['email' => 'Email atau kata sandi salah.'])
                ->onlyInput('email');
        }

        $request->session()->regenerate();

        return $this->redirectAuthenticatedUser();
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('login');
    }

    private function redirectAuthenticatedUser(): RedirectResponse
    {
        $user = Auth::user();

        if ($user === null) {
            return to_route('login');
        }

        if ($user->role === 'admin') {
            return to_route('admin.dashboard');
        }

        if ($user->role === 'student') {
            $student = Student::where('user_id', $user->id)->first();

            if ($student === null) {
                Auth::logout();
                request()->session()->invalidate();
                request()->session()->regenerateToken();

                return to_route('login')->withErrors([
                    'email' => 'Akun ini belum terhubung dengan data siswa di tabel students.',
                ]);
            }

            return to_route('students.index', ['id' => $student->id]);
        }

        Auth::logout();

        return to_route('login')->withErrors([
            'email' => 'Role akun tidak valid.',
        ]);
    }
}