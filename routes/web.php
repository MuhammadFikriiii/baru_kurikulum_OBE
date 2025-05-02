<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\AdminProdiController;
use App\Http\Controllers\AdminProfilLulusanController;
use App\Http\Controllers\AdminCapaianProfilLulusanController;
use App\Http\Controllers\Wadir1ProdiController;
use App\Models\AdminCapaianPembelajaranMataKuliah;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminPemetaanCplPlController;
use App\Http\Controllers\AdminBahanKajianController;
use App\Http\Controllers\AdminPemetaanCplBkController;
use App\Http\Controllers\AdminMataKuliahController;
use App\Http\Controllers\AdminPemetaanCplMkController;
use App\Http\Controllers\AdminPemetaanBkMkController;
use App\Http\Controllers\AdminPemetaanCplMkBkController;
use App\Http\Controllers\Wadir1UserController;
use App\Http\Controllers\Wadir1DashboardController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\Wadir1JurusanController;
use App\Http\Controllers\KaprodiDashboardController;
use App\http\Controllers\AdminUserProdiController;
use App\Http\Controllers\KaprodiProfilLulusanController;
use App\Http\Controllers\TimDashboardController;
use App\Http\Controllers\TimProfilLulusanController;
use App\Http\Controllers\TimCapaianPembelajaranLulusanController;
use App\Http\Controllers\TimPemetaanCplPlController;
use App\Http\Controllers\Wadir1BahanKajianController;
use App\Http\Controllers\Wadir1ProfilLulusanController;
use App\Http\Controllers\Wadir1CapaianPembelajaranLulusanController;
use App\Http\Controllers\Wadir1CplPlController;
use App\Http\Controllers\Wadir1PemetaanCplBkController;
use App\Http\Controllers\TimBahanKajianController;
use App\Http\Controllers\TimPemetaanCplBkController;
use App\Http\Controllers\TimMataKuliahController;
use App\Http\Controllers\AdminCapaianPembelajaranMataKuliahController;
use App\Http\Controllers\AdminPemetaanCplCpmkController;
use App\Http\Controllers\AdminPemetaanCplCpmkMkController;
use App\Http\Controllers\TimPemetaanBkMkController;
use App\Http\Controllers\TimPemetaanCplMkController;

