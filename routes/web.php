<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;

// ============================================================
// MATERI 12: ROUTING DI LARAVEL
// ============================================================

// Redirect halaman utama ke daftar karyawan
Route::redirect('/', '/karyawan');

// Route sederhana: menampilkan daftar karyawan
Route::get('/karyawan', [KaryawanController::class, 'index'])
     ->name('karyawan.index');

// Route untuk halaman gaji bulanan
Route::get('/karyawan/laporan/gaji', [KaryawanController::class, 'laporanGaji'])
     ->name('karyawan.gaji');

// Route untuk detail karyawan berdasarkan NIP
Route::get('/karyawan/{nip}', [KaryawanController::class, 'show'])
     ->name('karyawan.show');