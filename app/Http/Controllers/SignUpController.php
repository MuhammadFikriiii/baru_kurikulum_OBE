<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\User;
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:kaprodi,tim',
            'kode_prodi' => 'required|exists:prodis,kode_prodi',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'kode_prodi' => $request->kode_prodi,
            'status' => 'pending',
        ]);

        return redirect()->route('login')->with('register', 'Pendaftaran berhasil. Menunggu persetujuan admin.');
    }
}