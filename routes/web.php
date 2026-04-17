<?php

use Illuminate\Support\Facades\Route;
// Tambahkan baris ini di bawah:
use App\Http\Controllers\DashboardController; 

Route::get('/', function () {
    return view('layouts.app');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Sekarang baris ini tidak akan error lagi
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Menampilkan halaman login secara langsung dari folder resources/views/auth/login.blade.php
Route::view('/login-page', 'auth.login')->name('login');

// Jika Anda ingin ada halaman register juga
Route::view('/register-page', 'auth.register')->name('register');