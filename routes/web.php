<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\AdminProdiController;
use App\Http\Controllers\AdminProfilLulusanController;
use App\Http\Controllers\AdminCapaianProfilLulusanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PemetaanCplPlController;
use App\Http\Controllers\AdminBahanKajianController;
use App\Http\Controllers\PemetaanCplBkController;
use App\Http\Controllers\AdminMataKuliahController;

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

Route::get('/signup', [LoginController::class, 'signup'])->name('signup');

// Grup Route Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/jurusan', [JurusanController::class, 'index'])->name('jurusan.index');
    Route::get('/jurusan/create', [JurusanController::class, 'create'])->name('jurusan.create');
    Route::post('/jurusan', [JurusanController::class, 'store'])->name('jurusan.store');
    Route::get('/jurusan/{jurusan}/edit', [JurusanController::class, 'edit'])->name('jurusan.edit');
    Route::put('/jurusan/{jurusan}', [JurusanController::class, 'update'])->name('jurusan.update');
    Route::delete('/jurusan/{jurusan}', [JurusanController::class, 'destroy'])->name('jurusan.destroy');
    Route::get('/prodi', [AdminProdiController::class, 'index'])->name('prodi.index');
    Route::get('/prodi/create', [AdminProdiController::class, 'create'])->name('prodi.create');
    Route::post('/prodi', [AdminProdiController::class, 'store'])->name('prodi.store');
    Route::get('/prodi/{prodi}/edit', [AdminProdiController::class, 'edit'])->name('prodi.edit');
    Route::put('/prodi/{prodi}', [AdminProdiController::class, 'update'])->name('prodi.update');
    Route::delete('/prodi/{prodi}', [AdminProdiController::class, 'destroy'])->name('prodi.destroy');
    Route::get('/profillulusan', [AdminProfilLulusanController::class, 'index'])->name('profillulusan.index');
    Route::get('/profillulusan/create', [AdminProfilLulusanController::class, 'create'])->name('profillulusan.create');
    Route::post('/profillulusan', [AdminProfilLulusanController::class, 'store'])->name('profillulusan.store');
    Route::get('/profillulusan/{profillulusan}/edit', [AdminProfilLulusanController::class, 'edit'])->name('profillulusan.edit');
    Route::put('/profillulusan/{profillulusan}', [AdminProfilLulusanController::class, 'update'])->name('profillulusan.update');
    Route::delete('/profillulusan/{profillulusan}', [AdminProfilLulusanController::class, 'destroy'])->name('profillulusan.destroy');
    Route::get('/capaianprofillulusan', [AdminCapaianProfilLulusanController::class, 'index'])->name('capaianprofillulusan.index');
    Route::get('/capaianprofillulusan/create', [AdminCapaianProfilLulusanController::class, 'create'])->name('capaianprofillulusan.create');
    Route::post('/capaianprofillulusan', [AdminCapaianProfilLulusanController::class, 'store'])->name('capaianprofillulusan.store');
    Route::get('/capaianprofillulusan/{capaianprofillulusan}/edit', [AdminCapaianProfilLulusanController::class, 'edit'])->name('capaianprofillulusan.edit');
    Route::put('/capaianprofillulusan/{capaianprofillulusan}', [AdminCapaianProfilLulusanController::class, 'update'])->name('capaianprofillulusan.update');
    Route::delete('/capaianprofillulusan/{capaianprofillulusan}', [AdminCapaianProfilLulusanController::class, 'destroy'])->name('capaianprofillulusan.destroy');
    Route::get('/pemetaancplpl', [PemetaanCplPlController::class, 'index'])->name('pemetaancplpl.index');
    Route::post('/pemetaancplpl', [PemetaanCplPlController::class, 'store'])->name('pemetaancplpl.store');
    Route::get('/bahankajian', [AdminBahankajianController::class, 'index'])->name('bahankajian.index');
    Route::get('/bahankajian/create', [AdminBahankajianController::class, 'create'])->name('bahankajian.create');
    Route::post('/bahankajian', [AdminBahankajianController::class, 'store'])->name('bahankajian.store');
    Route::get('/bahankajian/{bahankajian}/edit', [AdminBahankajianController::class, 'edit'])->name('bahankajian.edit');
    Route::put('/bahankajian/{bahankajian}', [AdminBahankajianController::class, 'update'])->name('bahankajian.update');
    Route::delete('/bahankajian/{bahankajian}', [AdminBahankajianController::class,'destroy'])->name('bahankajian.destroy');
    Route::get('/pemetaancplbk', [PemetaanCplBkController::class, 'index'])->name('pemetaancplbk.index');
    Route::post('/pemetaancplbk', [PemetaanCplBkController::class, 'store'])->name('pemetaancplbk.store');
    Route::get('/matakuliah', [AdminMataKuliahController::class, 'index'])->name('matakuliah.index');
    Route::get('/matakuliah/create', [AdminMataKuliahController::class, 'create'])->name('matakuliah.create');
    Route::post('/matakuliah', [AdminMataKuliahController::class, 'store'])->name('matakuliah.store');
    Route::get('/matakuliah/{matakuliah}/edit', [AdminMataKuliahController::class, 'edit'])->name('matakuliah.edit');
    Route::put('/matakuliah/{matakuliah}', [AdminMataKuliahController::class, 'update'])->name('matakuliah.update');
    Route::delete('/matakuliah/{matakuliah}', [AdminMataKuliahController::class, 'destroy'])->name('matakuliah.destroy');
});
