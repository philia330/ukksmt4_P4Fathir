<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| IMPORT CONTROLLER
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\UserController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\PengarangController;
use App\Http\Controllers\RakBukuController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;

/*
|--------------------------------------------------------------------------
| IMPORT MODEL
|--------------------------------------------------------------------------
*/

use App\Models\User;
use App\Models\Buku;
use App\Models\Pengarang;
use App\Models\Penerbit;

/*
|--------------------------------------------------------------------------
| HALAMAN AWAL
|--------------------------------------------------------------------------
|
| Route pertama saat website dibuka
| Akan langsung menampilkan halaman login
|
*/

Route::get('/', function () {

    return view('auth.login');

});

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
|
| Hanya user yang login yang bisa akses dashboard
|
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | HALAMAN DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', function () {

        /*
        |--------------------------------------------------------------------------
        | HITUNG TOTAL DATA
        |--------------------------------------------------------------------------
        */

        // total buku
        $totalBuku = Buku::count();

        // total user role anggota
        $totalAnggota = User::where('role', 'anggota')->count();

        // total pengarang
        $totalPengarang = Pengarang::count();

        // total penerbit
        $totalPenerbit = Penerbit::count();

        /*
        |--------------------------------------------------------------------------
        | AMBIL BUKU TERBARU
        |--------------------------------------------------------------------------
        |
        | paginate(5) = tampil 5 data per halaman
        |
        */

        $bukuTerbaru = Buku::latest()->paginate(5);

        /*
        |--------------------------------------------------------------------------
        | KIRIM DATA KE VIEW DASHBOARD
        |--------------------------------------------------------------------------
        */

        return view('dashboard.index', compact(

            'totalBuku',
            'totalAnggota',
            'totalPengarang',
            'totalPenerbit',
            'bukuTerbaru'

        ));

    })->name('dashboard');

});

/*
|--------------------------------------------------------------------------
| ADMIN ONLY
|--------------------------------------------------------------------------
|
| Route di bawah ini hanya bisa diakses admin
|
*/

Route::middleware(['auth', 'admin'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | CRUD USER
    |--------------------------------------------------------------------------
    */

    Route::resource('users', UserController::class);

    /*
    |--------------------------------------------------------------------------
    | CRUD GENRE
    |--------------------------------------------------------------------------
    */

    Route::resource('genre', GenreController::class);

    /*
    |--------------------------------------------------------------------------
    | CRUD PENGARANG
    |--------------------------------------------------------------------------
    */

    Route::resource('pengarang', PengarangController::class);

    /*
    |--------------------------------------------------------------------------
    | CRUD RAK BUKU
    |--------------------------------------------------------------------------
    */

    Route::resource('rak_buku', RakBukuController::class);

    /*
    |--------------------------------------------------------------------------
    | CRUD PENERBIT
    |--------------------------------------------------------------------------
    */

    Route::resource('penerbit', PenerbitController::class);

    /*
    |--------------------------------------------------------------------------
    | CRUD BUKU
    |--------------------------------------------------------------------------
    */

    Route::resource('buku', BukuController::class);

});

/*
|--------------------------------------------------------------------------
| PEMINJAMAN BUKU
|--------------------------------------------------------------------------
|
| Bisa diakses:
| - admin
| - anggota
|
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | HALAMAN PEMINJAMAN
    |--------------------------------------------------------------------------
    |
    | Menampilkan card buku
    |
    */

    Route::get('/peminjaman',

        [PeminjamanController::class, 'index']

    )->name('peminjaman.index');

    /*
    |--------------------------------------------------------------------------
    | DETAIL BUKU
    |--------------------------------------------------------------------------
    |
    | Menampilkan detail buku sebelum dipinjam
    |
    */

    Route::get('/peminjaman/{id}',

        [PeminjamanController::class, 'show']

    )->name('peminjaman.show');

    /*
    |--------------------------------------------------------------------------
    | SIMPAN PEMINJAMAN
    |--------------------------------------------------------------------------
    |
    | Saat tombol lanjutkan ditekan
    | data akan masuk ke table peminjaman
    |
    */

    Route::post('/peminjaman/store',

        [PeminjamanController::class, 'store']

    )->name('peminjaman.store');

});

/*
|--------------------------------------------------------------------------
| TRANSAKSI PEMINJAMAN
|--------------------------------------------------------------------------
|
| Bisa diakses:
| - admin
| - petugas
|
| Digunakan untuk:
| - konfirmasi peminjaman
| - pengembalian buku
| - update status
| - update denda
|
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | HALAMAN TRANSAKSI
    |--------------------------------------------------------------------------
    |
    | Menampilkan semua data peminjaman
    |
    */

    Route::get('/transaksi-peminjaman',

        [PeminjamanController::class, 'transaksi']

    )->name('peminjaman.transaksi');

    /*
    |--------------------------------------------------------------------------
    | HALAMAN KONFIRMASI
    |--------------------------------------------------------------------------
    |
    | Menampilkan detail transaksi peminjaman
    |
    */

    Route::get('/transaksi-peminjaman/{id}/konfirmasi',

        [PeminjamanController::class, 'konfirmasi']

    )->name('peminjaman.konfirmasi');

    /*
    |--------------------------------------------------------------------------
    | UPDATE KONFIRMASI
    |--------------------------------------------------------------------------
    |
    | Digunakan untuk:
    | - update status
    | - update denda
    | - stok berkurang
    | - stok bertambah
    |
    */

    Route::put('/transaksi-peminjaman/{id}/update',

        [PeminjamanController::class, 'updateKonfirmasi']

    )->name('peminjaman.updateKonfirmasi');

    /*
    |--------------------------------------------------------------------------
    | DELETE TRANSAKSI
    |--------------------------------------------------------------------------
    |
    | Menghapus transaksi peminjaman
    |
    */

    Route::delete('/transaksi-peminjaman/{id}',

        [PeminjamanController::class, 'destroy']

    )->name('peminjaman.destroy');

});

/*
|--------------------------------------------------------------------------
| AUTH LARAVEL
|--------------------------------------------------------------------------
|
| Route bawaan login/register/logout Laravel
|
*/

require __DIR__.'/auth.php';