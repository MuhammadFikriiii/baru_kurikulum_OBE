<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CapaianProfilLulusan;
use Illuminate\Validation\Rule;

class AdminCapaianProfilLulusanController extends Controller
{
    public function index()
    {
        $capaianprofillulusans = CapaianProfilLulusan::all();
        return view("admin.capaianprofillulusan.index", compact("capaianprofillulusans"));
    }

    public function create()
    {
        return view("admin.capaianprofillulusan.create");
    }

    public function store(Request $request)
    {
        request()->validate([
            'kode_cpl'=> 'required|string|max:10|unique:capaian_profil_lulusans,kode_cpl',
            'deskripsi_cpl'=> 'required',
            'status_cpl'=>'required|in:Kompetensi Utama Bidang,Kompetensi Tambahan',
        ]);
        CapaianProfilLulusan::create($request->all());
        return redirect()->route('admin.capaianprofillulusan.index')->with('success', 'Capaian Profil lulusan berhasil ditambahkan.');
    }

    public function edit(CapaianProfilLulusan $capaianprofillulusan)
    {
        return view('admin.capaianprofillulusan.edit' , compact('capaianprofillulusan'));
    }

    public function update(Request $request, CapaianProfilLulusan $capaianprofillulusan)
    {
        request()->validate([
            'kode_cpl'=> ['required','string','max:10',Rule::unique('capaian_profil_lulusans','kode_cpl')->ignore($capaianprofillulusan->kode_cpl,'kode_cpl')],
            'deskripsi_cpl'=> 'required',
            'status_cpl'=> 'required|in:Kompetensi Utama Bidang,Kompetensi Tambahan'
        ]);
        $capaianprofillulusan->update($request->all());
        return redirect()->route('admin.capaianprofillulusan.index')->with('success', 'Capaian Profil lulusan berhasil diperbaharui.');
    }

    public function destroy(CapaianProfilLulusan $capaianprofillulusan)
    {
        $capaianprofillulusan->delete();
        return redirect()->route('admin.capaianprofillulusan.index')->with('sukses','Capaian Profil Lulusan Ini Berhasil Di Hapus');
    }
}