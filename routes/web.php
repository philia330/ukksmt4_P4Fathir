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
*/

Route::get('/', function () {

    return view('auth.login');

});

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {

        /*
        |--------------------------------------------------------------------------
        | ROLE USER
        |--------------------------------------------------------------------------
        */

        $role = auth()->user()->role;

        /*
        |--------------------------------------------------------------------------
        | ADMIN & PETUGAS
        |--------------------------------------------------------------------------
        */

        if (in_array($role, ['admin', 'petugas'])) {

            $totalBuku = Buku::count();

            $totalAnggota = User::where('role', 'anggota')->count();

            $totalPeminjaman = \App\Models\Peminjaman::count();

            $totalDenda = \App\Models\Peminjaman::sum('denda');

            $menunggu = \App\Models\Peminjaman::where('status', 'menunggu')->count();

            $dipinjam = \App\Models\Peminjaman::where('status', 'dipinjam')->count();

            $dikembalikan = \App\Models\Peminjaman::where('status', 'dikembalikan')->count();

            $ditolak = \App\Models\Peminjaman::where('status', 'ditolak')->count();

            $transaksiTerbaru = \App\Models\Peminjaman::with([

                'user',
                'buku'

            ])->latest()->take(5)->get();

            return view('dashboard.index', compact(

                'totalBuku',
                'totalAnggota',
                'totalPeminjaman',
                'totalDenda',
                'menunggu',
                'dipinjam',
                'dikembalikan',
                'ditolak',
                'transaksiTerbaru'

            ));
        }

        /*
        |--------------------------------------------------------------------------
        | ANGGOTA
        |--------------------------------------------------------------------------
        */

        $bukus = Buku::with([

            'pengarang',
            'penerbit'

        ])->latest()->paginate(8);

        return view('dashboard.index', compact('bukus'));

    })->name('dashboard');

});

/*
|--------------------------------------------------------------------------
| ADMIN ONLY
|--------------------------------------------------------------------------
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
| PEMINJAMAN & TRANSAKSI
|--------------------------------------------------------------------------
|
| Bisa diakses:
| - admin
| - anggota
| - petugas
|
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | HALAMAN PEMINJAMAN
    |--------------------------------------------------------------------------
    */

    Route::get('/peminjaman',

        [PeminjamanController::class, 'index']

    )->name('peminjaman.index');

    /*
    |--------------------------------------------------------------------------
    | DETAIL BUKU
    |--------------------------------------------------------------------------
    */

    Route::get('/peminjaman/{id}',

        [PeminjamanController::class, 'show']

    )->name('peminjaman.show');

    /*
    |--------------------------------------------------------------------------
    | SIMPAN PEMINJAMAN
    |--------------------------------------------------------------------------
    */

    Route::post('/peminjaman/store',

        [PeminjamanController::class, 'store']

    )->name('peminjaman.store');

    /*
    |--------------------------------------------------------------------------
    | TRANSAKSI PEMINJAMAN
    |--------------------------------------------------------------------------
    */

    Route::get('/transaksi-peminjaman',

        [PeminjamanController::class, 'transaksi']

    )->name('peminjaman.transaksi');

    /*
    |--------------------------------------------------------------------------
    | HALAMAN KONFIRMASI
    |--------------------------------------------------------------------------
    */

    Route::get('/transaksi-peminjaman/{id}/konfirmasi',

        [PeminjamanController::class, 'konfirmasi']

    )->name('peminjaman.konfirmasi');

    /*
    |--------------------------------------------------------------------------
    | UPDATE KONFIRMASI
    |--------------------------------------------------------------------------
    */

    Route::put('/transaksi-peminjaman/{id}/update',

        [PeminjamanController::class, 'updateKonfirmasi']

    )->name('peminjaman.updateKonfirmasi');

    /*
    |--------------------------------------------------------------------------
    | HAPUS TRANSAKSI
    |--------------------------------------------------------------------------
    */

    Route::delete('/transaksi-peminjaman/{id}',

        [PeminjamanController::class, 'destroy']

    )->name('peminjaman.destroy');

    /*
    |--------------------------------------------------------------------------
    | RIWAYAT PEMINJAMAN
    |--------------------------------------------------------------------------
    */

    Route::get('/riwayat-peminjaman',

        [PeminjamanController::class, 'riwayat']

    )->name('peminjaman.riwayat');

    /*
    |--------------------------------------------------------------------------
    | HALAMAN PENGEMBALIAN
    |--------------------------------------------------------------------------
    */

    Route::get('/pengembalian',

        [PeminjamanController::class, 'pengembalian']

    )->name('peminjaman.pengembalian');

    /*
    |--------------------------------------------------------------------------
    | AJUKAN PENGEMBALIAN
    |--------------------------------------------------------------------------
    */

    Route::put('/pengembalian/{id}',

        [PeminjamanController::class, 'kembalikan']

    )->name('peminjaman.kembalikan');

});

/*
|--------------------------------------------------------------------------
| AUTH LARAVEL
|--------------------------------------------------------------------------
|
| Route bawaan login/register/logout
|
*/

require __DIR__.'/auth.php';