<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\LokasiController;
use App\Http\Controllers\Admin\PengaduanController as AdminPengaduanController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Siswa\DashboardController as SiswaDashboardController;
use App\Http\Controllers\Siswa\PanduanController as SiswaPanduanController;
use App\Http\Controllers\Siswa\PengaduanController as SiswaPengaduanController;
use App\Http\Controllers\Teknisi\DashboardController as TeknisiDashboardController;
use App\Http\Controllers\Teknisi\TugasController as TeknisiTugasController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect(route(Auth::user()->homeRoute()));
    }

    return redirect()->route('login');
});

// ===== Guest (belum login) =====
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});

Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth')->name('logout');

// ===== Profil (shared, semua role login) =====
Route::middleware('auth')->group(function () {
    Route::get('/profil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profil', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profil/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});

// ===== Siswa =====
Route::middleware(['auth', 'role:siswa'])->prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/dashboard', [SiswaDashboardController::class, 'index'])->name('dashboard');
    Route::get('/panduan', [SiswaPanduanController::class, 'index'])->name('panduan');

    Route::get('/pengaduan', [SiswaPengaduanController::class, 'index'])->name('pengaduan.index');
    Route::get('/pengaduan/buat', [SiswaPengaduanController::class, 'create'])->name('pengaduan.create');
    Route::post('/pengaduan', [SiswaPengaduanController::class, 'store'])->name('pengaduan.store');
    Route::get('/pengaduan/{pengaduan}', [SiswaPengaduanController::class, 'show'])->name('pengaduan.show');
});

// ===== Teknisi =====
Route::middleware(['auth', 'role:teknisi'])->prefix('teknisi')->name('teknisi.')->group(function () {
    Route::get('/dashboard', [TeknisiDashboardController::class, 'index'])->name('dashboard');

    Route::get('/tugas', [TeknisiTugasController::class, 'index'])->name('tugas.index');
    Route::get('/tugas/{pengaduan}', [TeknisiTugasController::class, 'show'])->name('tugas.show');
    Route::post('/tugas/{pengaduan}/mulai', [TeknisiTugasController::class, 'mulai'])->name('tugas.mulai');
    Route::post('/tugas/{pengaduan}/catatan', [TeknisiTugasController::class, 'catatan'])->name('tugas.catatan');
    Route::post('/tugas/{pengaduan}/selesai', [TeknisiTugasController::class, 'selesai'])->name('tugas.selesai');
    Route::post('/tugas/{pengaduan}/kembalikan', [TeknisiTugasController::class, 'kembalikan'])->name('tugas.kembalikan');

    Route::get('/riwayat', [TeknisiTugasController::class, 'riwayat'])->name('riwayat');
});

// ===== Admin =====
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/pengaduan', [AdminPengaduanController::class, 'index'])->name('pengaduan.index');
    Route::get('/pengaduan/{pengaduan}', [AdminPengaduanController::class, 'show'])->name('pengaduan.show');
    Route::patch('/pengaduan/{pengaduan}/status', [AdminPengaduanController::class, 'updateStatus'])->name('pengaduan.status');
    Route::patch('/pengaduan/{pengaduan}/teknisi', [AdminPengaduanController::class, 'tugaskanTeknisi'])->name('pengaduan.teknisi');

    Route::resource('kategori', KategoriController::class)->except(['show']);
    Route::resource('lokasi', LokasiController::class)->except(['show']);
    Route::resource('user', UserController::class)->except(['show']);

    Route::get('/pengaturan', [PengaturanController::class, 'edit'])->name('pengaturan.edit');
    Route::put('/pengaturan', [PengaturanController::class, 'update'])->name('pengaturan.update');
    Route::post('/pengaturan/reset', [PengaturanController::class, 'reset'])->name('pengaturan.reset');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/export', [LaporanController::class, 'exportExcel'])->name('laporan.export');
    Route::get('/laporan/print', [LaporanController::class, 'print'])->name('laporan.print');
});
