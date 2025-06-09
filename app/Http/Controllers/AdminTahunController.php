<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tahun;

class AdminTahunController extends Controller
{
    public function index()
    {
        $tahuns = Tahun::orderBy('tahun', 'desc')->paginate(10);
        return view('admin.tahun.index', compact('tahuns'));
    }

    public function create()
    {
        return view('admin.tahun.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|unique:tahun,tahun',
            'nama_kurikulum' => 'required|string|max:255',
        ]);

        Tahun::create([
            'tahun' => $request->tahun,
            'nama_kurikulum' => $request->nama_kurikulum,
        ]);

        return redirect()->route('admin.tahun.index')->with('success', 'Data Tahun berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $tahun = Tahun::findOrFail($id);
        return view('admin.tahun.edit', compact('tahun'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kurikulum' => 'required|string|max:255',
            'tahun' => 'required|integer|unique:tahun,tahun,' . $id . ',id_tahun',
        ]);

        $tahun = Tahun::findOrFail($id);

        $tahun->update([
            'nama_kurikulum' => $request->nama_kurikulum,
            'tahun' => $request->tahun,
        ]);

        return redirect()->route('admin.tahun.index')->with('success', 'Data tahun berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $tahun = Tahun::findOrFail($id);
        $tahun->delete();

        return redirect()->route('admin.tahun.index')->with('sukses', 'Data tahun berhasil dihapus.');
    }
}
