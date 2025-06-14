<?php

namespace App\Http\Controllers;

use App\Models\Tahun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TimTahunController extends Controller
{
    public function index()
    {
        $tahuns = Tahun::orderBy('tahun', 'desc')->paginate(10);

        return view('tim.tahun.index', compact('tahuns'));
    }

    public function create()
    {
        $user = Auth::user();

        if (!$user || !$user->kode_prodi) {
            abort(404);
        }
        $kodeProdi = $user->kode_prodi;

        return view('tim.tahun.create', compact('kodeProdi'));
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

        return redirect()->route('tim.tahun.index')->with('success', 'Data Tahun berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $tahun = Tahun::findOrFail($id);
        return view('tim.tahun.edit', compact('tahun'));
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

        return redirect()->route('tim.tahun.index')->with('success', 'Data tahun berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $tahun = Tahun::findOrFail($id);
        $tahun->delete();

        return redirect()->route('tim.tahun.index')->with('sukses', 'Data tahun berhasil dihapus.');
    }
}
