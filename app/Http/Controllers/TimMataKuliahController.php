<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TimMataKuliahController extends Controller
{
    public function index()
{
    $user = Auth::guard('userprodi')->user();

        if (!$user || !$user->kode_prodi) {
            abort(403);
        }
        $kodeProdi = $user->kode_prodi;

    $mata_kuliahs = DB::table('mata_kuliahs as mk')
        ->select(
            'mk.kode_mk', 'mk.nama_mk', 'mk.jenis_mk', 'mk.sks_mk',
            'mk.semester_mk', 'mk.kompetensi_mk',
            'prodis.nama_prodi'
        )
        ->leftJoin('cpl_mk', 'mk.kode_mk', '=', 'cpl_mk.kode_mk')
        ->leftJoin('capaian_profil_lulusans as cpl', 'cpl_mk.id_cpl', '=', 'cpl.id_cpl')
        ->leftJoin('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
        ->leftJoin('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
        ->leftJoin('prodis', 'pl.kode_prodi', '=', 'prodis.kode_prodi')
        ->where('prodis.kode_prodi', '=', $kodeProdi)
        ->groupBy('mk.kode_mk', 'mk.nama_mk', 'mk.jenis_mk', 'mk.sks_mk',
            'mk.semester_mk', 'mk.kompetensi_mk', 'prodis.nama_prodi')
        ->get();

    return view('tim.matakuliah.index', compact('mata_kuliahs'));
}
}
