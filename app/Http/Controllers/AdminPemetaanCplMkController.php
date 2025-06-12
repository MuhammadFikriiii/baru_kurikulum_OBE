<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminPemetaanCplMkController extends Controller
{
    public function index(Request $request)
    {
        $prodis = DB::table('prodis')->get();
        $kode_prodi = $request->get('kode_prodi');
        $id_tahun = $request->get('id_tahun');

        if (empty($kode_prodi)) {
            return view('admin.pemetaancplmk.index', [
                'cpls' => collect(),
                'mks' => collect(),
                'relasi' => [],
                'kode_prodi' => '',
                'prodis' => $prodis,
                'prodi' => null,
                'prodiByCpl' => collect(),
                'id_tahun' => '',
                'tahun_tersedia' => collect(),
            ]);
        }

        $prodi_aktif = $prodis->where('kode_prodi', $kode_prodi)->first();

        $tahun_tersedia = DB::table('profil_lulusans as pl')
            ->join('tahun', 'pl.id_tahun', '=', 'tahun.id_tahun')
            ->where('pl.kode_prodi', $kode_prodi)
            ->select('tahun.id_tahun', 'tahun.nama_kurikulum', 'tahun.tahun')
            ->distinct()
            ->orderBy('tahun.tahun', 'desc')
            ->get();

        // Ambil CPL sesuai prodi dan tahun (jika dipilih)
        $cpls = DB::table('cpl_pl as cp')
            ->join('capaian_profil_lulusans as cpl', 'cp.id_cpl', '=', 'cpl.id_cpl')
            ->join('profil_lulusans as pl', 'cp.id_pl', '=', 'pl.id_pl')
            ->where('pl.kode_prodi', $kode_prodi)
            ->when($id_tahun, function ($query) use ($id_tahun) {
                $query->where('pl.id_tahun', $id_tahun);
            })
            ->select('cpl.*')
            ->orderBy('cpl.id_cpl', 'asc')
            ->distinct()
            ->get();

        $cplIds = $cpls->pluck('id_cpl')->toArray();

        // Prodi berdasarkan CPL (untuk tooltip atau info)
        $prodiByCpl = DB::table('cpl_mk')
            ->join('capaian_profil_lulusans', 'cpl_mk.id_cpl', '=', 'capaian_profil_lulusans.id_cpl')
            ->join('cpl_pl', 'capaian_profil_lulusans.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans', 'cpl_pl.id_pl', '=', 'profil_lulusans.id_pl')
            ->join('prodis', 'profil_lulusans.kode_prodi', '=', 'prodis.kode_prodi')
            ->where('profil_lulusans.kode_prodi', $kode_prodi)
            ->when($id_tahun, function ($query) use ($id_tahun) {
                $query->where('profil_lulusans.id_tahun', $id_tahun);
            })
            ->whereIn('cpl_mk.id_cpl', $cplIds)
            ->select('cpl_mk.id_cpl', 'prodis.nama_prodi')
            ->get()
            ->groupBy('id_cpl')
            ->map(fn($items) => $items->first()->nama_prodi ?? '-');

        // Ambil Mata Kuliah yang berelasi dengan CPL dari prodi dan tahun tertentu
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

        // Ambil relasi CPL - MK, filter CPL yang relevan dengan prodi dan tahun ini
        $relasi = DB::table('cpl_mk')
            ->join('capaian_profil_lulusans', 'cpl_mk.id_cpl', '=', 'capaian_profil_lulusans.id_cpl')
            ->join('cpl_pl', 'capaian_profil_lulusans.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans', 'cpl_pl.id_pl', '=', 'profil_lulusans.id_pl')
            ->where('profil_lulusans.kode_prodi', $kode_prodi)
            ->when($id_tahun, function ($query) use ($id_tahun) {
                $query->where('profil_lulusans.id_tahun', $id_tahun);
            })
            ->whereIn('cpl_mk.id_cpl', $cplIds)
            ->select('cpl_mk.*')
            ->get()
            ->groupBy('kode_mk');

        return view('admin.pemetaancplmk.index', compact(
            'cpls',
            'mks',
            'relasi',
            'kode_prodi',
            'prodis',
            'prodiByCpl',
            'id_tahun',
            'tahun_tersedia',
        ));
    }
}
