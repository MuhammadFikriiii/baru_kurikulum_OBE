<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CapaianPembelajaranMataKuliah;

class AdminCapaianPembelajaranMataKuliahController extends Controller
{
    public function index()
    {
        $cpmk = CapaianPembelajaranMataKuliah::all();
        dd($cpmk);
        return view('admin.capaianpembelajaranmatakuliah.index', compact('cpmk'));
    }
    public function create()
    {
        return view('admin.capaianpembelajaranmatakuliah.create',);
    }

    public function store(Request $request)
    {
        $cpmk = $request->validate([
            'kode_cpmk' => 'required|string|max:10',
            'deskripsi_cpmk' => 'required|string|max:255',
        ]);

        CapaianPembelajaranMataKuliah::create($request->only(['kode_cpmk', 'deskripsi_cpmk']));
        dd($cpmk);

        return redirect()->route('admin.capaianpembelajaranmatakuliah.index')->with('success', 'Capaian Pembelajaran Mata Kuliah berhasil ditambahkan.');
    }
}
