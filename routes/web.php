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
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index']);
// Halaman Laporan Pembayaran Admin
Route::get('/admin/payments', [App\Http\Controllers\AdminController::class, 'payments']);
// Halaman Laporan Siswa Admin