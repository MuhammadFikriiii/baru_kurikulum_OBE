<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminPemetaanCplMkBkController extends Controller
{
    public function index(Request $request)
    {
        $prodis = DB::table('prodis')->get();
        $kode_prodi = $request->get('kode_prodi');
        $id_tahun = $request->get('id_tahun');

        if (empty($kode_prodi)) {
            return view('admin.pemetaancplmkbk.index', [
                'cpls' => collect(),
                'bks' => collect(),
                'matrix' => [],
                'kode_prodi' => '',
                'prodis' => $prodis,
                'prodiByCpl' => [],
                'prodi' => null,
                'id_tahun' => '',
                'tahun_tersedia' => collect(),
            ]);
        }

        // Ambil prodi
        $prodi = $prodis->where('kode_prodi', $kode_prodi)->first();

        // Ambil tahun yang tersedia untuk prodi yang dipilih
        $tahun_tersedia = DB::table('profil_lulusans as pl')
            ->join('tahun', 'pl.id_tahun', '=', 'tahun.id_tahun')
            ->where('pl.kode_prodi', $kode_prodi)
            ->select('tahun.id_tahun', 'tahun.nama_kurikulum', 'tahun.tahun')
            ->distinct()
            ->orderBy('tahun.tahun', 'desc')
            ->get();

        // Ambil CPL dengan filter tahun
        $cpls = DB::table('capaian_profil_lulusans as cpl')
            ->join('cpl_pl as cp', 'cpl.id_cpl', '=', 'cp.id_cpl')
            ->join('profil_lulusans as pl', 'cp.id_pl', '=', 'pl.id_pl')
            ->where('pl.kode_prodi', $kode_prodi)
            ->when($id_tahun, function ($query) use ($id_tahun) {
                $query->where('pl.id_tahun', $id_tahun);
            })
            ->select('cpl.*')
            ->orderBy('cpl.id_cpl')
            ->distinct()
            ->get();

        $cplIds = $cpls->pluck('id_cpl');

        // Ambil BK yang terhubung dengan CPL (sudah terfilter tahun)
        $bks = DB::table('bahan_kajians as bk')
            ->join('cpl_bk as cb', 'bk.id_bk', '=', 'cb.id_bk')
            ->whereIn('cb.id_cpl', $cplIds)
            ->select('bk.*')
            ->distinct()
            ->orderBy('bk.id_bk')
            ->get();

        // Ambil MK yang berelasi dengan CPL & BK (sudah terfilter tahun melalui CPL)
        $mkCplBk = DB::table('mata_kuliahs as mk')
            ->leftJoin('cpl_mk', 'mk.kode_mk', '=', 'cpl_mk.kode_mk')
            ->leftJoin('bk_mk', 'mk.kode_mk', '=', 'bk_mk.kode_mk')
            ->whereIn('cpl_mk.id_cpl', $cplIds)
            ->whereIn('bk_mk.id_bk', $bks->pluck('id_bk'))
            ->select('cpl_mk.id_cpl', 'bk_mk.id_bk', 'mk.nama_mk')
            ->get();

        // Build matrix CPL x BK dengan MK
        $matrix = [];
        foreach ($mkCplBk as $row) {
            if ($row->id_cpl && $row->id_bk) {
                $matrix[$row->id_cpl][$row->id_bk][] = $row->nama_mk;
            }
        }

        // Prodi untuk tooltip CPL (dengan filter tahun)
        $prodiByCpl = [];
        foreach ($cpls as $cpl) {
            $prodiByCpl[$cpl->id_cpl] = DB::table('cpl_pl')
                ->join('profil_lulusans', 'cpl_pl.id_pl', '=', 'profil_lulusans.id_pl')
                ->join('prodis', 'profil_lulusans.kode_prodi', '=', 'prodis.kode_prodi')
                ->where('cpl_pl.id_cpl', $cpl->id_cpl)
                ->where('profil_lulusans.kode_prodi', $kode_prodi)
                ->when($id_tahun, function ($query) use ($id_tahun) {
                    $query->where('profil_lulusans.id_tahun', $id_tahun);
                })
                ->value('prodis.nama_prodi');
        }

        return view('admin.pemetaancplmkbk.index', compact(
            'cpls', 'bks', 'matrix',
            'kode_prodi', 'prodis', 'prodiByCpl', 'prodi',
            'id_tahun', 'tahun_tersedia'
        ));
    }
}