// Auth
Route::get('/login', [LoginController::class, 'loginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/forgot-password', [LoginController::class, 'forgotPassword'])->name('forgot-password.post');
Route::get('/forgot-password', [LoginController::class, 'showForgotPasswordForm'])->name('forgot-password');

Route::get('/reset-password/{token}', [LoginController::class, 'showResetPasswordForm'])->name('reset-password.form');
Route::post('/reset-password', [LoginController::class, 'resetPassword'])->name('reset-password.post');

Route::get('/validasi-forgot-password/{token}', [LoginController::class, 'validasi_forgotPassword'])
    ->name('validasi-forgot-password');

Route::get('/reset-password/{token}', [LoginController::class, 'showResetPasswordForm'])
    ->name('show-reset-password-form');

Route::get('/signup', [SignUpController::class, 'create'])->name('signup');
Route::post('/signup', [SignUpController::class, 'store'])->name('signup.store');

Route::get('/', function () {
    return view('auth.homepage');
});

// Grup Route Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [AdminUserController::class, 'create'])->name('users.create');
    Route::post('/users', [AdminUserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [AdminUserController::class, 'update'])->name('users.update');
    Route::get('/users/{id}/detail', [AdminUserController::class,'details'])->name('users.detail');
    Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])->name('users.destroy');
    Route::get('/userprodi', [AdminUserProdiController::class, 'index'])->name('userprodi.index');
    
    Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');

    Route::get('/jurusan', [JurusanController::class, 'index'])->name('jurusan.index');
    Route::get('/jurusan/create', [JurusanController::class, 'create'])->name('jurusan.create');
    Route::post('/jurusan', [JurusanController::class, 'store'])->name('jurusan.store');
    Route::get('/jurusan/{jurusan}/edit', [JurusanController::class, 'edit'])->name('jurusan.edit');
    Route::put('/jurusan/{jurusan}', [JurusanController::class, 'update'])->name('jurusan.update');
    Route::get('/jurusan/{jurusan}/detail', [JurusanController::class, 'detail'])->name('jurusan.detail');
    Route::delete('/jurusan/{jurusan}', [JurusanController::class, 'destroy'])->name('jurusan.destroy');
    
    Route::get('/prodi', [AdminProdiController::class, 'index'])->name('prodi.index');
    Route::get('/prodi/create', [AdminProdiController::class, 'create'])->name('prodi.create');
    Route::post('/prodi', [AdminProdiController::class, 'store'])->name('prodi.store');
    Route::get('/prodi/{prodi}/edit', [AdminProdiController::class, 'edit'])->name('prodi.edit');
    Route::put('/prodi/{prodi}', [AdminProdiController::class, 'update'])->name('prodi.update');
    Route::get('/prodi/{prodi}/detail', [AdminProdiController::class, 'detail'])->name('prodi.detail');
    Route::delete('/prodi/{prodi}', [AdminProdiController::class, 'destroy'])->name('prodi.destroy');

    Route::get('/profillulusan', [AdminProfilLulusanController::class, 'index'])->name('profillulusan.index');
    Route::get('/profillulusan/create', [AdminProfilLulusanController::class, 'create'])->name('profillulusan.create');
    Route::post('/profillulusan', [AdminProfilLulusanController::class, 'store'])->name('profillulusan.store');
    Route::get('/profillulusan/{id_pl}/edit', [AdminProfilLulusanController::class, 'edit'])->name('profillulusan.edit');
    Route::put('/profillulusan/{id_pl}', [AdminProfilLulusanController::class, 'update'])->name('profillulusan.update');
    Route::get('/profillulusan/{id_pl}/detail', [AdminProfilLulusanController::class, 'detail'])->name('profillulusan.detail');
    Route::delete('/profillulusan/{id_pl}', [AdminProfilLulusanController::class, 'destroy'])->name('profillulusan.destroy');

    Route::get('/capaianprofillulusan', [AdminCapaianProfilLulusanController::class, 'index'])->name('capaianprofillulusan.index');
    Route::get('/capaianprofillulusan/create', [AdminCapaianProfilLulusanController::class, 'create'])->name('capaianprofillulusan.create');
    Route::post('/capaianprofillulusan', [AdminCapaianProfilLulusanController::class, 'store'])->name('capaianprofillulusan.store');
    Route::get('/capaianprofillulusan/{id_cpl}/edit', [AdminCapaianProfilLulusanController::class, 'edit'])->name('capaianprofillulusan.edit');
    Route::put('/capaianprofillulusan/{id_cpl}', [AdminCapaianProfilLulusanController::class, 'update'])->name('capaianprofillulusan.update');
    Route::get('/capaianprofillulusan/{id_cpl}/detail', [AdminCapaianProfilLulusanController::class, 'detail'])->name('capaianprofillulusan.detail');
    Route::delete('/capaianprofillulusan/{id_cpl}', [AdminCapaianProfilLulusanController::class, 'destroy'])->name('capaianprofillulusan.destroy');
    
    Route::get('/pemetaancplpl', [AdminPemetaanCplPlController::class, 'index'])->name('pemetaancplpl.index');

    Route::get('/bahankajian', [AdminBahankajianController::class, 'index'])->name('bahankajian.index');
    Route::get('/bahankajian/create', [AdminBahankajianController::class, 'create'])->name('bahankajian.create');
    Route::post('/bahankajian', [AdminBahankajianController::class, 'store'])->name('bahankajian.store');
    Route::get('/bahankajian/{id_bk}/edit', [AdminBahankajianController::class, 'edit'])->name('bahankajian.edit');
    Route::put('/bahankajian/{id_bk}', [AdminBahankajianController::class, 'update'])->name('bahankajian.update');
    Route::get('/bahankajian/{id_bk}/detail', [AdminBahankajianController::class, 'detail'])->name('bahankajian.detail');
    Route::delete('/bahankajian/{id_bk}', [AdminBahankajianController::class,'destroy'])->name('bahankajian.destroy');

    Route::get('/pemetaancplbk', [AdminPemetaanCplBkController::class, 'index'])->name('pemetaancplbk.index');
    Route::post('/pemetaancplbk', [AdminPemetaanCplBkController::class, 'store'])->name('pemetaancplbk.store');
    
    Route::get('/matakuliah', [AdminMataKuliahController::class, 'index'])->name('matakuliah.index');
    Route::get('/matakuliah/create', [AdminMataKuliahController::class, 'create'])->name('matakuliah.create');
    Route::post('/matakuliah', [AdminMataKuliahController::class, 'store'])->name('matakuliah.store');
    Route::get('/matakuliah/{matakuliah}/edit', [AdminMataKuliahController::class, 'edit'])->name('matakuliah.edit');
    Route::put('/matakuliah/{matakuliah}', [AdminMataKuliahController::class, 'update'])->name('matakuliah.update');
    Route::delete('/matakuliah/{matakuliah}', [AdminMataKuliahController::class, 'destroy'])->name('matakuliah.destroy');
    Route::get('/matakuliah/{matakuliah}/detail', [AdminMataKuliahController::class, 'detail'])->name('matakuliah.detail');
    Route::get('/organisasimk', [AdminMataKuliahController::class, 'organisasi_mk'])->name('matakuliah.organisasimk');

    Route::get('/pemetaancplmk', [AdminPemetaanCplMkController::class, 'index'])->name('pemetaancplmk.index');
    Route::post('/pemetaancplmk', [AdminPemetaanCplMkController::class, 'store'])->name('pemetaancplmk.store');

    Route::get('/pemetaanbkmk', [AdminPemetaanBkMkController::class, 'index'])->name('pemetaanbkmk.index');
    Route::post('/pemetaanbkmk', [AdminPemetaanBkMkController::class, 'store'])->name('pemetaanbkmk.store');

    Route::get('/pemetaancplmkbk', [AdminPemetaanCplMkBkController::class, 'index'])->name('pemetaancplmkbk.index');
    Route::post('/pemetaancplmkbk', [AdminPemetaanCplMkBkController::class, 'store'])->name('pemetaancplmkbk.store');

    Route::get('/pendingusers', [SignUpController::class, 'pendingUsers'])->name('pendingusers.index');
    Route::put('/pendingusers/{id}/approve', [SignUpController::class, 'approveUser'])->name('pendingusers.approve');
    Route::delete('/pendingusers/{id}/reject', [SignUpController::class, 'rejectUser'])->name('pendingusers.reject');

    Route::get('/capaianpembelajaranmatakuliah', [AdminCapaianPembelajaranMataKuliahController::class, 'index'])->name('capaianpembelajaranmatakuliah.index');
    Route::get('/capaianpembelajaranmatakuliah/create', [AdminCapaianPembelajaranMataKuliahController::class, 'create'])->name('capaianpembelajaranmatakuliah.create');
    Route::post('/capaianpembelajaranmatakuliah', [AdminCapaianPembelajaranMataKuliahController::class, 'store'])->name('capaianpembelajaranmatakuliah.store');
    Route::get('/capaianpembelajaranmatakuliah/{id_cpmk}/edit', [AdminCapaianPembelajaranMataKuliahController::class, 'edit'])->name('capaianpembelajaranmatakuliah.edit');
    Route::put('/capaianpembelajaranmatakuliah/{id_cpmk}', [AdminCapaianPembelajaranMataKuliahController::class, 'update'])->name('capaianpembelajaranmatakuliah.update');

    Route::get('/pemetaancplcpmk',[AdminPemetaanCplCpmkController::class, 'index'])->name('pemetaancplcpmk.index');
    Route::get('/pemetaancplcpmkmk',[AdminPemetaanCplCpmkMkController::class, 'index'])->name('pemetaancplcpmkmk.index');

    Route::get('/pemenuhancpl',[AdminCapaianProfilLulusanController::class, 'peta_pemenuhan_cpl'])->name('pemenuhancpl.index');
});

