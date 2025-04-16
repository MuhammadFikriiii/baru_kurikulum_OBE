<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\UserProdi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SignUpController extends Controller
{
    public function create()
    {
        $prodis = Prodi::all();
        return view('auth.signup', compact('prodis'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:userprodis,email',
            'password'  => 'required|string|min:6',
            'role'     => 'required|in:kaprodi,tim',
            'kode_prodi'  => 'required|exists:prodis,kode_prodi',
        ]);

        Userprodi::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'kode_prodi' => $request->kode_prodi,
            'role' => $request->role,
            'status' => 'pending',
        ]);

        return redirect()->route('login')->with('register', 'Pendaftaran berhasil. Menunggu persetujuan admin.');
    }

    public function pendingUsers()
    {
        $pendingUsers = UserProdi::where('status', 'pending')->with('prodi')->get();
        return view('admin.pendingusers.index', compact('pendingUsers'));
    }

    public function approveUser($id)
    {
        $user = UserProdi::findOrFail($id);
        $user->status = 'approved';
        $user->save();

        return redirect()->route('admin.pendingusers.index')->with('success', 'User berhasil disetujui.');
    }

    public function rejectUser($id)
    {
        $user = UserProdi::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.pendingusers.index')->with('success', 'User berhasil ditolak dan dihapus.');
    }
}