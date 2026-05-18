<?php

/*
|--------------------------------------------------------------------------
| IMPORT CLASS LARAVEL
|--------------------------------------------------------------------------
|
| Migration  = class migration Laravel
| Blueprint  = struktur table database
| Schema     = menjalankan query schema database
|
*/

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/*
|--------------------------------------------------------------------------
| CLASS MIGRATION PEMINJAMAN
|--------------------------------------------------------------------------
|
| Migration digunakan untuk membuat table database
|
*/

return new class extends Migration
{
    /*
    |--------------------------------------------------------------------------
    | FUNCTION UP
    |--------------------------------------------------------------------------
    |
    | Function up() dijalankan saat:
    | php artisan migrate
    |
    | Digunakan untuk membuat table
    |
    */

    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | MEMBUAT TABLE PEMINJAMAN
        |--------------------------------------------------------------------------
        */

        Schema::create('peminjaman', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | PRIMARY KEY
            |--------------------------------------------------------------------------
            |
            | id auto increment
            |
            */

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | RELASI USER
            |--------------------------------------------------------------------------
            |
            | user_id terhubung ke table users
            |
            | contoh:
            | peminjaman.user_id
            | -> users.id
            |
            */

            $table->foreignId('user_id')

                  // relasi ke table users
                  ->constrained('users')

                  // jika user dihapus
                  // data peminjaman ikut terhapus
                  ->onDelete('cascade');

            /*
            |--------------------------------------------------------------------------
            | RELASI BUKU
            |--------------------------------------------------------------------------
            |
            | id_buku terhubung ke table bukus
            |
            | contoh:
            | peminjaman.id_buku
            | -> bukus.id
            |
            */

            $table->foreignId('id_buku')

                  // relasi ke table bukus
                  ->constrained('bukus')

                  // jika buku dihapus
                  // data peminjaman ikut terhapus
                  ->onDelete('cascade');

            /*
            |--------------------------------------------------------------------------
            | TANGGAL PINJAM
            |--------------------------------------------------------------------------
            |
            | tanggal saat user meminjam buku
            |
            */

            $table->date('tanggal_pinjam');

            /*
            |--------------------------------------------------------------------------
            | BATAS PENGEMBALIAN
            |--------------------------------------------------------------------------
            |
            | tanggal maksimal buku harus dikembalikan
            |
            */

            $table->date('tanggal_kembali');

            /*
            |--------------------------------------------------------------------------
            | TANGGAL DIKEMBALIKAN
            |--------------------------------------------------------------------------
            |
            | nullable() artinya boleh kosong
            |
            | karena saat buku belum dikembalikan
            | field ini masih kosong
            |
            */

            $table->date('tanggal_dikembalikan')
                  ->nullable();

            /*
            |--------------------------------------------------------------------------
            | STATUS PEMINJAMAN
            |--------------------------------------------------------------------------
            |
            | menunggu      = menunggu persetujuan petugas
            | dipinjam      = buku sedang dipinjam
            | dikembalikan  = buku sudah kembali
            | terlambat     = melewati batas pengembalian
            |
            */

            $table->enum('status', [

                'menunggu',
                'dipinjam',
                'dikembalikan',
                'terlambat'

            ])

            // default pertama saat user meminjam
            ->default('menunggu');

            /*
            |--------------------------------------------------------------------------
            | INDEX STATUS
            |--------------------------------------------------------------------------
            |
            | mempercepat pencarian/filter status
            |
            */

            $table->index('status');

            /*
            |--------------------------------------------------------------------------
            | DENDA
            |--------------------------------------------------------------------------
            |
            | menyimpan nominal denda keterlambatan
            |
            | default 0 = tidak ada denda
            |
            */

            $table->bigInteger('denda')
                  ->default(0);

            /*
            |--------------------------------------------------------------------------
            | TIMESTAMPS
            |--------------------------------------------------------------------------
            |
            | otomatis membuat:
            |
            | created_at
            | updated_at
            |
            */

            $table->timestamps();
        });
    }

    /*
    |--------------------------------------------------------------------------
    | FUNCTION DOWN
    |--------------------------------------------------------------------------
    |
    | Function down() dijalankan saat:
    | php artisan migrate:rollback
    |
    | Digunakan untuk menghapus table
    |
    */

    public function down(): void
    {
        /*
        |--------------------------------------------------------------------------
        | HAPUS TABLE PEMINJAMAN
        |--------------------------------------------------------------------------
        */

        Schema::dropIfExists('peminjaman');
    }
};