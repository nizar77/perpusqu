<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KelasController;

Route::get('/', function () {
    return view('layouts.app1');
});

Route::get('/data-siswa', function () {
    return view('siswa.index');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/depan', function () {
    return view('dashboard.index');
});
Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog');

// Route::resource('kategori', KategoriController::class);
Route::resource('jurusan', JurusanController::class)->except(['create', 'show', 'edit']);
Route::resource('kelas', KelasController::class)->except(['create', 'show', 'edit']);
Route::resource('kategori', KategoriController::class)->except(['create', 'show', 'edit']);
Route::resource('buku', BukuController::class)->except(['create', 'show', 'edit']);
Route::get('buku/{id}/restore', [BukuController::class, 'restore'])->name('buku.restore');
Route::delete('buku/{id}/force-delete', [BukuController::class, 'forceDelete'])->name('buku.force-delete');
