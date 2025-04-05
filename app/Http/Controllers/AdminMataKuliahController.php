<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Http\Request;

class AdminMataKuliahController extends Controller
{
    public function index()
    {
        $mata_kuliahs = MataKuliah::all();
        return view("admin.matakuliah.index", compact("mata_kuliahs"));
    }

    public function create()
    {
        return view("admin.matakuliah.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_mk'=> 'required|string|max:10|unique:mata_kuliahs,kode_mk',
            'nama_mk'=> 'required|string|max:50',
            'jenis_mk'=> 'required|string|max:50',
            'sks_mk'=> 'required|integer',
            'semester_mk'=> 'required|integer|in:1,2,3,4,5,6,7,8',
            'kompetensi_mk'=> 'required|string|in:pendukung,utama',
        ]);
        MataKuliah::create($request->all());
        return redirect()->route('admin.matakuliah.index')->with('success', 'Mata kuliah berhasil ditambahkan!');
    }

    public function edit(MataKuliah $matakuliah)
    {
        return view("admin.matakuliah.edit", compact('matakuliah'));
    }

    public function update(Request $request, MataKuliah  $matakuliah)
    {
        request()->validate([
            'kode_mk'=>'required|string|max:10',
            'nama_mk'=> 'required|string|max:50',
            'jenis_mk'=> 'required|string|max:50',
            'sks_mk'=> 'required|integer',
            'semester_mk'=> 'required|integer|in:1,2,3,4,5,6,7,8',
            'kompetensi_mk'=> 'required|string|in:pendukung,utama',
        ]);
        $matakuliah->update($request->all());
        return redirect()->route('admin.matakuliah.index')->with('sukses', 'matakuliah berhasil diperbaharui');
    }

    public function destroy(MataKuliah $matakuliah)
    {
        $matakuliah->delete();
        return redirect()->route('admin.matakuliah.index')->with('sukses', 'matakuliah berhasil dihapus');
    }
    
}