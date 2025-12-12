<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\KontakController;

// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// Profil
Route::get('/profil', [ProfilController::class, 'index'])->name('profil');

// Jurusan
Route::get('/jurusan', [JurusanController::class, 'index'])->name('jurusan.index');
Route::get('/jurusan/{slug}', [JurusanController::class, 'show'])->name('jurusan.show');

// Berita
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');

// Galeri
Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri');

// Kontak
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');
Route::post('/kontak', [KontakController::class, 'store'])->name('kontak.store');

// Search
Route::get('/search', [App\Http\Controllers\SearchController::class, 'index'])->name('search');

// Kelulusan Routes
Route::get('/kelulusan', [App\Http\Controllers\KelulusanController::class, 'index'])->name('kelulusan.index');
Route::post('/kelulusan/cek', [App\Http\Controllers\KelulusanController::class, 'cek'])->name('kelulusan.cek');
Route::get('/kelulusan/download/{id}', [App\Http\Controllers\KelulusanController::class, 'download'])->name('kelulusan.download');
