<?php

namespace App\Http\Controllers;

use App\Models\CapaianPembelajaranMataKuliah;
use Illuminate\Http\Request;
use App\Models\SubCpmk;
use Illuminate\Support\Facades\DB;

class AdminSubCpmkController extends Controller
{
    public function index(Request $request)
    {
        $prodis = DB::table('prodis')->get();
        $kode_prodi = $request->get('kode_prodi');

        if (empty($kode_prodi)) {
            return view('admin.subcpmk.index', [
                'kode_prodi' => '',
                'prodis' => $prodis,
                'prodi' => null,
                'subcpmks' => [],
            ]);
        }


        $prodi = $prodis->where('kode_prodi', $kode_prodi)->first();

        $subcpmks = DB::table('sub_cpmks as sub')
            ->join('capaian_pembelajaran_mata_kuliahs as cpmk', 'sub.id_cpmk', '=', 'cpmk.id_cpmk')
            ->join('cpl_cpmk', 'cpmk.id_cpmk', '=', 'cpl_cpmk.id_cpmk')
            ->join('capaian_profil_lulusans as cpl', 'cpl_cpmk.id_cpl', '=', 'cpl.id_cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->where('pl.kode_prodi', $kode_prodi)
            ->select(
                'sub.id_sub_cpmk',
                'sub.sub_cpmk',
                'sub.uraian_cpmk',
                'cpmk.deskripsi_cpmk'
            )
            ->get();

        return view('admin.subcpmk.index', compact('subcpmks', 'prodis', 'kode_prodi'));
    }
    public function create()
    {
        $cpmks = CapaianPembelajaranMataKuliah::all();
        return view('admin.subcpmk.create', compact('cpmks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_cpmk' => 'exists:capaian_pembelajaran_mata_kuliahs,id_cpmk',
            'sub_cpmk' => 'required|string|max:10',
            'uraian_cpmk' => 'required|string|max:255'
        ]);

        SubCpmk::create($request->all());
        return redirect()->route('admin.subcpmk.index')->with('success', 'subcpmk berhasil dibuat');
    }

    public function edit(SubCpmk $subcpmk)
    {
        $cpmks = CapaianPembelajaranMataKuliah::all();
        return view('admin.subcpmk.edit', compact('cpmks', 'subcpmk'));
    }

    public function update(Request $request, SubCpmk $subcpmk)
    {
        $request->validate([
            'id_cpmk' => 'exists:capaian_pembelajaran_mata_kuliahs,id_cpmk',
            'sub_cpmk' => 'required|string|max:10',
            'uraian_cpmk' => 'required|string|max:255'
        ]);
        $subcpmk->update($request->all());
        return redirect()->route('admin.subcpmk.index')->with('success', 'sub cpmk berhasil diperbaharui');
    }

    public function destroy(SubCpmk $subcpmk)
    {
        $subcpmk->delete();
        return redirect()->route('admin.subcpmk.index')->with('success', 'Sub CPMK berhasil dihapus');
    }

    public function detail(SubCpmk $subcpmk)
    {
        return view('admin.subcpmk.detail', compact('subcpmk'));
    }

    public function pemetaanmkcpmksubcpmk(Request $request)
    {
        $prodis = DB::table('prodis')->get();
        $kode_prodi = $request->get('kode_prodi');

        if (empty($kode_prodi)) {
            return view('admin.pemetaanmkcpmksubcpmk.index', [
                'kode_prodi' => '',
                'prodis' => $prodis,
                'prodi' => null,
                'data' => [],
            ]);
        }

        $prodi = $prodis->where('kode_prodi', $kode_prodi)->first();

        $data = DB::table('capaian_pembelajaran_mata_kuliahs as cpmk')
            ->join('sub_cpmks as sub', 'cpmk.id_cpmk', '=', 'sub.id_cpmk')
            ->join('cpmk_mk as cpmk_mk', 'cpmk.id_cpmk', '=', 'cpmk_mk.id_cpmk')
            ->join('mata_kuliahs as mk', 'cpmk_mk.kode_mk', '=', 'mk.kode_mk')
            ->join('cpl_cpmk', 'cpmk.id_cpmk', '=', 'cpl_cpmk.id_cpmk')
            ->join('capaian_profil_lulusans as cpl', 'cpl_cpmk.id_cpl', '=', 'cpl.id_cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->join('prodis', 'pl.kode_prodi', '=', 'prodis.kode_prodi')
            ->select(
                'cpmk.kode_cpmk',
                'cpmk.deskripsi_cpmk',
                'mk.kode_mk',
                'mk.nama_mk',
                'sub.sub_cpmk',
                'sub.uraian_cpmk',
            )
            ->where('pl.kode_prodi', $kode_prodi)
            ->orderBy('cpmk.kode_cpmk')
            ->get();

        return view('admin.pemetaanmkcpmksubcpmk.index', compact('data', 'prodis', 'kode_prodi'));
    }
}
