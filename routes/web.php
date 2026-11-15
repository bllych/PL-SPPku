<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'home'])->name('home');
Route::get('/login', [AuthController::class, 'login'])
    ->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])
    ->middleware('throttle:5,1')
    ->name('login.authenticate');

Route::middleware('auth')->group(function (): void {
    Route::middleware('role:student')->group(function (): void {
        Route::get('/students/{id}', [StudentController::class, 'index'])
            ->name('students.index');
        Route::get('/students/{id}/profile', [StudentController::class, 'show'])
            ->name('students.show');
        Route::get('/students/{id}/payments', [StudentController::class, 'payments']);
        Route::get('/students/{id}/notifications', [StudentController::class, 'notifications']);
    });

    Route::middleware('role:admin')->group(function (): void {
        Route::post('/students', [StudentController::class, 'store'])
            ->name('students.store');
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
            ->name('admin.dashboard');
        Route::get('/admin/profile', [AdminController::class, 'show']);
        Route::get('/admin/payments', [AdminController::class, 'payments']);
        Route::get('/admin/notification', [AdminController::class, 'notification']);
        Route::get('/admin/reports', [AdminController::class, 'reports']);
    });

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});
