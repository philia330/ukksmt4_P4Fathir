use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

public function create()
{
    return view('users.create');
}

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