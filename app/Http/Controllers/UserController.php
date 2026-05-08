<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // tampilkan form tambah user
    public function create()
    {
        return view('users.create');
    }

    // simpan user ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'no_tlp' => 'required',
            'alamat' => 'required',
            'jkl' => 'required',
            'role' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_tlp' => $request->no_tlp,
            'alamat' => $request->alamat,
            'jkl' => $request->jkl,
            'role' => $request->role,
        ]);

        return redirect()->route('dashboard')->with('success', 'User berhasil ditambah');
    }

 public function index(Request $request)
{
    $query = User::query();

    // SEARCH
    if ($request->search) {
        $query->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('email', 'like', '%' . $request->search . '%')
              ->orWhere('no_tlp', 'like', '%' . $request->search . '%');
    }

    // PAGINATION
    $users = $query->oldest()->paginate(5);

    return view('users.index', compact('users'));
}

        public function edit($id)
        {
            $user = User::findOrFail($id);
            return view('users.edit', compact('user'));
        }

 public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,' . $id,
        'no_tlp' => 'required',
        'alamat' => 'required',
        'jkl' => 'required',
        'role' => 'required'
    ]);

    $data = [
        'name' => $request->name,
        'email' => $request->email,
        'no_tlp' => $request->no_tlp,
        'alamat' => $request->alamat,
        'jkl' => $request->jkl,
        'role' => $request->role,
    ];

    if ($request->password) {
        $data['password'] = Hash::make($request->password);
    }

    $user->update($data);

    return redirect()->route('users.index')->with('success', 'User berhasil diupdate');
}
public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->route('users.index')
        ->with('success', 'User berhasil dihapus');
}

}