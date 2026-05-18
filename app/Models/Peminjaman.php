<?php

/*
|--------------------------------------------------------------------------
| NAMESPACE MODEL
|--------------------------------------------------------------------------
|
| Lokasi class model ini berada
|
*/

namespace App\Models;

/*
|--------------------------------------------------------------------------
| IMPORT MODEL LARAVEL
|--------------------------------------------------------------------------
*/

use Illuminate\Database\Eloquent\Model;

/*
|--------------------------------------------------------------------------
| IMPORT MODEL RELASI
|--------------------------------------------------------------------------
|
| Digunakan untuk relasi database
|
*/

use App\Models\User;
use App\Models\Buku;

/*
|--------------------------------------------------------------------------
| MODEL PEMINJAMAN
|--------------------------------------------------------------------------
|
| Model digunakan untuk:
| - mengambil data database
| - menyimpan data database
| - relasi database
|
*/

class Peminjaman extends Model
{
    /*
    |--------------------------------------------------------------------------
    | NAMA TABLE
    |--------------------------------------------------------------------------
    |
    | Secara default Laravel akan mencari:
    | peminjamans
    |
    | Karena table kita bernama:
    | peminjaman
    |
    | maka harus ditulis manual
    |
    */

    protected $table = 'peminjaman';

    /*
    |--------------------------------------------------------------------------
    | MASS ASSIGNMENT
    |--------------------------------------------------------------------------
    |
    | Field yang boleh diisi menggunakan:
    |
    | create()
    | update()
    |
    */

    protected $fillable = [

        // relasi user
        'user_id',

        // relasi buku
        'id_buku',

        // tanggal pinjam
        'tanggal_pinjam',

        // batas pengembalian
        'tanggal_kembali',

        // tanggal dikembalikan
        'tanggal_dikembalikan',

        // status peminjaman
        'status',

        // nominal denda
        'denda',

    ];

    /*
    |--------------------------------------------------------------------------
    | CASTING DATA
    |--------------------------------------------------------------------------
    |
    | Mengubah field database menjadi tipe data tertentu
    |
    | date = otomatis menjadi object Carbon
    |
    */

    protected $casts = [

        'tanggal_pinjam' => 'date',

        'tanggal_kembali' => 'date',

        'tanggal_dikembalikan' => 'date',

    ];

    /*
    |--------------------------------------------------------------------------
    | RELASI USER
    |--------------------------------------------------------------------------
    |
    | Satu peminjaman dimiliki satu user
    |
    | peminjaman.user_id
    | -> users.id
    |
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | RELASI BUKU
    |--------------------------------------------------------------------------
    |
    | Satu peminjaman dimiliki satu buku
    |
    | peminjaman.id_buku
    | -> bukus.id
    |
    | Karena foreign key memakai:
    | id_buku
    |
    | maka harus ditulis manual
    |
    */

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku');
    }
}