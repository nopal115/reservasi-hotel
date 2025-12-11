<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function __construct()
    {
        // Hanya admin yang boleh akses
        $this->middleware(['auth', 'role:admin']);
    }

    // 🔹 List semua admin
    public function index()
    {
        $admins = User::where('role', 'admin')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.users.index', compact('admins'));
    }

    // 🔹 Form tambah admin
    public function create()
    {
        return view('admin.users.create');
    }

    // 🔹 Simpan admin baru
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:5|confirmed',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'admin',   // 💡 fix di sini: selalu admin
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Admin baru berhasil dibuat!');
    }
}
