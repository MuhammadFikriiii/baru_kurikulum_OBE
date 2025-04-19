<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;   

class TimBahanKajianController extends Controller
{
    public function index()
{
    $user = Auth::guard('userprodi')->user();

        if (!$user || !$user->kode_prodi) {
            abort(403);
        }
        $kodeProdi = $user->kode_prodi;

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
        ->where('prodis.kode_prodi', '=', $kodeProdi)
        ->groupBy('bk.id_bk', 'bk.nama_bk', 'bk.kode_bk', 'bk.deskripsi_bk', 
                 'bk.referensi_bk', 'bk.status_bk', 'bk.knowledge_area', 'prodis.nama_prodi')
        ->get();

    return view('tim.bahankajian.index', compact('bahankajians'));
}
}
