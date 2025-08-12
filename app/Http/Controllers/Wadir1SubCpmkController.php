<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tahun;
use App\Models\SubCpmk;

class Wadir1SubCpmkController extends Controller
{
    public function index(Request $request)
    {
        $prodis = DB::table('prodis')->get();
        $kode_prodi = $request->get('kode_prodi');
        $id_tahun = $request->get('id_tahun');

        $tahun_tersedia = Tahun::orderBy('tahun', 'desc')->get();

        if (empty($kode_prodi)) {
            return view('wadir1.subcpmk.index', [
                'kode_prodi' => '',
                'prodis' => $prodis,
                'prodi' => null,
                'subcpmks' => [],
                'id_tahun' => $id_tahun,
                'tahun_tersedia' => $tahun_tersedia,
                'dataKosong' => true,
            ]);
        }

        $query = DB::table('sub_cpmks as sub')
            ->join('capaian_pembelajaran_mata_kuliahs as cpmk', 'sub.id_cpmk', '=', 'cpmk.id_cpmk')
            ->join('cpl_cpmk', 'cpmk.id_cpmk', '=', 'cpl_cpmk.id_cpmk')
            ->join('capaian_profil_lulusans as cpl', 'cpl_cpmk.id_cpl', '=', 'cpl.id_cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->join('prodis', 'pl.kode_prodi', '=', 'prodis.kode_prodi')
            ->join('tahun', 'pl.id_tahun', '=', 'tahun.id_tahun')
            ->where('pl.kode_prodi', $kode_prodi)
            ->select(
                'sub.id_sub_cpmk',
                'kode_cpmk',
                'sub.sub_cpmk',
                'sub.uraian_cpmk',
                'cpmk.deskripsi_cpmk',
                'prodis.nama_prodi',
                'tahun.tahun'
            );

        if ($id_tahun) {
            $query->where('pl.id_tahun', $id_tahun);
        }

        $subcpmks = $query->get();
        $dataKosong = $subcpmks->isEmpty();

        return view('wadir1.subcpmk.index', compact(
            'subcpmks',
            'prodis',
            'kode_prodi',
            'id_tahun',
            'tahun_tersedia',
            'dataKosong'
        ));
    }

    public function detail(SubCpmk $subcpmk)
    {
        return view('wadir1.subcpmk.detail', compact('subcpmk'));
    }

    public function pemetaanmkcpmksubcpmk(Request $request)
    {
        $prodis = DB::table('prodis')->get();
        $kode_prodi = $request->get('kode_prodi');
        $id_tahun = $request->get('id_tahun');

        $tahun_tersedia = \App\Models\Tahun::orderBy('tahun', 'desc')->get();

        if (empty($kode_prodi)) {
            return view('wadir1.pemetaanmkcpmksubcpmk.index', [
                'kode_prodi' => '',
                'prodis' => $prodis,
                'prodi' => null,
                'query' => [],
                'id_tahun' => $id_tahun,
                'tahun_tersedia' => $tahun_tersedia,
                'dataKosong' => false
            ]);
        }

        $prodi = $prodis->where('kode_prodi', $kode_prodi)->first();

        $query = DB::table('sub_cpmks as sub')
            ->join('capaian_pembelajaran_mata_kuliahs as cpmk', 'sub.id_cpmk', '=', 'cpmk.id_cpmk')
            ->join('cpl_cpmk', 'cpmk.id_cpmk', '=', 'cpl_cpmk.id_cpmk')
            ->join('capaian_profil_lulusans as cpl', 'cpl_cpmk.id_cpl', '=', 'cpl.id_cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->join('prodis', 'pl.kode_prodi', '=', 'prodis.kode_prodi')
            ->join('mata_kuliahs as mk', 'sub.kode_mk', '=', 'mk.kode_mk') // ambil langsung dari sub_cpmk
            ->where('prodis.kode_prodi', $kode_prodi)
            ->select(
                'mk.kode_mk',
                'mk.nama_mk',
                'cpmk.kode_cpmk',
                'cpmk.deskripsi_cpmk',
                'sub.id_sub_cpmk',
                'sub.sub_cpmk',
                'sub.uraian_cpmk'
            )
            ->orderBy('mk.kode_mk')
            ->orderBy('cpmk.kode_cpmk')
            ->distinct();

        if ($id_tahun) {
            $query->where('pl.id_tahun', $id_tahun);
        }

        $query = $query->get();

        $dataKosong = $query->isEmpty();

        return view('wadir1.pemetaanmkcpmksubcpmk.index', compact(
            'query',
            'prodis',
            'kode_prodi',
            'prodi',
            'id_tahun',
            'tahun_tersedia',
            'dataKosong'
        ));
    }
}
