<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CapaianProfilLulusan;

class CapaianProfilLulusanController extends Controller
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
}
