<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Manajemen Siswa

// Halaman Utama Siswa
Route::get('/students', [App\Http\Controllers\StudentController::class, 'index']);
// Halaman Profile Siswa
Route::get('/students/{id}', [App\Http\Controllers\StudentController::class, 'show']);
// Halaman Riwayat Pembayaran Siswa
Route::get('/students/{id}/payments', [App\Http\Controllers\StudentController::class, 'payments']);
// Halaman notifikasi Siswa
Route::get('/students/{id}/notifications', [App\Http\Controllers\StudentController::class, 'notifications']);


// Manajemen Admin

// Halaman Utama Admin
Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard']);
// Halaman Profile Admin
Route::get('/admin/profile', [App\Http\Controllers\AdminController::class, 'show']);
// Halaman Laporan Pembayaran Admin
Route::get('/admin/payments', [App\Http\Controllers\AdminController::class, 'payments']);
// Halaman Notifikasi Admin
Route::get('/admin/notification', [App\Http\Controllers\AdminController::class, 'notification']);
// Halaman Laporan Keuangan Admin
Route::get('/admin/reports', [App\Http\Controllers\AdminController::class, 'reports']);



// Manajemen Auth

// Halaman Login
Route::get('/login', [App\Http\Controllers\AuthController::class, 'login']);