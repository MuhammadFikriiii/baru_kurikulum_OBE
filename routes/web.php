<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\AdminProdiController;
use App\Http\Controllers\AdminProfilLulusanController;
use App\Http\Controllers\AdminCapaianProfilLulusanController;
use App\Http\Controllers\Wadir1ProdiController;
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
use App\Http\Controllers\AdminSubCpmkController;
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
use App\Http\Controllers\AdminPemetaanCplCpmkMkController;
use App\Http\Controllers\TimExportController;
use App\Http\Controllers\TimPemetaanBkMkController;
use App\Http\Controllers\TimPemetaanCplMkController;
use App\Http\Controllers\TimPemetaanCplMkBkController;
use App\Http\Controllers\TimCapaianPembelajaranMataKuliahController;
use App\Http\Controllers\TimPemetaanCplCpmkMkController;
use App\Http\Controllers\TimSubCpmkController;
use App\Http\Controllers\KaprodiCapaianPembelajaranLulusanController;
use App\Http\Controllers\KaprodiPemetaanCplPlController;
use App\Http\Controllers\KaprodiBahanKajianController;
use App\Http\Controllers\KaprodiPemetaanCplBkController;
use App\Http\Controllers\KaprodiPemetaanBkMkController;
use App\Http\Controllers\KaprodiPemetaanCplMkController;
use App\Http\Controllers\KaprodiPemetaanCplMkBkController;
use App\Http\Controllers\KaprodiMataKuliahController;
use App\Http\Controllers\KaprodiPemetaanCplCpmkMkController;
use App\Http\Controllers\KaprodiCapaianPembelajaranMataKuliahController;
use App\Http\Controllers\KaprodiSubCpmkController;
use App\Http\Controllers\KaprodiPenilaianController;
use App\Http\Controllers\Wadir1MataKuliahController;
use App\Http\Controllers\Wadir1PemetaanCplMkController;
use App\Http\Controllers\Wadir1PemetaanBkMkController;
use App\Http\Controllers\Wadir1PemetaanCplBkMkController;
use App\Http\Controllers\Wadir1CapaianPembelajaranMataKuliahController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\Wadir1NotesController;
use App\Http\Controllers\AdminTahunController;
use App\Http\Controllers\TimTahunController;
use App\Http\Controllers\AdminBobotController;
use App\Http\Controllers\AdminNotesController;
use App\Http\Controllers\Wadir1BobotController;
use App\Http\Controllers\TimBobotController;
use App\Http\Controllers\KaprodiBobotController;
use App\Http\Controllers\KaprodiNotesController;
use App\Http\Controllers\TimNotesController;
use App\Http\Controllers\KaprodiTahunController;
use App\Http\Controllers\Wadir1TahunController;
use App\Http\Controllers\Wadir1SubCpmkController;
use App\Http\Controllers\Wadir1PemetaanCplCpmkMkController;
use App\Http\Controllers\AdminVisiMisiController;
use App\Http\Controllers\ExportKptController;

