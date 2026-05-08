<?php

namespace App\Http\Controllers;

use App\Models\Penerbit;
use Illuminate\Http\Request;

class PenerbitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $penerbit = Penerbit::when($search, function ($query, $search) {

                        return $query->where('nama', 'like', '%' . $search . '%');

                    })
                    ->oldest()
                    ->paginate(5);

        return view('penerbit.index', compact('penerbit'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('penerbit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'nama' => 'required|max:255',
            'alamat' => 'required'

        ]);

        Penerbit::create([

            'nama' => $request->nama,
            'alamat' => $request->alamat

        ]);

        return redirect()
                ->route('penerbit.index')
                ->with('success', 'Data penerbit berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penerbit $penerbit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $penerbit = Penerbit::findOrFail($id);

        return view('penerbit.edit', compact('penerbit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([

            'nama' => 'required|max:255',
            'alamat' => 'required'

        ]);

        $penerbit = Penerbit::findOrFail($id);

        $penerbit->update([

            'nama' => $request->nama,
            'alamat' => $request->alamat

        ]);

        return redirect()
                ->route('penerbit.index')
                ->with('success', 'Data penerbit berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $penerbit = Penerbit::findOrFail($id);

        $penerbit->delete();

        return redirect()
                ->route('penerbit.index')
                ->with('success', 'Data penerbit berhasil dihapus');
    }
}