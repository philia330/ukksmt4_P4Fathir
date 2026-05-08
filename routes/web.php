<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PengarangController;
use App\Http\Controllers\RakBukuController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\GenreController;
use App\Models\User;
use App\Models\Buku;
use App\Models\Pengarang;
use App\Models\Penerbit;



Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {

    $totalBuku = Buku::count();

    $totalAnggota = User::where('role', 'anggota')->count();

    $totalPengarang = Pengarang::count();

    $totalPenerbit = Penerbit::count();

    $users = User::latest()->paginate(10);

    // AMBIL 5 BUKU TERBARU
    $bukuTerbaru = Buku::latest()->paginate(5);

    return view('dashboard.index', compact(
        'totalBuku',
        'totalAnggota',
        'totalPengarang',
        'totalPenerbit',
        'bukuTerbaru'
    ));

})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {

    Route::resource('users', UserController::class);

    Route::resource('genre', GenreController::class);

    Route::resource('pengarang', PengarangController::class);

    Route::resource('rak_buku', RakBukuController::class);

    Route::resource('penerbit', PenerbitController::class);

    Route::resource('buku', BukuController::class);
});

require __DIR__.'/auth.php';
