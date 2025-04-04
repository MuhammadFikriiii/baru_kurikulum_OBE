<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
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
}