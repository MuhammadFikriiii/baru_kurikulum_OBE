<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tahun;

class AdminPemetaanCplBkController extends Controller
{
    public function index(Request $request)
    {
        $kode_prodi = $request->get('kode_prodi');
        $id_tahun = $request->get('id_tahun');

        // Ambil semua prodi
        $prodis = DB::table('prodis')->get();

        // Ambil semua tahun yang tersedia (tidak tergantung prodi)
        $tahun_tersedia = Tahun::orderBy('tahun', 'desc')->get();

        // Jika belum pilih prodi, kosongkan CPL & BK
        if (empty($kode_prodi)) {
            return view('admin.pemetaancplbk.index', [
                'cpls' => collect(),
                'bks' => collect(),
                'relasi' => [],
                'kode_prodi' => '',
                'id_tahun' => $id_tahun,
                'prodis' => $prodis,
                'prodi_aktif' => null,
                'prodiByCpl' => [],
                'tahun_tersedia' => $tahun_tersedia,
            ]);
        }

        // Ambil data prodi aktif
        $prodi_aktif = $prodis->where('kode_prodi', $kode_prodi)->first();

        // Ambil semua nama prodi per id_cpl (tooltip di tabel)
        $prodiByCpl = DB::table('cpl_pl')
            ->join('profil_lulusans', 'cpl_pl.id_pl', '=', 'profil_lulusans.id_pl')
            ->join('prodis', 'profil_lulusans.kode_prodi', '=', 'prodis.kode_prodi')
            ->where('profil_lulusans.kode_prodi', $kode_prodi)
            ->when($id_tahun, function ($query) use ($id_tahun) {
                $query->where('profil_lulusans.id_tahun', $id_tahun);
            })
            ->select('cpl_pl.id_cpl', 'prodis.nama_prodi')
            ->get()
            ->groupBy('id_cpl')
            ->map(fn($items) => $items->first()->nama_prodi ?? '-');

        // Ambil CPL berdasarkan prodi dan tahun
        $cpls = DB::table('cpl_pl as cp')
            ->join('capaian_profil_lulusans as cpl', 'cp.id_cpl', '=', 'cpl.id_cpl')
            ->join('profil_lulusans as pl', 'cp.id_pl', '=', 'pl.id_pl')
            ->where('pl.kode_prodi', $kode_prodi)
            ->when($id_tahun, function ($query) use ($id_tahun) {
                $query->where('pl.id_tahun', $id_tahun);
            })
            ->select('cpl.*')
            ->distinct()
            ->orderBy('id_cpl', 'asc')
            ->get();

        $cplIds = $cpls->pluck('id_cpl');

        // Ambil relasi dan data BK
        if ($cplIds->isNotEmpty()) {
            $relasi = DB::table('cpl_bk')
                ->whereIn('id_cpl', $cplIds)
                ->get()
                ->groupBy('id_bk');

            $bks = DB::table('bahan_kajians as bk')
                ->join('cpl_bk as cb', 'bk.id_bk', '=', 'cb.id_bk')
                ->whereIn('cb.id_cpl', $cplIds)
                ->select('bk.*')
                ->distinct()
                ->orderBy('kode_bk')
                ->get();
        } else {
            $relasi = collect();
            $bks = collect();
        }

        return view('admin.pemetaancplbk.index', compact(
            'cpls',
            'bks',
            'relasi',
            'kode_prodi',
            'id_tahun',
            'prodis',
            'prodi_aktif',
            'prodiByCpl',
            'tahun_tersedia'
        ));
    }
}
