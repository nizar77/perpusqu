<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;

Route::get('/', function () {
    return view('layouts.app1');
});

Route::get('/data-siswa', function () {
    return view('siswa.index');
});


Route::get('/depan', function () {
    return view('dashboard.index');
});
// Route::get('/kategori', [KategoriController::class, 'index']);
// Route::resource('kategori', KategoriController::class);
Route::resource('kategori', KategoriController::class)->except(['create', 'show', 'edit']);
