<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $genre = Genre::when($search, function ($query, $search) {
                        return $query->where('nama', 'like', '%' . $search . '%');
                    })
                    ->oldest()
                    ->paginate(5);

        return view('genre.index', compact('genre'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('genre.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255|unique:genre,nama'
        ], [
            'nama.required' => 'Nama genre wajib diisi',
            'nama.unique' => 'Nama genre sudah ada',
        ]);

        Genre::create([
            'nama' => $request->nama
        ]);

        return redirect()
                ->route('genre.index')
                ->with('success', 'Data genre berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Genre $genre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $genre = Genre::findOrFail($id);

        return view('genre.edit', compact('genre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:255|unique:genre,nama,' . $id
        ], [
            'nama.required' => 'Nama genre wajib diisi',
            'nama.unique' => 'Nama genre sudah ada',
        ]);

        $genre = Genre::findOrFail($id);

        $genre->update([
            'nama' => $request->nama
        ]);

        return redirect()
                ->route('genre.index')
                ->with('success', 'Data genre berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $genre = Genre::findOrFail($id);

        $genre->delete();

        return redirect()
                ->route('genre.index')
                ->with('success', 'Data genre berhasil dihapus');
    }
}