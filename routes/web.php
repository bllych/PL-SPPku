<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Manajemen Siswa

// Halaman Utama Siswa
Route::get('/students', [StudentController::class, 'index'])
    ->name('students.index');
Route::post('/students', [StudentController::class, 'store'])
    ->middleware('auth')
    ->name('students.store');
// Halaman Profile Siswa
Route::get('/students/{id}', [StudentController::class, 'show']);
// Halaman Riwayat Pembayaran Siswa
Route::get('/students/{id}/payments', [StudentController::class, 'payments']);
// Halaman notifikasi Siswa
Route::get('/students/{id}/notifications', [StudentController::class, 'notifications']);

// Manajemen Admin

// Halaman Utama Admin
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->name('admin.dashboard');
// Halaman Profile Admin
Route::get('/admin/profile', [AdminController::class, 'show']);
// Halaman Laporan Pembayaran Admin
Route::get('/admin/payments', [AdminController::class, 'payments']);
// Halaman Notifikasi Admin
Route::get('/admin/notification', [AdminController::class, 'notification']);
// Halaman Laporan Keuangan Admin
Route::get('/admin/reports', [AdminController::class, 'reports']);

// Manajemen Auth

// Halaman Login
Route::get('/login', [AuthController::class, 'login'])
    ->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])
    ->middleware('throttle:5,1')
    ->name('login.authenticate');
