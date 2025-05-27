<?php

namespace App\Http\Controllers;

use App\Models\CapaianPembelajaranMataKuliah;
use App\Models\CapaianProfilLulusan;
use App\Models\MataKuliah;
use App\Models\Penilaian;
use Illuminate\Http\Request;

class AdminPenilaianController extends Controller
{
    public function index()
    {
        
    }
    public function create()
    {
        $cpls = CapaianProfilLulusan::all();
        $mks = MataKuliah::all();
        $cpmks = CapaianPembelajaranMataKuliah::all();
        return view('admin.penilaian.create', compact('cpls', 'mks', 'cpmks'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'id_cpl' => 'required|exists:capaian_profil_lulusans,id_cpl',
            'kode_mk' => 'required|exists:mata_kuliahs,kode_mk',
            'id_cpmk' => 'required|exists:capaian_pembelajaran_mata_kuliahs,id_cpmk',
            'kuis' => 'required|integer|min:0|max:100',
            'observasi' => 'required|integer|min:0|max:100',
            'presentasi' => 'required|integer|min:0|max:100',
            'uts' => 'required|integer|min:0|max:100',
            'uas' => 'required|integer|min:0|max:100',
            'project' => 'required|integer|min:0|max:100',
        ]);

        Penilaian::create($request->all());
        dd($request->all());
        return redirect()->route('admin.penilaian.index')->with('success', 'Penilaian berhasil ditambahkan.');
    }
}
