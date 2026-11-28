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
        Route::get('/students/{id}/payments/create', [StudentController::class, 'createPayment'])
            ->name('students.payments.create');
        Route::post('/students/{id}/payments', [StudentController::class, 'storePayment'])
            ->name('students.payments.store');
        Route::get('/students/{id}/profile', [StudentController::class, 'show'])
            ->name('students.show');
        Route::get('/students/{id}/payments', [StudentController::class, 'payments'])
            ->name('students.payments');
        Route::get('/students/{id}/notifications', [StudentController::class, 'notifications'])
            ->name('students.notifications');
    });

    Route::middleware('role:admin')->group(function (): void {
        Route::post('/students', [StudentController::class, 'store'])
            ->name('students.store');
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
            ->name('admin.dashboard');
        Route::post('/admin/dashboard/send-reminders', [AdminController::class, 'sendReminders'])
            ->name('admin.reminders.send');
        Route::get('/admin/profile', [AdminController::class, 'show'])
            ->name('admin.profile');
        Route::patch('/admin/profile/bio', [AdminController::class, 'updateBio'])
            ->name('admin.profile.bio');
        Route::post('/admin/profile/notes', [AdminController::class, 'storeNote'])
            ->name('admin.notes.store');
        Route::delete('/admin/profile/notes/{id}', [AdminController::class, 'destroyNote'])
            ->name('admin.notes.destroy');
        Route::get('/admin/payments', [AdminController::class, 'payments'])
            ->name('admin.payments');
        Route::get('/admin/payments/export', [AdminController::class, 'exportPayments'])
            ->name('admin.payments.export');
        Route::patch('/admin/payments/{id}/verify', [AdminController::class, 'verifyPayment'])
            ->name('admin.payments.verify');
        Route::get('/admin/notification', [AdminController::class, 'notification'])
            ->name('admin.notification');
        Route::get('/admin/reports', [AdminController::class, 'reports'])
            ->name('admin.reports');
        Route::get('/admin/reports/download', [AdminController::class, 'downloadReport'])
            ->name('admin.reports.download');
    });

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});