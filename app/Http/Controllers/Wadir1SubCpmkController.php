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

        // Ambil semua tahun tersedia seperti di index
        $tahun_tersedia = \App\Models\Tahun::orderBy('tahun', 'desc')->get();

        if (empty($kode_prodi)) {
            return view('wadir1.pemetaanmkcpmksubcpmk.index', [
                'kode_prodi' => '',
                'prodis' => $prodis,
                'prodi' => null,
                'query' => [],
                'id_tahun' => $id_tahun,
                'tahun_tersedia' => $tahun_tersedia, // Ubah dari collect() menjadi $tahun_tersedia
            ]);
        }

        $prodi = $prodis->where('kode_prodi', $kode_prodi)->first();

        // Buat query builder untuk filter yang dinamis
        $query = DB::table('capaian_pembelajaran_mata_kuliahs as cpmk')
            ->join('sub_cpmks as sub', 'cpmk.id_cpmk', '=', 'sub.id_cpmk')
            ->join('cpmk_mk as cpmk_mk', 'cpmk.id_cpmk', '=', 'cpmk_mk.id_cpmk')
            ->join('mata_kuliahs as mk', 'cpmk_mk.kode_mk', '=', 'mk.kode_mk')
            ->join('cpl_cpmk', 'cpmk.id_cpmk', '=', 'cpl_cpmk.id_cpmk')
            ->join('capaian_profil_lulusans as cpl', 'cpl_cpmk.id_cpl', '=', 'cpl.id_cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->join('prodis', 'pl.kode_prodi', '=', 'prodis.kode_prodi')
            ->join('tahun', 'pl.id_tahun', '=', 'tahun.id_tahun') // Tambahkan join dengan tabel tahun
            ->select(
                'cpmk.kode_cpmk',
                'cpmk.deskripsi_cpmk',
                'mk.kode_mk',
                'mk.nama_mk',
                'sub.sub_cpmk',
                'sub.uraian_cpmk',
                'tahun.tahun' // Tambahkan kolom tahun jika diperlukan
            )
            ->where('pl.kode_prodi', $kode_prodi)
            ->orderBy('cpmk.kode_cpmk');

        // Filter berdasarkan tahun jika ada (pindahkan sebelum get())
        if ($id_tahun) {
            $query->where('pl.id_tahun', $id_tahun);
        }

        // Execute query
        $query = $query->get();

        // Cek apakah data kosong
        $dataKosong = $query->isEmpty() && $kode_prodi;

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
