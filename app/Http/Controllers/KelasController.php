<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $kelas = Kelas::when($search, function ($query, $search) {
                        return $query->where('nama', 'like', '%' . $search . '%');
                    })
                    ->latest()
                    ->paginate(10);

        return view('kelas.index', compact('kelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kelas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255|unique:kelas,nama'
        ], [
            'nama.required' => 'Nama kelas wajib diisi',
            'nama.unique' => 'Nama kelas sudah ada',
        ]);

        Kelas::create([
            'nama' => $request->nama
        ]);

        return redirect()
                ->route('kelas.index')
                ->with('success', 'Data kelas berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);

        return view('kelas.edit', compact('kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:255|unique:kelas,nama,' . $id
        ], [
            'nama.required' => 'Nama kelas wajib diisi',
            'nama.unique' => 'Nama kelas sudah ada',
        ]);

        $kelas = Kelas::findOrFail($id);

        $kelas->update([
            'nama' => $request->nama
        ]);

        return redirect()
                ->route('kelas.index')
                ->with('success', 'Data kelas berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);

        $kelas->delete();

        return redirect()
                ->route('kelas.index')
                ->with('success', 'Data kelas berhasil dihapus');
    }
}