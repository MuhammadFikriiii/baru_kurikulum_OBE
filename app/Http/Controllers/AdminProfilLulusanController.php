<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfilLulusan;
use App\Models\Prodi;
use Illuminate\Validation\Rule;

class AdminProfilLulusanController extends Controller
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
            'kode_pl' => 'required|string|max:10|',
            'kode_prodi' => 'required|string|max:10',
            'deskripsi_pl' => 'required',
            'profesi_pl' => 'required',
            'unsur_pl' => 'required|in:Pengetahuan,Keterampilan Khusus,Sikap dan Keterampilan Umum',
            'keterangan_pl' => 'required|in:Kompetensi Utama Bidang,Kompetensi Utama,Kompetensi Tambahan',
            'sumber_pl' => 'required',
        ]);
        ProfilLulusan::create($request->all());
        return redirect()->route('admin.profillulusan.index')->with('success', 'Profil lulusan berhasil ditambahkan.');
    }

    public function edit ($id_pl)
    {
        $prodis = Prodi::all();
        $profillulusan = ProfilLulusan::findOrFail($id_pl);
        return view('admin.profillulusan.edit', compact('profillulusan', 'prodis'));
    }

    public function update(Request $request, $id_pl)
    {
        $request->validate([
            'kode_pl' => 'required|string|max:10',
            'kode_prodi' => 'required|string|max:10',
            'deskripsi_pl' => 'required',
            'profesi_pl' => 'required',
            'unsur_pl' => 'required|in:Pengetahuan,Keterampilan Khusus,Sikap dan Keterampilan Umum',
            'keterangan_pl' => 'required|in:Kompetensi Utama Bidang,Kompetensi Utama,Kompetensi Tambahan',
            'sumber_pl' => 'required',
        ]);

        $profillulusan = ProfilLulusan::findOrFail($id_pl);
        $profillulusan->update($request->all());
        return redirect()->route('admin.profillulusan.index')->with('success', 'Profil Lulusan berhasil diperbarui.');
    }

    public function destroy(ProfilLulusan $profillulusan)
    {
        $profillulusan->delete();
        return redirect()->route('admin.profillulusan.index')->with('sukses','Profil Lulusan Berhasil Dihapus');

    }
}