// Rute untuk tamu (guest)
Route::middleware(['guest'])->group(function () {
    // Auth
    Route::get('/login', [LoginController::class, 'loginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
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
   Route::get('/', [HomepageController::class, 'homepage'])->name('homepage');
});

// Rute yang memerlukan autentikasi
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
        Route::get('/export/kpt', [ExportKptController::class, 'export'])->name('export.kpt');
    // Grup Route Admin
    Route::prefix('admin')->name('admin.')->middleware(['auth.admin'])->group(function () {
        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [AdminUserController::class, 'create'])->name('users.create');
        Route::post('/users', [AdminUserController::class, 'store'])->name('users.store');
        Route::get('/users/{id}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{id}', [AdminUserController::class, 'update'])->name('users.update');
        Route::get('/users/{id}/detail', [AdminUserController::class, 'details'])->name('users.detail');
        Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])->name('users.destroy');

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

        Route::get('/tahun', [AdminTahunController::class, 'index'])->name('tahun.index');
        Route::get('/tahun/create', [AdminTahunController::class, 'create'])->name('tahun.create');
        Route::post('/tahun', [AdminTahunController::class, 'store'])->name('tahun.store');
        Route::get('/tahun/{id_tahun}/edit', [AdminTahunController::class, 'edit'])->name('tahun.edit');
        Route::put('/tahun/{id_tahun}', [AdminTahunController::class, 'update'])->name('tahun.update');
        Route::delete('/tahun/{id_tahun}', [AdminTahunController::class, 'destroy'])->name('tahun.destroy');

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
        Route::delete('/bahankajian/{id_bk}', [AdminBahankajianController::class, 'destroy'])->name('bahankajian.destroy');

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

        Route::get('/pendingusers', [AdminUserController::class, 'pendingUsers'])->name('pendingusers.index');
        Route::put('/pendingusers/{id}/approve', [AdminUserController::class, 'approveUser'])->name('pendingusers.approve');
        Route::delete('/pendingusers/{id}/reject', [AdminUserController::class, 'rejectUser'])->name('pendingusers.reject');

        Route::get('/capaianpembelajaranmatakuliah', [AdminCapaianPembelajaranMataKuliahController::class, 'index'])->name('capaianpembelajaranmatakuliah.index');
        Route::get('/capaianpembelajaranmatakuliah/create', [AdminCapaianPembelajaranMataKuliahController::class, 'create'])->name('capaianpembelajaranmatakuliah.create');
        Route::post('/capaianpembelajaranmatakuliah', [AdminCapaianPembelajaranMataKuliahController::class, 'store'])->name('capaianpembelajaranmatakuliah.store');
        Route::get('/capaianpembelajaranmatakuliah/{id_cpmk}/edit', [AdminCapaianPembelajaranMataKuliahController::class, 'edit'])->name('capaianpembelajaranmatakuliah.edit');
        Route::put('/capaianpembelajaranmatakuliah/{id_cpmk}', [AdminCapaianPembelajaranMataKuliahController::class, 'update'])->name('capaianpembelajaranmatakuliah.update');
        Route::get('/capaianpembelejaranmatakuliah/{id_cpmk}/detail', [AdminCapaianPembelajaranMataKuliahController::class, 'detail'])->name('capaianpembelajaranmatakuliah.detail');
        Route::delete('/capaianpembelajaranmatakuliah/{id_cpmk}', [AdminCapaianPembelajaranMataKuliahController::class, 'destroy'])->name('capaianpembelajaranmatakuliah.destroy');

        Route::get('/subcpmk', [AdminSubCpmkController::class, 'index'])->name('subcpmk.index');
        Route::get('/subcpmk/create', [AdminSubCpmkController::class, 'create'])->name('subcpmk.create');
        Route::post('/subcpmk', [AdminSubCpmkController::class, 'store'])->name('subcpmk.store');
        Route::get('/subcpmk/{subcpmk}/edit', [AdminSubCpmkController::class, 'edit'])->name('subcpmk.edit');
        Route::put('/subcpmk/{subcpmk}', [AdminSubCpmkController::class, 'update'])->name('subcpmk.update');
        Route::delete('/subcpmk/{subcpmk}', [AdminSubCpmkController::class, 'destroy'])->name('subcpmk.destroy');
        Route::get('/subcpmk/{subcpmk}/detail', [AdminSubCpmkController::class, 'detail'])->name('subcpmk.detail');
        Route::get('/pemetaancplcpmkmk', [AdminPemetaanCplCpmkMkController::class, 'index'])->name('pemetaancplcpmkmk.index');
        Route::get('/pemetaanmkcplcpmk', [AdminPemetaanCplCpmkMkController::class, 'pemetaanmkcpmkcpl'])->name('pemetaancplcpmkmk.pemetaanmkcplcpmk');
        Route::get('/pemenuhancpl', [AdminCapaianProfilLulusanController::class, 'peta_pemenuhan_cpl'])->name('pemenuhancpl.index');
        Route::get('/pemenuhancplcpmkmk', [AdminPemetaanCplCpmkMkController::class, 'pemenuhancplcpmkmk'])->name('pemetaancplcpmkmk.pemenuhancplcpmkmk');
        Route::get('/pemetaanmkcpmkcpl', [AdminPemetaanCplCpmkMkController::class, 'pemetaanmkcpmkcpl'])->name('pemetaancplcpmkmk.pemetaanmkcpmkcpl');
        Route::get('/pemetaanmkcpmksubcpmk', [AdminSubCpmkController::class, 'pemetaanmkcpmksubcpmk'])->name('pemetaanmkcpmksubcpmk.index');
        Route::get('/export/excel', [TimExportController::class, 'export'])->name('export.excel');
        Route::post('/ajax/get-cpl-by-bk', [AdminMataKuliahController::class, 'getCplByBk'])->name('matakuliah.getCplByBk');
        Route::post('/ajax/get-cpmk-by-bk', [AdminSubCpmkController::class, 'getCpmkByMataKuliah'])->name('subcpmk.getCpmkByMataKuliah');
        Route::post('/ajax/get-cpl-by-mk', [AdminCapaianPembelajaranMataKuliahController::class, 'getMkByCpl'])->name('capaianpembelajaranmatakuliah.getMKByCPL');
        Route::get('/bobot/create', [AdminBobotController::class, 'create'])->name('bobot.create');
        Route::post('/bobot', [AdminBobotController::class, 'store'])->name('bobot.store');
        Route::get('/bobot', [AdminBobotController::class, 'index'])->name('bobot.index');
        Route::get('/bobot/{bobot}/edit', [AdminBobotController::class, 'edit'])->name('bobot.edit');
        Route::put('/bobot/{bobot}', [AdminBobotController::class, 'update'])->name('bobot.update');
        Route::get('/bobot/{bobot}/detail', [AdminBobotController::class, 'detail'])->name('bobot.detail');
        Route::delete('/bobot/{bobot}', [AdminBobotController::class, 'destroy'])->name('bobot.destroy');
        Route::post('ajax-getmkbycpl', [AdminBobotController::class, 'getmkbycpl'])->name('bobot.getmkbycpl');
        Route::get('/notes', [AdminNotesController::class, 'index'])->name('notes.index');
        Route::get('/notes/{note}/detail', [AdminNotesController::class, 'detail'])->name('notes.detail');
        Route::get('/visimisi/create', [AdminVisiMisiController::class, 'create'])->name('visimisi.create');
        Route::post('/visimisi', [AdminVisiMisiController::class, 'store'])->name('visimisi.store');
        Route::get('/visimisi', [AdminVisiMisiController::class, 'index'])->name('visi_misi.index');
        Route::get('/visimisi/{visi_misi}/edit', [AdminVisiMisiController::class, 'edit'])->name('visimisi.edit');
        Route::put('/visimisi/{visi_misi}', [AdminVisiMisiController::class, 'update'])->name('visimisi.update');
        Route::get('/visimisi/{visi_misi}/detail', [AdminVisiMisiController::class, 'detail'])->name('visimisi.detail');
        Route::delete('/visimisi/{visi_misi}', [AdminVisiMisiController::class, 'destroy'])->name('visimisi.destroy');
    });

    // Grup Route Wadir1
    Route::prefix('wadir1')->name('wadir1.')->middleware(['auth.wadir1'])->group(function () {
        Route::get('/users', [Wadir1UserController::class, 'index'])->name('users.index');
        Route::get('/users/{id}/detail', [Wadir1UserController::class, 'detail'])->name('users.detail');
        Route::get('/dashboard', [Wadir1DashboardController::class, 'dashboard'])->name('dashboard');
        Route::get('/jurusan', [Wadir1JurusanController::class, 'index'])->name('jurusan.index');
        Route::get('/jurusan/{jurusan}/detail', [Wadir1JurusanController::class, 'detail'])->name('jurusan.detail');
        Route::get('/prodi', [Wadir1ProdiController::class, 'index'])->name('prodi.index');
        Route::get('/prodi/{prodi}/detail', [Wadir1ProdiController::class, 'detail'])->name('prodi.detail');
        Route::get('/profillulusan', [Wadir1ProfilLulusanController::class, 'index'])->name('profillulusan.index');
        Route::get('/profillulusan/{id_pl}/detail', [Wadir1ProfilLulusanController::class, 'detail'])->name('profillulusan.detail');
        Route::get('/capaianpembelajaranlulusan', [Wadir1CapaianPembelajaranLulusanController::class, 'index'])->name('capaianpembelajaranlulusan.index');
        Route::get('/capaianpembelajaranlulusan/{id_cpl}/detail', [Wadir1CapaianPembelajaranLulusanController::class, 'detail'])->name('capaianpembelajaranlulusan.detail');
        Route::get('/pemetaancplpl', [Wadir1CplPlController::class, 'index'])->name('pemetaancplpl.index');
        Route::get('/bahankajian', [Wadir1BahanKajianController::class, 'index'])->name('bahankajian.index');
        Route::get('/bahankajian/{id_bk}/detail', [Wadir1BahanKajianController::class, 'detail'])->name('bahankajian.detail');
        Route::get('/pemetaancplbk', [Wadir1PemetaanCplBkController::class, 'index'])->name('pemetaancplbk.index');
        Route::get('/matakuliah', [Wadir1MataKuliahController::class, 'index'])->name('matakuliah.index');
        Route::get('/matakuliah/{matakuliah}/detail', [Wadir1MataKuliahController::class, 'detail'])->name('matakuliah.detail');
        Route::get('/pemetaancplmk', [Wadir1PemetaanCplMkController::class, 'index'])->name('pemetaancplmk.index');
        Route::get('/pemetaanbkmk', [Wadir1PemetaanBkMkController::class, 'index'])->name('pemetaanbkmk.index');
        Route::get('/pemetaancplmkbk', [Wadir1PemetaanCplBkMkController::class, 'index'])->name('pemetaancplmkbk.index');
        Route::get('/organisasimk', [Wadir1MataKuliahController::class, 'organisasi_mk'])->name('matakuliah.organisasimk');
        Route::get('/capaianpembelajaranmatakuliah', [Wadir1CapaianPembelajaranMatakuliahController::class, 'index'])->name('capaianpembelajaranmatakuliah.index');
        Route::get('/capaianpembelajaranmatakuliah/{id_cpmk}/detail', [Wadir1CapaianPembelajaranMatakuliahController::class, 'detail'])->name('capaianpembelajaranmatakuliah.detail');
        Route::get('/export/excel', [TimExportController::class, 'export'])->name('export.excel');
        //catatan
        Route::get('/notes', [Wadir1NotesController::class, 'index'])->name('notes.index');
        Route::get('/notes/create', [Wadir1NotesController::class, 'create'])->name('notes.create');
        Route::post('/notes', [Wadir1NotesController::class, 'store'])->name('notes.store');
        Route::delete('/notes/{note}', [Wadir1NotesController::class, 'destroy'])->name('notes.destroy');
        
        Route::resource('notes', Wadir1NotesController::class);
        Route::get('/notes/{note}/detail', [Wadir1NotesController::class, 'detail'])->name('notes.detail');
        Route::get('/notes/{note}/edit', [Wadir1NotesController::class, 'edit'])->name('notes.edit');
        Route::put('/notes/{note}', [Wadir1NotesController::class, 'update'])->name('notes.update');
        Route::delete('/notes/{note}', [Wadir1NotesController::class, 'destroy'])->name('notes.destroy');

        Route::get('/bobot', [Wadir1BobotController::class, 'index'])->name('bobot.index');
        Route::get('/bobot/{bobot}/detail', [Wadir1BobotController::class, 'detail'])->name('bobot.detail');
        Route::get('/tahun', [Wadir1TahunController::class, 'index'])->name('tahun.index');
        Route::get('/subcpmk', [Wadir1SubCpmkController::class, 'index'])->name('subcpmk.index');
        Route::get('/subcpmk/{subcpmk}/detail', [Wadir1SubCpmkController::class, 'detail'])->name('subcpmk.detail');
        Route::get('/pemetaancplcpmkmk', [Wadir1PemetaanCplCpmkMkController::class, 'index'])->name('pemetaancplcpmkmk.index');
        Route::get('/pemetaanmkcplcpmk', [Wadir1PemetaanCplCpmkMkController::class, 'pemetaanmkcpmkcpl'])->name('pemetaancplcpmkmk.pemetaanmkcplcpmk');
        Route::get('/pemenuhancpl', [Wadir1CapaianPembelajaranLulusanController::class, 'peta_pemenuhan_cpl'])->name('pemenuhancpl.index');
        Route::get('/pemenuhancplcpmkmk', [Wadir1PemetaanCplCpmkMkController::class, 'pemenuhancplcpmkmk'])->name('pemetaancplcpmkmk.pemenuhancplcpmkmk');
        Route::get('/pemetaanmkcpmkcpl', [Wadir1PemetaanCplCpmkMkController::class, 'pemetaanmkcpmkcpl'])->name('pemetaancplcpmkmk.pemetaanmkcpmkcpl');
        Route::get('/pemetaanmkcpmksubcpmk', [Wadir1SubCpmkController::class, 'pemetaanmkcpmksubcpmk'])->name('pemetaanmkcpmksubcpmk.index');
    });

    // Grup Route Kaprodi
    Route::prefix('kaprodi')->name('kaprodi.')->middleware(['auth.kaprodi'])->group(function () {
        Route::get('/dashboard', [KaprodiDashboardController::class, 'dashboard'])->name('dashboard');
        Route::get('/profillulusan', [KaprodiProfilLulusanController::class, 'index'])->name('profillulusan.index');
        Route::get('/profillulusan/{id_pl}/detail', [KaprodiProfilLulusanController::class, 'detail'])->name('profillulusan.detail');
        Route::get('/capaianpembelajaranlulusan', [KaprodiCapaianPembelajaranLulusanController::class, 'index'])->name('capaianpembelajaranlulusan.index');
        Route::get('/capaianpembelajaranlulusan/{id_cpl}/detail', [KaprodiCapaianPembelajaranLulusanController::class, 'detail'])->name('capaianpembelajaranlulusan.detail');
        Route::get('/pemetaancplpl', [KaprodiPemetaanCplPlController::class, 'index'])->name('pemetaancplpl.index');
        Route::get('/bahankajian', [KaprodiBahanKajianController::class, 'index'])->name('bahankajian.index');
        Route::get('/bahankajian/{id_bk}/detail', [KaprodiBahanKajianController::class, 'detail'])->name('bahankajian.detail');
        Route::get('/pemetaancplbk', [KaprodiPemetaanCplBkController::class, 'index'])->name('pemetaancplbk.index');
        Route::get('/pemetaanbkmk', [KaprodiPemetaanBkMkController::class, 'index'])->name('pemetaanbkmk.index');
        Route::get('/pemetaancplmk', [KaprodiPemetaanCplMkController::class, 'index'])->name('pemetaancplmk.index');
        Route::get('/pemetaancplmkbk', [KaprodiPemetaanCplMkBkController::class, 'index'])->name('pemetaancplmkbk.index');
        Route::get('/matakuliah', [KaprodiMataKuliahController::class, 'index'])->name('matakuliah.index');
        Route::get('/matakuliah/{matakuliah}/detail', [KaprodiMataKuliahController::class, 'detail'])->name('matakuliah.detail');
        Route::get('/organisasimk', [KaprodiMataKuliahController::class, 'organisasi_mk'])->name('matakuliah.organisasimk');
        Route::get('/capaianpembelajaranmatakuliah', [KaprodiCapaianPembelajaranMatakuliahController::class, 'index'])->name('capaianpembelajaranmatakuliah.index');
        Route::get('/capaianpembelajaranmatakuliah/{id_cpmk}/detail', [KaprodiCapaianPembelajaranMatakuliahController::class, 'detail'])->name('capaianpembelajaranmatakuliah.detail');
        Route::get('/pemenuhancpl', [KaprodiCapaianPembelajaranLulusanController::class, 'pemenuhan_cpl'])->name('pemenuhancpl.index');
        Route::get('/pemetaancplcpmkmk', [KaprodiPemetaanCplCpmkMkController::class, 'index'])->name('pemetaancplcpmkmk.index');
        Route::get('/pemenuhancplcpmkmk', [KaprodiPemetaanCplCpmkMkController::class, 'pemenuhancplcpmkmk'])->name('pemetaancplcpmkmk.pemenuhancplcpmkmk');
        Route::get('/pemetaanmkcpmkcpl', [KaprodiPemetaanCplCpmkMkController::class, 'pemetaanmkcplcpmk'])->name('pemetaancplcpmkmk.pemetaanmkcplcpmk');
        Route::get('/subcpmk', [KaprodiSubCpmkController::class, 'index'])->name('subcpmk.index');
        Route::get('/subcpmk/{id_sub_cpmk}/detail', [KaprodiSubCpmkController::class, 'detail'])->name('subcpmk.detail');
        Route::get('/pemetaanmkcpmksubcpmk', [KaprodiSubCpmkController::class, 'pemetaanmkcpmksubcpmk'])->name('pemetaanmkcpmksubcpmk.index');
        Route::get('/bobot', [KaprodiBobotController::class, 'index'])->name('bobot.index');
        Route::get('/bobot/{bobot}/detail', [KaprodiBobotController::class, 'detail'])->name('bobot.detail');
        Route::get('/export/excel', [TimExportController::class, 'export'])->name('export.excel');
        Route::get('/notes', [KaprodiNotesController::class, 'index'])->name('notes.index');
        Route::get('/notes/create', [KaprodiNotesController::class, 'create'])->name('notes.create');
        Route::post('/notes', [KaprodiNotesController::class, 'store'])->name('notes.store');
        Route::get('/notes/{note}/detail', [KaprodiNotesController::class, 'detail'])->name('notes.detail');
        Route::get('/notes/{note}/edit', [KaprodiNotesController::class, 'edit'])->name('notes.edit');
        Route::put('/notes/{note}', [KaprodiNotesController::class, 'update'])->name('notes.update');
        Route::delete('/notes/{note}', [KaprodiNotesController::class, 'destroy'])->name('notes.destroy');
        Route::get('/tahun', [KaprodiTahunController::class, 'index'])->name('tahun.index');
    });

    // Grup Route Tim
    Route::prefix('tim')->name('tim.')->middleware(['auth.tim'])->group(function () {
        Route::get('/dashboard', [TimDashboardController::class, 'dashboard'])->name('dashboard');
        Route::get('/profillulusan', [TimProfilLulusanController::class, 'index'])->name('profillulusan.index');
        Route::get('/profillulusan/create', [TimProfilLulusanController::class, 'create'])->name('profillulusan.create');
        Route::post('/profillulusan', [TimProfilLulusanController::class, 'store'])->name('profillulusan.store');
        Route::get('/profillulusan/{id_pl}/edit', [TimProfilLulusanController::class, 'edit'])->name('profillulusan.edit');
        Route::put('/profillulusan/{id_pl}', [TimProfilLulusanController::class, 'update'])->name('profillulusan.update');
        Route::get('/profillulusan/{id_pl}/detail', [TimProfilLulusanController::class, 'detail'])->name('profillulusan.detail');
        Route::delete('/profillulusan/{id_pl}', [TimProfilLulusanController::class, 'destroy'])->name('profillulusan.destroy');
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
        Route::get('/matakuliah/{matakuliah}/detail', [TimMataKuliahController::class, 'detail'])->name('matakuliah.detail');
        Route::delete('/matakuliah/{matakuliah}', [TimMataKuliahController::class, 'destroy'])->name('matakuliah.destroy');
        Route::get('/organisasimk', [TimMataKuliahController::class, 'organisasi_mk'])->name('matakuliah.organisasimk');
        Route::get('/pemetaancplmkbk', [TimPemetaanCplMkBkController::class, 'index'])->name('pemetaancplmkbk.index');
        Route::get('/export/excel', [TimExportController::class, 'export'])->name('export.excel');
        Route::get('/capaianpembelajaranmatakuliah', [TimCapaianPembelajaranMatakuliahController::class, 'index'])->name('capaianpembelajaranmatakuliah.index');
        Route::get('/capaianpembelajaranmatakuliah/create', [TimCapaianPembelajaranMataKuliahController::class, 'create'])->name('capaianpembelajaranmatakuliah.create');
        Route::post('/capaianpembelajaranmatakuliah', [TimCapaianPembelajaranMataKuliahController::class, 'store'])->name('capaianpembelajaranmatakuliah.store');
        Route::get('/capaianpembelajaranmatakuliah/{id_cpmk}/edit', [TimCapaianPembelajaranMataKuliahController::class, 'edit'])->name('capaianpembelajaranmatakuliah.edit');
        Route::put('/capaianpembelajaranmatakuliah/{id_cpmk}', [TimCapaianPembelajaranMataKuliahController::class, 'update'])->name('capaianpembelajaranmatakuliah.update');
        Route::get('/capaianpembelajaranmatakuliah/{id_cpmk}/detail', [TimCapaianPembelajaranMataKuliahController::class, 'detail'])->name('capaianpembelajaranmatakuliah.detail');
        Route::delete('/capaianpembelajaranmatakuliah/{id_cpmk}', [TimCapaianPembelajaranMataKuliahController::class, 'destroy'])->name('capaianpembelajaranmatakuliah.destroy');
        Route::get('/pemetaancplcpmkmk', [TimPemetaanCplCpmkMkController::class, 'index'])->name('pemetaancplcpmkmk.index');
        Route::get('/pemenuhancpl', [TimCapaianPembelajaranLulusanController::class, 'pemenuhan_cpl'])->name('pemenuhancpl.index');
        Route::get('/subcpmk', [TimSubCpmkController::class, 'index'])->name('subcpmk.index');
        Route::get('/subcpmk/create', [TimSubCpmkController::class, 'create'])->name('subcpmk.create');
        Route::post('/subcpmk', [TimSubCpmkController::class, 'store'])->name('subcpmk.store');
        Route::get('/subcpmk/{id_sub_cpmk}/edit', [TimSubCpmkController::class, 'edit'])->name('subcpmk.edit');
        Route::put('/subcpmk/{id_sub_cpmk}', [TimSubCpmkController::class, 'update'])->name('subcpmk.update');
        Route::get('/subcpmk/{id_sub_cpmk}/detail', [TimSubCpmkController::class, 'detail'])->name('subcpmk.detail');
        Route::get('/pemenuhancplcpmkmk', [TimPemetaanCplCpmkMkController::class, 'pemenuhancplcpmkmk'])->name('pemetaancplcpmkmk.pemenuhancplcpmkmk');
        Route::get('/pemetaanmkcpmkcpl', [TimPemetaanCplCpmkMkController::class, 'pemetaanmkcplcpmk'])->name('pemetaancplcpmkmk.pemetaanmkcplcpmk');
        Route::get('/pemetaanmkcpmksubcpmk', [TimSubCpmkController::class, 'pemetaanmkcpmksubcpmk'])->name('pemetaanmkcpmksubcpmk.index');
        Route::post('/ajax/get-cpl-by-bk', [TimMataKuliahController::class, 'getCplByBk'])->name('matakuliah.getCplByBk');
        Route::post('/ajax/get-mk-by-cpl', [TimCapaianPembelajaranMataKuliahController::class, 'getMKByCPL'])->name('capaianpembelajaranmatakuliah.getMKByCPL');
        Route::get('/tahun', [TimTahunController::class, 'index'])->name('tahun.index');
        Route::get('/tahun/create', [TimTahunController::class, 'create'])->name('tahun.create');
        Route::post('/tahun', [TimTahunController::class, 'store'])->name('tahun.store');
        Route::get('/tahun/{id_tahun}/edit', [TimTahunController::class, 'edit'])->name('tahun.edit');
        Route::put('/tahun/{id_tahun}', [TimTahunController::class, 'update'])->name('tahun.update');
        Route::delete('/tahun/{id_tahun}', [TimTahunController::class, 'destroy'])->name('tahun.destroy');
        Route::get('/bobot', [TimBobotController::class, 'index'])->name('bobot.index');
        Route::get('/bobot/create', [TimBobotController::class, 'create'])->name('bobot.create');
        Route::post('/bobot', [TimBobotController::class, 'store'])->name('bobot.store');
        Route::get('/bobot/{bobot}/edit', [TimBobotController::class, 'edit'])->name('bobot.edit');
        Route::put('/bobot/{bobot}', [TimBobotController::class, 'update'])->name('bobot.update');
        Route::get('/bobot/{bobot}/detail', [TimBobotController::class, 'detail'])->name('bobot.detail');
        Route::delete('/bobot/{bobot}', [TimBobotController::class, 'destroy'])->name('bobot.destroy');
        Route::post('ajax-getmkbycpl', [TimBobotController::class, 'getmkbycpl'])->name('bobot.getmkbycpl');
        Route::get('/notes', [TimNotesController::class, 'index'])->name('notes.index');
        Route::get('/notes/{note}/detail', [TimNotesController::class, 'detail'])->name('notes.detail');
        Route::get('/subcpmk/getMkByCpmk', [TimSubCpmkController::class, 'getMkByCpmk'])->name('subcpmk.getMkByCpmk');
        Route::delete('/subcpmk/{id}', [TimSubCpmkController::class, 'destroy'])->name('subcpmk.destroy');
    });
});
