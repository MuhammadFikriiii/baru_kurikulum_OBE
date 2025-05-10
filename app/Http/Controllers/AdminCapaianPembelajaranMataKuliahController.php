<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CapaianPembelajaranMataKuliah;
use Illuminate\Support\Facades\DB;

class AdminCapaianPembelajaranMataKuliahController extends Controller
{
    public function index()
    {
        $cpmks = DB::table('capaian_pembelajaran_mata_kuliahs as cpmk')
            ->select(
                'cpmk.kode_cpmk', 'cpmk.deskripsi_cpmk'
            )
            ->leftJoin('cpl_cpmk', 'cpmk.id_cpmk', '=', 'cpl_cpmk.id_cpmk')
            ->leftJoin('capaian_profil_lulusans as cpl', 'cpl_cpmk.id_cpl', '=', 'cpl.id_cpl')
            ->leftJoin('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->leftJoin('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->leftJoin('prodis', 'pl.kode_prodi', '=', 'prodis.kode_prodi')
            ->select('cpmk.id_cpmk', 'cpmk.kode_cpmk', 'cpmk.deskripsi_cpmk', 'prodis.nama_prodi')
            ->groupBy('cpmk.id_cpmk', 'cpmk.kode_cpmk', 'cpmk.deskripsi_cpmk', 'prodis.nama_prodi')
            ->get();
        return view('admin.capaianpembelajaranmatakuliah.index', compact('cpmks'));
    }
    public function create()
    {
        $capaianProfilLulusans = DB::table('capaian_profil_lulusans')->get();
        $mataKuliahs = DB::table('mata_kuliahs')->get();
        return view('admin.capaianpembelajaranmatakuliah.create',compact('capaianProfilLulusans', 'mataKuliahs'));
    }

    public function store(Request $request)
    {
        $request->validate([
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
        };
        foreach ($request->kode_mks as $kode_mk){
            DB::table('cpmk_mk')->insert([
                'id_cpmk' => $id_cpmk,
                'kode_mk' => $kode_mk,
            ]);
        }
        return redirect()->route('admin.capaianpembelajaranmatakuliah.index')->with('success', 'Capaian Pembelajaran Mata Kuliah berhasil ditambahkan.');
    }

    public function edit($id_cpmk)
    {
        $cpmks = CapaianPembelajaranMataKuliah::findOrFail($id_cpmk);
        $capaianprofillulusans = DB::table('capaian_profil_lulusans')->get();
        $matakuliahs = DB::table('mata_kuliahs')->get();

        $selectedCPLs = DB::table('cpl_cpmk')
        ->where('id_cpmk', $id_cpmk)
        ->pluck('id_cpl')
        ->toArray();

        $selectedMKs = DB::table('cpmk_mk')
        ->where('id_cpmk', $id_cpmk)
        ->pluck('kode_mk')
        ->toArray();

        return view ('admin.capaianpembelajaranmatakuliah.edit', compact('cpmks', 'capaianprofillulusans', 'matakuliahs','selectedCPLs', 'selectedMKs'));
    }

    public function update(Request $request, $id_cpmk)
    {
        $request->validate([
            'kode_cpmk' => 'required|string|max:10',
            'deskripsi_cpmk' => 'required|string|max:255',
            'id_cpls' => 'required|array',
            'kode_mks' => 'required|array',
        ]);

        $cpmks = CapaianPembelajaranMataKuliah::findOrFail($id_cpmk);
        $cpmks->update($request->only(['kode_cpmk', 'deskripsi_cpmk']));

        DB::table('cpl_cpmk')->where('id_cpmk', $id_cpmk)->delete();
        foreach ($request->id_cpls as $id_cpl) {
            DB::table('cpl_cpmk')->insert([
                'id_cpmk' => $id_cpmk,
                'id_cpl' => $id_cpl,
            ]);
        }

        DB::table('cpmk_mk')->where('id_cpmk', $id_cpmk)->delete();
        foreach ($request->kode_mks as $kode_mk) {
            DB::table('cpmk_mk')->insert([
                'id_cpmk' => $id_cpmk,
                'kode_mk' => $kode_mk,
            ]);
        }
        return redirect()->route('admin.capaianpembelajaranmatakuliah.index')->with('success', 'CPMK berhasil diperbarui.');
    }

    public function detail($id_cpmk)
    {
        $cpmk = DB::table('capaian_pembelajaran_mata_kuliahs as cpmk')
            ->where('cpmk.id_cpmk', $id_cpmk)
            ->select('cpmk.id_cpmk', 'cpmk.kode_cpmk', 'cpmk.deskripsi_cpmk')
            ->first();

        $cpls = DB::table('cpl_cpmk')
            ->join('capaian_profil_lulusans as cpl', 'cpl_cpmk.id_cpl', '=', 'cpl.id_cpl')
            ->where('cpl_cpmk.id_cpmk', $id_cpmk)
            ->select('cpl.id_cpl', 'cpl.deskripsi_cpl')
            ->get();

        $mks = DB::table('cpmk_mk')
            ->join('mata_kuliahs as mk', 'cpmk_mk.kode_mk', '=', 'mk.kode_mk')
            ->where('cpmk_mk.id_cpmk', $id_cpmk)
            ->select('mk.kode_mk', 'mk.nama_mk')
            ->get();

        return view('admin.capaianpembelajaranmatakuliah.detail', compact('cpmk', 'cpls', 'mks'));
    }
}
