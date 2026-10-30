<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopikBaruController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tes-koneksi', function () {
    return "Koneksi route berhasil!";
});

// Route CRUD Topik Baru
Route::get('/daftar-topik', [TopikBaruController::class, 'index']);
Route::get('/daftar-topik/create', [TopikBaruController::class, 'create']);
Route::post('/daftar-topik', [TopikBaruController::class, 'store']);
Route::get('/daftar-topik/{id}/edit', [TopikBaruController::class, 'edit']);
Route::put('/daftar-topik/{id}', [TopikBaruController::class, 'update']);
Route::delete('/daftar-topik/{id}', [TopikBaruController::class, 'destroy']);

use App\Http\Controllers\AuthController;

// Route untuk Guest (Belum Login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});



