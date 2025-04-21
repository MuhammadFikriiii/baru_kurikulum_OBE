<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CapaianPembelajaranMataKuliah;
use Illuminate\Support\Facades\DB;

class AdminCapaianPembelajaranMataKuliahController extends Controller
{
    public function index()
    {
        $cpmk = DB::table('capaian_pembelajaran_mata_kuliah as cpmk')
            ->select(
                'cpmk.kode_cpmk', 'cpmk.deskripsi_cpmk'
            )
            ->leftJoin('cpl_cpmk', 'cpmk.id_cpmk', '=', 'cpl_cpmk.id_cpmk')
            ->leftJoin('capaian_profil_lulusans as cpl', 'cpl_cpmk.id_cpl', '=', 'cpl.id_cpl')
            ->leftJoin('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->leftJoin('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->leftJoin('prodis', 'pl.kode_prodi', '=', 'prodis.kode_prodi')
            ->groupBy('cpmk.kode_cpmk', 'cpmk.deskripsi_cpmk',)
            ->get();
        return view('admin.capaianpembelajaranmatakuliah.index', compact('cpmk'));
    }
    public function create()
    {
        $capaianProfilLulusans = DB::table('capaian_profil_lulusans')->get();
        return view('admin.capaianpembelajaranmatakuliah.create',compact('capaianProfilLulusans'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kode_cpmk' => 'required|string|max:10',
            'deskripsi_cpmk' => 'required|string|max:255',
            'id_cpls' => 'required|array',
        ]);

        $cpmk = CapaianPembelajaranMataKuliah::create($request->only(['kode_cpmk', 'deskripsi_cpmk']));
        $id_cpmk = $cpmk->id_cpmk;
        foreach ($request->id_cpls as $id_cpl) {
            DB::table('cpl_cpmk')->insert([
                'id_cpmk' => $id_cpmk,
                'id_cpl' => $id_cpl,
            ]);
        }
        dd($data)
;        return redirect()->route('admin.capaianpembelajaranmatakuliah.index')->with('success', 'Capaian Pembelajaran Mata Kuliah berhasil ditambahkan.');
    }
}