Route::prefix('wadir1')->name('wadir1.')->group(function(){
    Route::get('/users', [Wadir1UserController::class, 'index'])->name('users.index');
    Route::get('/users/{id}/detail', [Wadir1UserController::class, 'detail'])->name('users.detail');
    Route::get('/dashboard', [Wadir1DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/jurusan', [Wadir1JurusanController::class, 'index'])->name('jurusan.index');
    Route::get('/jurusan/{jurusan}/detail', [Wadir1JurusanController::class, 'detail'])->name('jurusan.detail');
    Route::get('/prodi', [Wadir1ProdiController::class, 'index'])->name('prodi.index');
    Route::get('/prodi/{prodi}/detail', [Wadir1ProdiController::class,'detail'])->name('prodi.detail');
    Route::get('/profillulusan', [Wadir1ProfilLulusanController::class, 'index'])->name('profillulusan.index');
    Route::get('/profillulusan/{id_pl}/detail', [Wadir1ProfilLulusanController::class, 'detail'])->name('profillulusan.detail');
    Route::get('/capaianpembelajaranlulusan', [Wadir1CapaianPembelajaranLulusanController::class, 'index'])->name('capaianpembelajaranlulusan.index');
    Route::get('/capaianpembelajaranlulusan/{id_cpl}/detail', [Wadir1CapaianPembelajaranLulusanController::class, 'detail'])->name('capaianpembelajaranlulusan.detail');
    Route::get('/pemetaancplpl', [Wadir1CplPlController::class, 'index'])->name('pemetaancplpl.index');
    Route::get('/bahankajian', [Wadir1BahanKajianController::class, 'index'])->name('bahankajian.index');
    Route::get('/bahankajian/{id_bk}/detail', [Wadir1BahanKajianController::class, 'detail'])->name('bahankajian.detail');
    Route::get('/pemetaancplbk', [Wadir1PemetaanCplBkController::class, 'index'])->name('pemetaancplbk.index');
});

Route::prefix('kaprodi')->name('kaprodi.')->group(function(){
    Route::get('/dashboard', [KaprodiDashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/profillulusan', [KaprodiProfilLulusanController::class, 'index'])->name('profillulusan.index');
});

route::prefix('tim')->name('tim.')->group(function(){
    Route::get('/dashboard', [TimDashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/profillulusan', [TimProfilLulusanController::class, 'index'])->name('profillulusan.index');
    Route::get('/profillulusan/create', [TimProfilLulusanController::class, 'create'])->name('profillulusan.create');
    Route::post('/profillulusan', [TimProfilLulusanController::class, 'store'])->name('profillulusan.store');
    Route::get('/profillulusan/{id_pl}/edit',[TimProfilLulusanController::class,'edit'])->name('profillulusan.edit');
    Route::put('/profillulusan/{id_pl}',[TimProfilLulusanController::class, 'update'])->name('profillulusan.update');
    Route::get('/profillulusan/{id_pl}/detail',[TimProfilLulusanController::class, 'detail'])->name('profillulusan.detail');
    Route::delete('/profillulusan/{id_pl}',[TimProfilLulusanController::class,'destroy'])->name('profillulusan.destroy');
    Route::get('/capaianpembelajaranlulusan', [TimCapaianPembelajaranLulusanController::class, 'index'])->name('capaianpembelajaranlulusan.index');
    Route::get('/capaianpembelajaranlulusan/create', [TimCapaianPembelajaranLulusanController::class, 'create'])->name('capaianpembelajaranlulusan.create');
    Route::post('/capaianpembelajaranlulusan', [TimCapaianPembelajaranLulusanController::class, 'store'])->name('capaianpembelajaranlulusan.store');
    Route::get('/capaianpembelajaranlulusan/{id_cpl}/edit', [TimCapaianPembelajaranLulusanController::class, 'edit'])->name('capaianpembelajaranlulusan.edit');
    Route::put('/capaianpembelajaranlulusan/{id_cpl}', [TimCapaianPembelajaranLulusanController::class, 'update'])->name('capaianpembelajaranlulusan.update');
    Route::get('/capaianpembelajaranlulusan/{id_cpl}/detail', [TimCapaianPembelajaranLulusanController::class, 'detail'])->name('capaianpembelajaranlulusan.detail');
    Route::delete('/capaianpembelajaranlulusan/{id_cpl}', [TimCapaianPembelajaranLulusanController::class, 'destroy'])->name('capaianpembelajaranlulusan.destroy');
    Route::get('/pemetaancplpl', [TimPemetaanCplPlController::class, 'index'])->name('pemetaancplpl.index');
    Route::post('/pemetaancplpl', [TimPemetaanCplPlController::class, 'store'])->name('pemetaancplpl.store');
    Route::get('/bahankajian', [TimBahanKajianController::class, 'index'])->name('bahankajian.index');
    Route::get('/bahankajian/create', [TimBahanKajianController::class, 'create'])->name('bahankajian.create');
    Route::post('/bahankajian', [TimBahanKajianController::class, 'store'])->name('bahankajian.store');
    Route::get('/bahankajian/{id_bk}/edit', [TimBahanKajianController::class, 'edit'])->name('bahankajian.edit');
    Route::put('/bahankajian/{id_bk}', [TimBahanKajianController::class, 'update'])->name('bahankajian.update');
    Route::get('/bahankajian/{id_bk}/detail', [TimBahanKajianController::class, 'detail'])->name('bahankajian.detail');
    Route::delete('/bahankajian/{id_bk}', [TimBahanKajianController::class, 'destroy'])->name('bahankajian.destroy');
    Route::get('/pemetaancplbk', [TimPemetaanCplBkController::class, 'index'])->name('pemetaancplbk.index');
    Route::get('/matakuliah', [TimMataKuliahController::class, 'index'])->name('matakuliah.index');
    Route::get('/pemetaancplmk', [TimPemetaanCplMkController::class, 'index'])->name('pemetaancplmk.index');
    Route::get('/pemetaanbkmk', [TimPemetaanBkMkController::class, 'index'])->name('pemetaanbkmk.index');
    Route::get('/matakuliah/create', [TimMataKuliahController::class, 'create'])->name('matakuliah.create');
    Route::post('/matakuliah', [TimMataKuliahController::class, 'store'])->name('matakuliah.store');
    Route::get('/matakuliah/{matakuliah}/edit', [TimMataKuliahController::class, 'edit'])->name('matakuliah.edit');
    Route::put('/matakuliah/{matakuliah}', [TimMataKuliahController::class, 'update'])->name('matakuliah.update');
});