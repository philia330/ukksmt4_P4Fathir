<?php

/*
|--------------------------------------------------------------------------
| NAMESPACE CONTROLLER
|--------------------------------------------------------------------------
|
| Menentukan lokasi class controller ini
|
*/

namespace App\Http\Controllers;

/*
|--------------------------------------------------------------------------
| IMPORT MODEL
|--------------------------------------------------------------------------
|
| Digunakan untuk mengambil data database
|
*/

use App\Models\Peminjaman;
use App\Models\Buku;

/*
|--------------------------------------------------------------------------
| IMPORT REQUEST
|--------------------------------------------------------------------------
|
| Request digunakan untuk mengambil data form
|
*/

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| CONTROLLER PEMINJAMAN
|--------------------------------------------------------------------------
|
| Controller ini digunakan untuk:
| - halaman peminjaman
| - simpan peminjaman
| - transaksi peminjaman
| - konfirmasi peminjaman
| - pengembalian buku
| - update status
|
*/

class PeminjamanController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HALAMAN PEMINJAMAN
    |--------------------------------------------------------------------------
    |
    | Menampilkan semua buku dalam bentuk card
    |
    | Bisa diakses:
    | - admin
    | - anggota
    |
    */

    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI ROLE
        |--------------------------------------------------------------------------
        */

        if (!in_array(auth()->user()->role, ['admin', 'anggota'])) {

            abort(403);

        }

        /*
        |--------------------------------------------------------------------------
        | AMBIL DATA BUKU
        |--------------------------------------------------------------------------
        |
        | latest()   = data terbaru tampil pertama
        | paginate() = pagination Laravel
        |
        */

        $bukus = Buku::latest()->paginate(8);

        /*
        |--------------------------------------------------------------------------
        | KIRIM DATA KE VIEW
        |--------------------------------------------------------------------------
        */

        return view('peminjaman.index', compact('bukus'));
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL BUKU
    |--------------------------------------------------------------------------
    |
    | Menampilkan detail buku sebelum dipinjam
    |
    */

    public function show($id)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI ROLE
        |--------------------------------------------------------------------------
        */

        if (!in_array(auth()->user()->role, ['admin', 'anggota'])) {

            abort(403);

        }

        /*
        |--------------------------------------------------------------------------
        | CARI BUKU BERDASARKAN ID
        |--------------------------------------------------------------------------
        |
        | findOrFail():
        | jika data tidak ditemukan
        | otomatis menampilkan 404
        |
        */

        $buku = Buku::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | TAMPILKAN HALAMAN DETAIL
        |--------------------------------------------------------------------------
        */

        return view('peminjaman.show', compact('buku'));
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN PEMINJAMAN
    |--------------------------------------------------------------------------
    |
    | Saat tombol lanjutkan ditekan
    |
    */

    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI INPUT
        |--------------------------------------------------------------------------
        */

        $request->validate([

            'id_buku' => 'required|exists:bukus,id',

        ]);

        /*
        |--------------------------------------------------------------------------
        | CARI DATA BUKU
        |--------------------------------------------------------------------------
        */

        $buku = Buku::findOrFail($request->id_buku);

        /*
        |--------------------------------------------------------------------------
        | CEK STOK BUKU
        |--------------------------------------------------------------------------
        */

        if ($buku->stok <= 0) {

            return back()->with(

                'error',

                'Stok buku habis'

            );
        }

        /*
        |--------------------------------------------------------------------------
        | SIMPAN DATA PEMINJAMAN
        |--------------------------------------------------------------------------
        |
        | Status pertama:
        | menunggu
        |
        | Menunggu konfirmasi petugas
        |
        */

        Peminjaman::create([

            // user yang login
            'user_id' => auth()->user()->id,

            // id buku
            'id_buku' => $buku->id,

            // tanggal pinjam
            'tanggal_pinjam' => now(),

            // batas pengembalian 7 hari
            'tanggal_kembali' => now()->addDays(7),

            // status awal
            'status' => 'menunggu',

            // default denda
            'denda' => 0,

        ]);

        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()

            ->route('peminjaman.index')

            ->with(

                'success',

                'Peminjaman berhasil dikirim, menunggu konfirmasi petugas'

            );
    }

    /*
    |--------------------------------------------------------------------------
    | TRANSAKSI PEMINJAMAN
    |--------------------------------------------------------------------------
    |
    | Menampilkan seluruh transaksi peminjaman
    |
    | Bisa diakses:
    | - admin
    | - petugas
    |
    */

    public function transaksi(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI ROLE
        |--------------------------------------------------------------------------
        */

        if (!in_array(auth()->user()->role, ['admin', 'petugas'])) {

            abort(403);

        }

        /*
        |--------------------------------------------------------------------------
        | QUERY RELASI
        |--------------------------------------------------------------------------
        |
        | with():
        | eager loading relasi
        |
        */

        $query = Peminjaman::with([

            'user',
            'buku'

        ]);

        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        |
        | Cari berdasarkan:
        | - nama user
        | - judul buku
        |
        */

        if ($request->search) {

            $query->whereHas('user', function ($q) use ($request) {

                $q->where(

                    'name',

                    'like',

                    '%' . $request->search . '%'

                );

            })

            ->orWhereHas('buku', function ($q) use ($request) {

                $q->where(

                    'judul',

                    'like',

                    '%' . $request->search . '%'

                );

            });
        }

        /*
        |--------------------------------------------------------------------------
        | PAGINATION
        |--------------------------------------------------------------------------
        */

        $peminjaman = $query->latest()->paginate(10);

        /*
        |--------------------------------------------------------------------------
        | TAMPILKAN HALAMAN TRANSAKSI
        |--------------------------------------------------------------------------
        */

        return view(

            'peminjaman.transaksi',

            compact('peminjaman')

        );
    }

    /*
    |--------------------------------------------------------------------------
    | HALAMAN KONFIRMASI
    |--------------------------------------------------------------------------
    |
    | Menampilkan detail transaksi peminjaman
    |
    */

    public function konfirmasi($id)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI ROLE
        |--------------------------------------------------------------------------
        */

        if (!in_array(auth()->user()->role, ['admin', 'petugas'])) {

            abort(403);

        }

        /*
        |--------------------------------------------------------------------------
        | AMBIL DATA PEMINJAMAN + RELASI
        |--------------------------------------------------------------------------
        */

        $peminjaman = Peminjaman::with([

            'user',
            'buku'

        ])->findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | TAMPILKAN HALAMAN KONFIRMASI
        |--------------------------------------------------------------------------
        */

        return view(

            'peminjaman.konfirmasi',

            compact('peminjaman')

        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE KONFIRMASI
    |--------------------------------------------------------------------------
    |
    | Digunakan untuk:
    | - konfirmasi peminjaman
    | - pengembalian buku
    | - update status
    | - update denda
    |
    */

    public function updateKonfirmasi(Request $request, $id)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI INPUT
        |--------------------------------------------------------------------------
        */

        $request->validate([

            'status' => 'required',

            'denda' => 'nullable|numeric',

        ]);

        /*
        |--------------------------------------------------------------------------
        | AMBIL DATA PEMINJAMAN
        |--------------------------------------------------------------------------
        */

        $peminjaman = Peminjaman::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | AMBIL DATA BUKU
        |--------------------------------------------------------------------------
        */

        $buku = Buku::findOrFail($peminjaman->id_buku);

        /*
        |--------------------------------------------------------------------------
        | SAAT DISETUJUI DIPINJAM
        |--------------------------------------------------------------------------
        |
        | menunggu -> dipinjam
        |
        */

        if (

            $peminjaman->status == 'menunggu'

            &&

            $request->status == 'dipinjam'

        ) {

            /*
            |--------------------------------------------------------------------------
            | KURANGI STOK
            |--------------------------------------------------------------------------
            */

            $buku->stok -= 1;

            $buku->save();
        }

        /*
        |--------------------------------------------------------------------------
        | SAAT BUKU DIKEMBALIKAN
        |--------------------------------------------------------------------------
        |
        | dipinjam -> dikembalikan
        |
        */

        if (

            $peminjaman->status == 'dipinjam'

            &&

            $request->status == 'dikembalikan'

        ) {

            /*
            |--------------------------------------------------------------------------
            | TAMBAH STOK
            |--------------------------------------------------------------------------
            */

            $buku->stok += 1;

            $buku->save();

            /*
            |--------------------------------------------------------------------------
            | SIMPAN TANGGAL DIKEMBALIKAN
            |--------------------------------------------------------------------------
            */

            $peminjaman->tanggal_dikembalikan = now();
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE STATUS
        |--------------------------------------------------------------------------
        */

        $peminjaman->status = $request->status;

        /*
        |--------------------------------------------------------------------------
        | UPDATE DENDA
        |--------------------------------------------------------------------------
        */

        $peminjaman->denda = $request->denda;

        /*
        |--------------------------------------------------------------------------
        | SIMPAN PERUBAHAN
        |--------------------------------------------------------------------------
        */

        $peminjaman->save();

        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()

            ->route('peminjaman.transaksi')

            ->with(

                'success',

                'Transaksi peminjaman berhasil diperbarui'

            );
    }

    /*
    |--------------------------------------------------------------------------
    | HAPUS TRANSAKSI
    |--------------------------------------------------------------------------
    |
    | Menghapus data transaksi peminjaman
    |
    */

    public function destroy($id)
    {
        /*
        |--------------------------------------------------------------------------
        | CARI DATA PEMINJAMAN
        |--------------------------------------------------------------------------
        */

        $peminjaman = Peminjaman::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | HAPUS DATA
        |--------------------------------------------------------------------------
        */

        $peminjaman->delete();

        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()

            ->route('peminjaman.transaksi')

            ->with(

                'success',

                'Transaksi berhasil dihapus'

            );
    }
}