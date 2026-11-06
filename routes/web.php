<?php

use App\Http\Controllers\Admin\AdminAlumniController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminKuesionerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataAkademikController;
use App\Http\Controllers\KuisionerController;
use App\Http\Controllers\PerjalananKarirController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

// ══════════════════════════════════════════════════════
//  ALUMNI SECTION
// ══════════════════════════════════════════════════════

Route::get('/', fn () => redirect()->route('login'));

// Guest-only (alumni)
Route::middleware('guest:alumni')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/daftar', [RegisterController::class, 'showRegister'])->name('register');
    Route::post('/daftar', [RegisterController::class, 'register'])->name('register.post');

    Route::get('/lupa-password', [AuthController::class, 'showLupaPassword'])->name('lupa-password');
    Route::post('/lupa-password', [AuthController::class, 'lupaPassword'])->name('lupa-password.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected — Alumni
Route::middleware('auth:alumni')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // Data Akademik
    Route::get('/data-akademik/edit', [DataAkademikController::class, 'edit'])->name('data-akademik.edit');
    Route::post('/data-akademik/update', [DataAkademikController::class, 'update'])->name('data-akademik.update');

    // Perjalanan Karir
    Route::get('/perjalanan-karir', [PerjalananKarirController::class, 'index'])->name('karir');
    Route::post('/pekerjaan', [PerjalananKarirController::class, 'storePekerjaan'])->name('pekerjaan.store');
    Route::put('/pekerjaan/{pekerjaan}', [PerjalananKarirController::class, 'updatePekerjaan'])->name('pekerjaan.update');
    Route::delete('/pekerjaan/{pekerjaan}', [PerjalananKarirController::class, 'destroyPekerjaan'])->name('pekerjaan.destroy');
    Route::post('/pendidikan', [PerjalananKarirController::class, 'storePendidikan'])->name('pendidikan.store');
    Route::put('/pendidikan/{pendidikan}', [PerjalananKarirController::class, 'updatePendidikan'])->name('pendidikan.update');
    Route::delete('/pendidikan/{pendidikan}', [PerjalananKarirController::class, 'destroyPendidikan'])->name('pendidikan.destroy');
    Route::post('/wirausaha', [PerjalananKarirController::class, 'storeWirausaha'])->name('wirausaha.store');
    Route::put('/wirausaha/{wirausaha}', [PerjalananKarirController::class, 'updateWirausaha'])->name('wirausaha.update');
    Route::delete('/wirausaha/{wirausaha}', [PerjalananKarirController::class, 'destroyWirausaha'])->name('wirausaha.destroy');

    // Kuisioner
    Route::get('/kuisioner', [KuisionerController::class, 'index'])->name('kuisioner');
    Route::get('/kuisioner/isi', [KuisionerController::class, 'isi'])->name('kuisioner.isi');
    Route::post('/kuisioner/submit', [KuisionerController::class, 'submit'])->name('kuisioner.submit');
});

// ══════════════════════════════════════════════════════
//  ADMIN SECTION
// ══════════════════════════════════════════════════════

Route::prefix('admin')->name('admin.')->group(function () {

    // Guest-only (admin)
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');
    });

    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    // Protected — Admin
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Alumni management
        Route::get('/alumni', [AdminAlumniController::class, 'index'])->name('alumni.index');
        Route::get('/alumni/{alumni}', [AdminAlumniController::class, 'show'])->name('alumni.show');
        Route::get('/alumni/{alumni}/edit', [AdminAlumniController::class, 'edit'])->name('alumni.edit');
        Route::put('/alumni/{alumni}', [AdminAlumniController::class, 'update'])->name('alumni.update');
        Route::delete('/alumni/{alumni}', [AdminAlumniController::class, 'destroy'])->name('alumni.destroy');
        Route::post('/alumni/{alumni}/reset-password', [AdminAlumniController::class, 'resetPassword'])->name('alumni.reset-password');

        // Kuesioner management
        Route::get('/kuesioner', [AdminKuesionerController::class, 'index'])->name('kuesioner.index');
        Route::get('/kuesioner/create', [AdminKuesionerController::class, 'create'])->name('kuesioner.create');
        Route::post('/kuesioner', [AdminKuesionerController::class, 'store'])->name('kuesioner.store');
        Route::get('/kuesioner/{kuesioner}/edit', [AdminKuesionerController::class, 'edit'])->name('kuesioner.edit');
        Route::put('/kuesioner/{kuesioner}', [AdminKuesionerController::class, 'update'])->name('kuesioner.update');
        Route::delete('/kuesioner/{kuesioner}', [AdminKuesionerController::class, 'destroy'])->name('kuesioner.destroy');
        Route::post('/kuesioner/{kuesioner}/toggle-aktif', [AdminKuesionerController::class, 'toggleAktif'])->name('kuesioner.toggle-aktif');

        // Pertanyaan
        Route::get('/kuesioner/{kuesioner}/pertanyaan', [AdminKuesionerController::class, 'pertanyaan'])->name('kuesioner.pertanyaan');
        Route::post('/kuesioner/{kuesioner}/pertanyaan', [AdminKuesionerController::class, 'storePertanyaan'])->name('kuesioner.pertanyaan.store');
        Route::put('/kuesioner/{kuesioner}/pertanyaan/{pertanyaan}', [AdminKuesionerController::class, 'updatePertanyaan'])->name('kuesioner.pertanyaan.update');
        Route::delete('/kuesioner/{kuesioner}/pertanyaan/{pertanyaan}', [AdminKuesionerController::class, 'destroyPertanyaan'])->name('kuesioner.pertanyaan.destroy');

        // Monitoring
        Route::get('/kuesioner/{kuesioner}/monitoring', [AdminKuesionerController::class, 'monitoring'])->name('kuesioner.monitoring');
        Route::get('/kuesioner/{kuesioner}/jawaban/{jawaban}', [AdminKuesionerController::class, 'detailJawaban'])->name('kuesioner.detail-jawaban');
    });
});
