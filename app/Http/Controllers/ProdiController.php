<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public function index()
    {
        $prodis = Prodi::with('jurusan')->get();
        return view('admin.prodi.index', compact('prodis'));
    }

    public function create()
    {
        $jurusans = Jurusan::all();
        return view('admin.prodi.create', compact('jurusans'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'kode_prodi' => 'required|string|max:10|unique:prodis,kode_prodi',
            'kode_jurusan' => 'required|string|exists:jurusans,kode_jurusan',
            'nama_prodi' => 'required|string|max:50',
        ]);

        Prodi::create($request->all());
        return redirect()->route('admin.prodi.index')->with('success', 'Prodi berhasil ditambahkan.');
    }

    public function edit(Prodi $prodi)
    {
        $jurusans = Jurusan::all();
        return view('admin.prodi.edit', compact('prodi', 'jurusans'));
    }

    public function update(Request $request, Prodi $prodi)
    {
        $request->validate([
            'kode_prodi' => 'required|string|max:10',
            'kode_jurusan' => 'required|string|exists:jurusans,kode_jurusan',
            'nama_prodi' => 'required|string|max:50',
        ]);

        $prodi->update($request->all());
        return redirect()->route('admin.prodi.index')->with('success', 'Prodi berhasil diperbarui.');
    }

    public function destroy(Prodi $prodi)
    {
        $prodi->delete();
        return redirect()->route('admin.prodi.index')->with('success', 'Prodi berhasil dihapus.');
    }
}