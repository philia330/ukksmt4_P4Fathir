<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Genre;
use App\Models\Penerbit;
use App\Models\Pengarang;
use App\Models\RakBuku;

use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $buku = Buku::with([
                    'genre',
                    'pengarang',
                    'penerbit',
                    'rak'
                ])
                ->when($search, function ($query, $search) {

                    return $query->where('judul', 'like', '%' . $search . '%');

                })
                ->oldest()
                ->paginate(5);

        return view('buku.index', compact('buku'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genre = Genre::all();
        $pengarang = Pengarang::all();
        $penerbit = Penerbit::all();
        $rak_buku = RakBuku::all();

        return view('buku.create', compact(
            'genre',
            'pengarang',
            'penerbit',
            'rak_buku'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'id_genre' => 'required',
            'id_pengarang' => 'required',
            'id_penerbit' => 'required',
            'id_rak' => 'required',

            'judul' => 'required|max:255',

            'tahun' => 'required',

            'stok' => 'required|integer',

            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'

        ]);

        $foto = null;

        if ($request->hasFile('foto')) {

            $foto = time() . '.' .
                    $request->foto->extension();

            $request->foto->move(
                public_path('uploads/buku'),
                $foto
            );
        }

        Buku::create([

            'id_genre' => $request->id_genre,
            'id_pengarang' => $request->id_pengarang,
            'id_penerbit' => $request->id_penerbit,
            'id_rak' => $request->id_rak,

            'judul' => $request->judul,

            'tahun' => $request->tahun,

            'stok' => $request->stok,

            'foto' => $foto

        ]);

        return redirect()
                ->route('buku.index')
                ->with('success', 'Data buku berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $buku = Buku::findOrFail($id);

        $genre= Genre::all();
        $pengarang = Pengarang::all();
        $penerbit = Penerbit::all();
        $rak_buku = RakBuku::all();

        return view('buku.edit', compact(
            'buku',
            'genre',
            'pengarang',
            'penerbit',
            'rak_buku'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([

            'id_genre' => 'required',
            'id_pengarang' => 'required',
            'id_penerbit' => 'required',
            'id_rak' => 'required',

            'judul' => 'required|max:255',

            'tahun' => 'required',

            'stok' => 'required|integer'

        ]);

        $buku = Buku::findOrFail($id);

        $foto = $buku->foto;

        if ($request->hasFile('foto')) {

            $foto = time() . '.' .
                    $request->foto->extension();

            $request->foto->move(
                public_path('uploads/buku'),
                $foto
            );
        }

        $buku->update([

            'id_genre' => $request->id_genre,
            'id_pengarang' => $request->id_pengarang,
            'id_penerbit' => $request->id_penerbit,
            'id_rak' => $request->id_rak,

            'judul' => $request->judul,

            'tahun' => $request->tahun,

            'stok' => $request->stok,

            'foto' => $foto

        ]);

        return redirect()
                ->route('buku.index')
                ->with('success', 'Data buku berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);

        $buku->delete();

        return redirect()
                ->route('buku.index')
                ->with('success', 'Data buku berhasil dihapus');
    }
}