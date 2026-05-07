<?php

namespace App\Http\Controllers;

use App\Models\RakBuku;
use Illuminate\Http\Request;

class RakBukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $rak_buku = RakBuku::when($search, function ($query, $search) {
                            return $query->where('lokasi', 'like', '%' . $search . '%');
                        })
                        ->latest()
                        ->paginate(10);

        return view('rak_buku.index', compact('rak_buku'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('rak_buku.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'lokasi' => 'required|max:255'
        ]);

        RakBuku::create([
            'lokasi' => $request->lokasi
        ]);

        return redirect()
                ->route('rak_buku.index')
                ->with('success', 'Data rak buku berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(RakBuku $rakBuku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rak_buku = RakBuku::findOrFail($id);

        return view('rak_buku.edit', compact('rak_buku'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'lokasi' => 'required|max:255'
        ]);

        $rak_buku = RakBuku::findOrFail($id);

        $rak_buku->update([
            'lokasi' => $request->lokasi
        ]);

        return redirect()
                ->route('rak_buku.index')
                ->with('success', 'Data rak buku berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rak_buku = RakBuku::findOrFail($id);

        $rak_buku->delete();

        return redirect()
                ->route('rak_buku.index')
                ->with('success', 'Data rak buku berhasil dihapus');
    }
}