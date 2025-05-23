<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\BahanKajian;
use App\Models\CapaianProfilLulusan;

class KaprodiBahanKajianController extends Controller
{
    public function index()
    {
        $kodeProdi = Auth::user()->kode_prodi;

        $bahankajians = DB::table('bahan_kajians as bk')
            ->select(
                'bk.id_bk',
                'bk.nama_bk',
                'bk.kode_bk',
                'bk.deskripsi_bk',
                'bk.referensi_bk',
                'bk.status_bk',
                'bk.knowledge_area',
                'prodis.nama_prodi'
            )
            ->leftJoin('cpl_bk', 'bk.id_bk', '=', 'cpl_bk.id_bk')
            ->leftJoin('capaian_profil_lulusans as cpl', 'cpl_bk.id_cpl', '=', 'cpl.id_cpl')
            ->leftJoin('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->leftJoin('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->leftJoin('prodis', 'pl.kode_prodi', '=', 'prodis.kode_prodi')
            ->where('prodis.kode_prodi', '=', $kodeProdi)
            ->groupBy(
                'bk.id_bk',
                'bk.nama_bk',
                'bk.kode_bk',
                'bk.deskripsi_bk',
                'bk.referensi_bk',
                'bk.status_bk',
                'bk.knowledge_area',
                'prodis.nama_prodi'
            )
            ->orderBy('bk.kode_bk', 'asc')
            ->get();

        return view('kaprodi.bahankajian.index', compact('bahankajians'));
    }

    public function detail($id_bk)
    {
        $bk = BahanKajian::findOrFail($id_bk);

        $kodeProdi = Auth::user()->kode_prodi;

        $akses = DB::table('cpl_bk')
            ->join('capaian_profil_lulusans as cpl', 'cpl_bk.id_cpl', '=', 'cpl.id_cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->join('prodis', 'pl.kode_prodi', '=', 'prodis.kode_prodi')
            ->where('cpl_bk.id_bk', $bk->id_bk)
            ->where('prodis.kode_prodi', $kodeProdi)
            ->exists();

        if (!$akses) {
            abort(403, 'Akses ditolak');
        }

        $selectedCapaianProfilLulusans = DB::table('cpl_bk')
            ->where('id_bk', $bk->id_bk)
            ->pluck('id_cpl')
            ->toArray();

        $capaianprofillulusans = CapaianProfilLulusan::whereIn('id_cpl', $selectedCapaianProfilLulusans)->get();

        return view('kaprodi.bahankajian.detail', compact('bk', 'capaianprofillulusans', 'selectedCapaianProfilLulusans'));
    }
}
