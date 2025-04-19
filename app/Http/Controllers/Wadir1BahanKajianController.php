<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\BahanKajian;
use App\Models\CapaianProfilLulusan;

class Wadir1BahanKajianController extends Controller
{
    public function index()
    {
        $bahankajians = DB::table('bahan_kajians as bk')
            ->select(
                'bk.id_bk', 'bk.nama_bk', 'bk.kode_bk', 'bk.deskripsi_bk', 
                'bk.referensi_bk', 'bk.status_bk', 'bk.knowledge_area',
                'prodis.nama_prodi'
            )
            ->leftJoin('cpl_bk', 'bk.id_bk', '=', 'cpl_bk.id_bk')
            ->leftJoin('capaian_profil_lulusans as cpl', 'cpl_bk.id_cpl', '=', 'cpl.id_cpl')
            ->leftJoin('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->leftJoin('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->leftJoin('prodis', 'pl.kode_prodi', '=', 'prodis.kode_prodi')
            ->groupBy('bk.id_bk', 'bk.nama_bk', 'bk.kode_bk', 'bk.deskripsi_bk', 
                    'bk.referensi_bk', 'bk.status_bk', 'bk.knowledge_area', 'prodis.nama_prodi')
            ->get();

        return view('wadir1.bahankajian.index', compact('bahankajians'));
    }

    public function detail(BahanKajian $id_bk)
    {
        $selectedCplIds = DB::table('cpl_bk')
            ->where('id_bk', $id_bk->id_bk)
            ->pluck('id_cpl')
            ->toArray();

        $capaianprofillulusans = CapaianProfilLulusan::whereIn('id_cpl', $selectedCplIds)->get();

        return view('wadir1.bahankajian.detail', [
            'id_bk' => $id_bk,
            'selectedCapaianProfilLulusans' => $selectedCplIds,
            'capaianprofillulusans' => $capaianprofillulusans
        ]);
    }
}
