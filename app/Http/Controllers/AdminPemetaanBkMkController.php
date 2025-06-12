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

        if (empty($kode_prodi)) {
            return view('admin.pemetaanbkmk.index', [
                'bks' => collect(),
                'mks' => collect(),
                'relasi' => [],
                'kode_prodi' => '',
                'prodis' => $prodis,
                'prodi' => null,
                'id_tahun' => '',
                'tahun_tersedia' => collect(),
            ]);
        }

        $prodi = $prodis->where('kode_prodi', $kode_prodi)->first();

        // Ambil tahun yang tersedia untuk prodi yang dipilih
        $tahun_tersedia = DB::table('profil_lulusans as pl')
            ->join('tahun', 'pl.id_tahun', '=', 'tahun.id_tahun')
            ->where('pl.kode_prodi', $kode_prodi)
            ->select('tahun.id_tahun', 'tahun.nama_kurikulum', 'tahun.tahun')
            ->distinct()
            ->orderBy('tahun.tahun', 'desc')
            ->get();

        // Ambil semua id_cpl terkait prodi dan tahun (jika dipilih)
        $cplIds = DB::table('capaian_profil_lulusans as cpl')
            ->join('cpl_pl as cp', 'cpl.id_cpl', '=', 'cp.id_cpl')
            ->join('profil_lulusans as pl', 'cp.id_pl', '=', 'pl.id_pl')
            ->where('pl.kode_prodi', $kode_prodi)
            ->when($id_tahun, function ($query) use ($id_tahun) {
                $query->where('pl.id_tahun', $id_tahun);
            })
            ->pluck('cpl.id_cpl')
            ->toArray();

        // Ambil mata kuliah dengan filter tahun
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
            ->orderBy('mata_kuliahs.kode_mk', 'asc')
            ->distinct()
            ->get();

        // Ambil bahan kajian dengan filter tahun
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
            ->whereIn('cb.id_cpl', $cplIds)
            ->select('bk.*', 'p.nama_prodi')
            ->distinct()
            ->orderBy('bk.kode_bk')
            ->get();

        // Ambil relasi BK-MK dengan filter berdasarkan CPL yang sudah difilter tahun
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