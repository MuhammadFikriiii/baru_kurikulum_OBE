<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminPemetaanBkMkController extends Controller
{
    public function index(Request $request)
    {
        $prodis = DB::table('prodis')->get();
        $kode_prodi = $request->get('kode_prodi');
        $id_tahun = $request->get('id_tahun');

        $tahun_tersedia = DB::table('tahun')
            ->select('id_tahun', 'nama_kurikulum', 'tahun')
            ->orderBy('tahun', 'desc')
            ->get();

        if (empty($kode_prodi)) {
            return view('admin.pemetaanbkmk.index', [
                'bks' => collect(),
                'mks' => collect(),
                'relasi' => [],
                'kode_prodi' => '',
                'prodis' => $prodis,
                'prodi' => null,
                'id_tahun' => $id_tahun,
                'tahun_tersedia' => $tahun_tersedia,
            ]);
        }

        $prodi = $prodis->where('kode_prodi', $kode_prodi)->first();

        $cplIds = DB::table('capaian_profil_lulusans as cpl')
            ->join('cpl_pl as cp', 'cpl.id_cpl', '=', 'cp.id_cpl')
            ->join('profil_lulusans as pl', 'cp.id_pl', '=', 'pl.id_pl')
            ->where('pl.kode_prodi', $kode_prodi)
            ->when($id_tahun, function ($query) use ($id_tahun) {
                $query->where('pl.id_tahun', $id_tahun);
            })
            ->pluck('cpl.id_cpl')
            ->toArray();

        $mks = DB::table('cpl_mk')
            ->join('mata_kuliahs', 'cpl_mk.kode_mk', '=', 'mata_kuliahs.kode_mk')
            ->join('capaian_profil_lulusans', 'cpl_mk.id_cpl', '=', 'capaian_profil_lulusans.id_cpl')
            ->join('cpl_pl', 'capaian_profil_lulusans.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans', 'cpl_pl.id_pl', '=', 'profil_lulusans.id_pl')
            ->join('prodis', 'profil_lulusans.kode_prodi', '=', 'prodis.kode_prodi')
            ->where('profil_lulusans.kode_prodi', $kode_prodi)
            ->when($id_tahun, function ($query) use ($id_tahun) {
                $query->where('profil_lulusans.id_tahun', $id_tahun);
            })
            ->whereIn('cpl_mk.id_cpl', $cplIds)
            ->select('mata_kuliahs.*', 'prodis.nama_prodi')
            ->orderBy('mata_kuliahs.kode_mk')
            ->distinct()
            ->get();

        $bks = DB::table('bahan_kajians as bk')
            ->join('cpl_bk as cb', 'bk.id_bk', '=', 'cb.id_bk')
            ->join('capaian_profil_lulusans as cpl', 'cb.id_cpl', '=', 'cpl.id_cpl')
            ->join('cpl_pl as cp', 'cpl.id_cpl', '=', 'cp.id_cpl')
            ->join('profil_lulusans as pl', 'cp.id_pl', '=', 'pl.id_pl')
            ->join('prodis as p', 'pl.kode_prodi', '=', 'p.kode_prodi')
            ->where('pl.kode_prodi', $kode_prodi)
            ->when($id_tahun, function ($query) use ($id_tahun) {
                $query->where('pl.id_tahun', $id_tahun);
            })
            ->select('bk.*', 'p.nama_prodi')
            ->distinct()
            ->orderBy('bk.kode_bk')
            ->get();

        $relasi = DB::table('bk_mk')
            ->whereIn('kode_mk', $mks->pluck('kode_mk'))
            ->whereIn('id_bk', $bks->pluck('id_bk'))
            ->get()
            ->groupBy('kode_mk');

        return view('admin.pemetaanbkmk.index', compact(
            'bks',
            'mks',
            'relasi',
            'kode_prodi',
            'prodis',
            'prodi',
            'id_tahun',
            'tahun_tersedia'
        ));
    }
}
