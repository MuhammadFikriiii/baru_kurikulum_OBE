<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Auth
Route::get('/', [LoginController::class, 'loginForm'])->name('login');
Route::post('/', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/forgot-password', [LoginController::class, 'forgotPassword'])->name('forgot-password.post');
Route::get('/forgot-password', [LoginController::class, 'showForgotPasswordForm'])->name('forgot-password');

Route::get('/reset-password/{token}', [LoginController::class, 'showResetPasswordForm'])->name('reset-password.form');
Route::post('/reset-password', [LoginController::class, 'resetPassword'])->name('reset-password.post');

Route::get('/validasi-forgot-password/{token}', [LoginController::class, 'validasi_forgotPassword'])
    ->name('validasi-forgot-password');

Route::get('/reset-password/{token}', [LoginController::class, 'showResetPasswordForm'])
    ->name('show-reset-password-form');

// Grup Route Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
});
