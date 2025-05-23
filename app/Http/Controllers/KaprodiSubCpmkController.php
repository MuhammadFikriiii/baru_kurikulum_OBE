<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\SubCpmk;

class KaprodiSubCpmkController extends Controller
{
    public function index()
    {
        $kodeProdi = Auth::user()->kode_prodi;

        $subcpmks = DB::table('sub_cpmks as sc')
            ->join('capaian_pembelajaran_mata_kuliahs as cpmk', 'sc.id_cpmk', '=', 'cpmk.id_cpmk')
            ->join('cpl_cpmk as cplcpmk', 'cpmk.id_cpmk', '=', 'cplcpmk.id_cpmk')
            ->join('capaian_profil_lulusans as cpl', 'cplcpmk.id_cpl', '=', 'cpl.id_cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->select('sc.*', 'cpmk.kode_cpmk', 'cpmk.deskripsi_cpmk', 'cpmk.kode_cpmk')
            ->where('pl.kode_prodi', $kodeProdi)
            ->orderBy('sc.sub_cpmk')
            ->get();

        return view('kaprodi.subcpmk.index', compact('subcpmks'));
    }

    public function detail($id)
    {
        $kodeProdi = Auth::user()->kode_prodi;

        $subcpmk = DB::table('sub_cpmks as sc')
            ->join('capaian_pembelajaran_mata_kuliahs as cpmk', 'sc.id_cpmk', '=', 'cpmk.id_cpmk')
            ->join('cpl_cpmk as cplcpmk', 'cpmk.id_cpmk', '=', 'cplcpmk.id_cpmk')
            ->join('capaian_profil_lulusans as cpl', 'cplcpmk.id_cpl', '=', 'cpl.id_cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->where('pl.kode_prodi', $kodeProdi)
            ->where('sc.id_sub_cpmk', $id)
            ->select(
                'sc.id_sub_cpmk',
                'sc.sub_cpmk',
                'sc.uraian_cpmk',
                'cpmk.kode_cpmk',
                'cpmk.deskripsi_cpmk'
            )
            ->first();

        if (!$subcpmk) {
            abort(403, 'Akses ditolak atau data tidak ditemukan');
        }

        return view('kaprodi.subcpmk.detail', compact('subcpmk'));
    }

    public function pemetaanmkcpmksubcpmk()
    {
        $kodeProdi = Auth::user()->kode_prodi;

        $data = DB::table('sub_cpmks as sub')
            ->join('capaian_pembelajaran_mata_kuliahs as cpmk', 'sub.id_cpmk', '=', 'cpmk.id_cpmk')
            ->join('cpl_cpmk', 'cpmk.id_cpmk', '=', 'cpl_cpmk.id_cpmk')
            ->join('capaian_profil_lulusans as cpl', 'cpl_cpmk.id_cpl', '=', 'cpl.id_cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->join('prodis', 'pl.kode_prodi', '=', 'prodis.kode_prodi')
            ->join('cpmk_mk', 'cpmk.id_cpmk', '=', 'cpmk_mk.id_cpmk')
            ->join('mata_kuliahs as mk', 'cpmk_mk.kode_mk', '=', 'mk.kode_mk')
            ->where('prodis.kode_prodi', $kodeProdi)
            ->select(
                'mk.kode_mk',
                'mk.nama_mk',
                'cpmk.kode_cpmk',
                'cpmk.deskripsi_cpmk',
                'sub.id_sub_cpmk',
                'sub.sub_cpmk',
                'sub.uraian_cpmk',
            )
            ->orderBy('mk.kode_mk')
            ->orderBy('cpmk.kode_cpmk')
            ->distinct()
            ->get();

        return view('kaprodi.pemetaanmkcpmksubcpmk.index', compact('data'));
    }
}
