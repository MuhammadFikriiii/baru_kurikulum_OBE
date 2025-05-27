<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\BahanKajian;
use App\Models\CapaianProfilLulusan;

class Wadir1PemetaanCplBkController extends Controller
{
   public function index(Request $request)
    {
        $prodis = DB::table('prodis')->get();
        $kode_prodi = $request->get('kode_prodi');

        if (empty($kode_prodi)) {
            return view('wadir1.pemetaancplbk.index', [
                'cpls' => collect(),
                'bks' => collect(),
                'relasi' => [],
                'kode_prodi' => '',
                'prodis' => $prodis,
                'prodi_aktif' => null,
                'prodiByCpl' => [],
            ]);
        }

        // Ambil prodi aktif
        $prodi_aktif = $prodis->where('kode_prodi', $kode_prodi)->first();

        // Ambil semua nama prodi per id_cpl (untuk tooltip di tabel)
        $prodiByCpl = DB::table('cpl_pl')
            ->join('profil_lulusans', 'cpl_pl.id_pl', '=', 'profil_lulusans.id_pl')
            ->join('prodis', 'profil_lulusans.kode_prodi', '=', 'prodis.kode_prodi')
            ->select('cpl_pl.id_cpl', 'prodis.nama_prodi')
            ->get()
            ->groupBy('id_cpl')
            ->map(fn($items) => $items->first()->nama_prodi ?? '-');

        // Ambil CPL berdasarkan prodi
        $cpls = DB::table('cpl_pl as cp')
            ->join('capaian_profil_lulusans as cpl', 'cp.id_cpl', '=', 'cpl.id_cpl')
            ->join('profil_lulusans as pl', 'cp.id_pl', '=', 'pl.id_pl')
            ->where('pl.kode_prodi', $kode_prodi)
            ->select('cpl.*')
            ->distinct()
            ->orderBy('id_cpl', 'asc')
            ->get();

        $cplIds = $cpls->pluck('id_cpl');

        // Relasi CPL - BK
        $relasi = DB::table('cpl_bk')
            ->whereIn('id_cpl', $cplIds)
            ->get()
            ->groupBy('id_bk');

        // Ambil BK yang terhubung dengan CPL prodi tersebut
        $bks = DB::table('bahan_kajians as bk')
            ->join('cpl_bk as cb', 'bk.id_bk', '=', 'cb.id_bk')
            ->whereIn('cb.id_cpl', $cplIds)
            ->select('bk.*')
            ->distinct()
            ->orderBy('kode_bk')
            ->get();

        return view('wadir1.pemetaancplbk.index', compact(
            'cpls',
            'bks',
            'relasi',
            'kode_prodi',
            'prodis',
            'prodi_aktif',
            'prodiByCpl'
        ));
    }
}
