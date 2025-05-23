<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Penilaian;

class TimPenilaianController extends Controller
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
    
        return view('tim.penilaian.index', compact('penilaians'));
    }

    public function create()
    {
        $kodeProdi = Auth::user()->kode_prodi;

        $cpls = DB::table('capaian_profil_lulusans as cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->where('pl.kode_prodi', $kodeProdi)
            ->select('cpl.id_cpl', 'cpl.kode_cpl', 'cpl.deskripsi_cpl')
            ->distinct()
            ->get();

        $mks = DB::table('mata_kuliahs as mks')
            ->join('cpl_mk', 'mks.kode_mk', '=', 'cpl_mk.kode_mk')
            ->join('capaian_profil_lulusans as cpl', 'cpl.id_cpl', '=', 'cpl_mk.id_cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->where('pl.kode_prodi', $kodeProdi)
            ->select('mks.kode_mk', 'mks.nama_mk')
            ->distinct()
            ->get();

        $cpmks = DB::table('capaian_pembelajaran_mata_kuliahs as cpmks')
            ->join('cpl_cpmk', 'cpmks.id_cpmk', '=', 'cpl_cpmk.id_cpmk')
            ->join('capaian_profil_lulusans as cpl', 'cpl.id_cpl', '=', 'cpl_cpmk.id_cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->where('pl.kode_prodi', $kodeProdi)
            ->select('cpmks.id_cpmk', 'cpmks.kode_cpmk', 'cpmks.deskripsi_cpmk')
            ->distinct()
            ->get();

        return view('tim.penilaian.create', compact('cpls', 'mks', 'cpmks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_cpl' => 'required|exists:capaian_profil_lulusans,id_cpl',
            'kode_mk' => 'required|exists:mata_kuliahs,kode_mk',
            'id_cpmk' => 'required|exists:capaian_pembelajaran_mata_kuliahs,id_cpmk',
            'kuis' => 'required|integer|min:0|max:100',
            'observasi' => 'required|integer|min:0|max:100',
            'presentasi' => 'required|integer|min:0|max:100',
            'uts' => 'required|integer|min:0|max:100',
            'uas' => 'required|integer|min:0|max:100',
            'project' => 'required|integer|min:0|max:100',
        ]);

        Penilaian::create($request->all());
        return redirect()->route('tim.penilaian.index')->with('success', 'Penilaian berhasil ditambahkan.');
    }

    public function edit($id_penilaian)
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
        
        $cpls = DB::table('capaian_profil_lulusans as cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->where('pl.kode_prodi', $kodeProdi)
            ->select('cpl.id_cpl', 'cpl.kode_cpl', 'cpl.deskripsi_cpl')
            ->distinct()
            ->get();

        $mks = DB::table('mata_kuliahs as mks')
            ->join('cpl_mk', 'mks.kode_mk', '=', 'cpl_mk.kode_mk')
            ->join('capaian_profil_lulusans as cpl', 'cpl.id_cpl', '=', 'cpl_mk.id_cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->where('pl.kode_prodi', $kodeProdi)
            ->select('mks.kode_mk', 'mks.nama_mk')
            ->distinct()
            ->get();

        $cpmks = DB::table('capaian_pembelajaran_mata_kuliahs as cpmks')
            ->join('cpl_cpmk', 'cpmks.id_cpmk', '=', 'cpl_cpmk.id_cpmk')
            ->join('capaian_profil_lulusans as cpl', 'cpl.id_cpl', '=', 'cpl_cpmk.id_cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->where('pl.kode_prodi', $kodeProdi)
            ->select('cpmks.id_cpmk', 'cpmks.kode_cpmk', 'cpmks.deskripsi_cpmk')
            ->distinct()
            ->get();

        return view('tim.penilaian.edit', compact('penilaian', 'cpls', 'mks', 'cpmks'));
    }

    public function update(Request $request, Penilaian $penilaian)
    {
        $request->validate([
            'id_cpl' => 'required|exists:capaian_profil_lulusans,id_cpl',
            'kode_mk' => 'required|exists:mata_kuliahs,kode_mk',
            'id_cpmk' => 'required|exists:capaian_pembelajaran_mata_kuliahs,id_cpmk',
            'kuis' => 'required|integer|min:0|max:100',
            'observasi' => 'required|integer|min:0|max:100',
            'presentasi' => 'required|integer|min:0|max:100',
            'uts' => 'required|integer|min:0|max:100',
            'uas' => 'required|integer|min:0|max:100',
            'project' => 'required|integer|min:0|max:100',
        ]);

        $penilaian->update($request->all());
        return redirect()->route('tim.penilaian.index')->with('success', 'Penilaian berhasil diperbarui.');
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

        return view('tim.penilaian.detail', compact('penilaian'));
    }
}
