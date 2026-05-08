<?php

namespace App\Http\Controllers;

use App\Models\Pengarang;
use Illuminate\Http\Request;

class PengarangController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $pengarang = Pengarang::when($search, function ($query, $search) {
                            return $query->where('nama', 'like', '%' . $search . '%');
                        })
                        ->oldest()
                        ->paginate(5);

        return view('pengarang.index', compact('pengarang'));
    }

    public function create()
    {
        return view('pengarang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'jkl' => 'required',
            'no_tlp' => 'required|max:20',
            'alamat' => 'required'
        ]);

        Pengarang::create([
            'nama' => $request->nama,
            'jkl' => $request->jkl,
            'no_tlp' => $request->no_tlp,
            'alamat' => $request->alamat,
        ]);

        return redirect()
                ->route('pengarang.index')
                ->with('success', 'Data pengarang berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pengarang = Pengarang::findOrFail($id);

        return view('pengarang.edit', compact('pengarang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'jkl' => 'required',
            'no_tlp' => 'required|max:20',
            'alamat' => 'required'
        ]);

        $pengarang = Pengarang::findOrFail($id);

        $pengarang->update([
            'nama' => $request->nama,
            'jkl' => $request->jkl,
            'no_tlp' => $request->no_tlp,
            'alamat' => $request->alamat,
        ]);

    return redirect()
            ->route('pengarang.index')
            ->with('success', 'Data pengarang berhasil diupdate');
}

    public function destroy($id)
    {
        $pengarang = Pengarang::findOrFail($id);

        $pengarang->delete();

        return redirect()
                ->route('pengarang.index')
                ->with('success', 'Data pengarang berhasil dihapus');
    }
}