<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusans = Jurusan::all();
        return view('admin.jurusan.index', compact('jurusans'));
    }

    public function create()
    {
        return view('admin.jurusan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kajur' => 'required|string|max:50',
            'nama_jurusan' => 'required|string|max:50',
        ]);

        Jurusan::create($request->all());
        return redirect()->route('admin.jurusan.index')->with('success', 'Jurusan berhasil ditambahkan.');
    }

    public function edit(Jurusan $jurusan)
    {
        return view('admin.jurusan.edit', compact('jurusan'));
    }

    public function update(Request $request, Jurusan $jurusan)
    {
        $request->validate([
            'nama_kajur' => 'required|string|max:50',
            'nama_jurusan' => 'required|string|max:50',
        ]);

        $jurusan->update($request->all());
        return redirect()->route('admin.jurusan.index')->with('success', 'Jurusan berhasil diperbarui.');
    }

    public function detail(Jurusan $jurusan)
    {
        return view('admin.jurusan.detail', compact('jurusan'));
    }

    public function destroy(Jurusan $jurusan)
    {
        $jurusan->delete();
        return redirect()->route('admin.jurusan.index')->with('sukses', 'Jurusan berhasil dihapus.');
    }
}