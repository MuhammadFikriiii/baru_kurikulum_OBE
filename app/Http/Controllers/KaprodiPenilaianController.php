<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Penilaian;

class KaprodiPenilaianController extends Controller
{
    public function index()
    {
        $kodeProdi = Auth::user()->kode_prodi;

        $penilaians = DB::table('penilaian as p')
            ->join('capaian_profil_lulusans as cpl', 'p.id_cpl', '=', 'cpl.id_cpl')
            ->join('mata_kuliahs as mk', 'p.kode_mk', '=', 'mk.kode_mk')
            ->join('capaian_pembelajaran_mata_kuliahs as cpmk', 'p.id_cpmk', '=', 'cpmk.id_cpmk')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->where('pl.kode_prodi', $kodeProdi)
            ->distinct()
            ->select(
                'id_penilaian',
                'p.id_cpl',
                'p.kode_mk',
                'p.id_cpmk',
                'p.kuis',
                'p.observasi',
                'p.presentasi',
                'p.uts',
                'p.uas',
                'p.project',
                'mk.nama_mk',
                'cpmk.kode_cpmk',
                'cpl.kode_cpl'
            )
            ->get();

        foreach ($penilaians as $penilaian) {
            $penilaian->count =
                ($penilaian->kuis ?? 0) +
                ($penilaian->observasi ?? 0) +
                ($penilaian->presentasi ?? 0) +
                ($penilaian->uts ?? 0) +
                ($penilaian->uas ?? 0) +
                ($penilaian->project ?? 0);
        }

        return view('kaprodi.penilaian.index', compact('penilaians'));
    }

    public function detail($id_penilaian)
    {
        $kodeProdi = Auth::user()->kode_prodi;

        $penilaian = DB::table('penilaian as p')
            ->join('capaian_profil_lulusans as cpl', 'p.id_cpl', '=', 'cpl.id_cpl')
            ->join('mata_kuliahs as mk', 'p.kode_mk', '=', 'mk.kode_mk')
            ->join('capaian_pembelajaran_mata_kuliahs as cpmk', 'p.id_cpmk', '=', 'cpmk.id_cpmk')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->where('pl.kode_prodi', $kodeProdi)
            ->where('p.id_penilaian', $id_penilaian)
            ->select(
                'p.*',
                'cpl.deskripsi_cpl',
                'cpl.kode_cpl',
                'mk.nama_mk',
                'cpmk.deskripsi_cpmk',
                'cpmk.kode_cpmk'
            )
            ->first();

        if (!$penilaian) {
            abort(403, 'Akses ditolak');
        }

        return view('kaprodi.penilaian.detail', compact('penilaian'));
    }
}
