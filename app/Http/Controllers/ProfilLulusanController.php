<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfilLulusan;
use App\Models\Prodi;

class ProfilLulusanController extends Controller
{
    public function index()
    {
        $profillulusans = ProfilLulusan::with('prodi')->get();
        return view('admin.profillulusan.index', compact('profillulusans'));
    }

    public function create()
    {
        $prodis = Prodi::all();
        return view('admin.profillulusan.create', compact('prodis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_pl' => 'required|string|max:10|unique:profil_lulusans,kode_pl',
            'kode_prodi' => 'required|string|max:10',
            'deskripsi_pl' => 'required',
            'profesi_pl' => 'required',
            'unsur_pl' => 'required|in:Pengetahuan,Keterampilan Khusus,Sikap dan Keterampilan Umum',
            'keterangan_pl' => 'required|in:Kompetensi Utama Bidang,Kompetensi Utama,Kompetensi_tambahan',
            'sumber_pl' => 'required',
        ]);
        ProfilLulusan::create($request->all());
        return redirect()->route('admin.profillulusan.index')->with('success', 'Profil lulusan berhasil ditambahkan.');
    }

    public function edit (ProfilLulusan $profillulusan)
    {
        $prodis = Prodi::all();
        return view('admin.profillulusan.edit', compact('profillulusan', 'prodis'));
    }

    public function update(Request $request, ProfilLulusan $profillulusan)
    {
        $request->validate([
            'kode_pl' => 'required|string|max:10',
            'kode_prodi' => 'required|string|max:10',
            'deskripsi_pl' => 'required',
            'profesi_pl' => 'required',
            'unsur_pl' => 'required|in:Pengetahuan,Keterampilan Khusus,Sikap dan Keterampilan Umum',
            'keterangan_pl' => 'required|in:Kompetensi Utama Bidang,Kompetensi Utama,Kompetensi_tambahan',
            'sumber_pl' => 'required',
        ]);

        $profillulusan->update($request->all());
        return redirect()->route('admin.profillulusan.index')->with('success', 'Prodi berhasil diperbarui.');
    }
}
