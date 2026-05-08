<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $fillable = [

        'id_genre',
        'id_pengarang',
        'id_penerbit',
        'id_rak',
        'judul',
        'tahun',
        'stok',
        'foto'

    ];

    /*
    |--------------------------------------------------------------------------
    | RELATION
    |--------------------------------------------------------------------------
    */

    public function genre()
    {
        return $this->belongsTo(Genre::class, 'id_genre');
    }

    public function pengarang()
    {
        return $this->belongsTo(Pengarang::class, 'id_pengarang');
    }

    public function penerbit()
    {
        return $this->belongsTo(Penerbit::class, 'id_penerbit');
    }

    public function rak()
    {
        return $this->belongsTo(RakBuku::class, 'id_rak');
    }
}