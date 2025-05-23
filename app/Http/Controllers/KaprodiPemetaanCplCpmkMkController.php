<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class KaprodiPemetaanCplCpmkMkController extends Controller
{
    public function index()
    {
        $kodeProdi = Auth::user()->kode_prodi;

        $data = DB::table('capaian_profil_lulusans as cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->join('prodis', 'pl.kode_prodi', '=', 'prodis.kode_prodi')
            ->leftJoin('cpl_cpmk', 'cpl.id_cpl', '=', 'cpl_cpmk.id_cpl')
            ->leftJoin('capaian_pembelajaran_mata_kuliahs as cpmk', 'cpl_cpmk.id_cpmk', '=', 'cpmk.id_cpmk')
            ->leftJoin('cpmk_mk', 'cpmk.id_cpmk', '=', 'cpmk_mk.id_cpmk')
            ->leftJoin('mata_kuliahs as mk', 'cpmk_mk.kode_mk', '=', 'mk.kode_mk')
            ->select(
                'cpl.id_cpl',
                'cpl.kode_cpl',
                'cpl.deskripsi_cpl',
                'cpmk.id_cpmk',
                'cpmk.kode_cpmk',
                'cpmk.deskripsi_cpmk',
                'mk.nama_mk'
            )
            ->where('prodis.kode_prodi', $kodeProdi)
            ->orderBy('cpl.kode_cpl', 'asc')
            ->orderBy('cpmk.id_cpmk', 'asc')
            ->get();

        $matrix = [];
        foreach ($data as $row) {
            $matrix[$row->kode_cpl]['deskripsi'] = $row->deskripsi_cpl;
            $matrix[$row->kode_cpl]['cpmk'][$row->kode_cpmk]['deskripsi'] = $row->deskripsi_cpmk;
            $matrix[$row->kode_cpl]['cpmk'][$row->kode_cpmk]['mk'][] = $row->nama_mk;
        }
        return view('kaprodi.pemetaancplcpmkmk.index', compact('matrix'));
    }

    public function pemenuhancplcpmkmk()
    {
        $kodeProdi = Auth::user()->kode_prodi;

        $data = DB::table('capaian_profil_lulusans as cpl')
            ->Join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->join('prodis', 'pl.kode_prodi', '=', 'prodis.kode_prodi')
            ->leftJoin('cpl_cpmk as cpl_cpmk', 'cpl_cpmk.id_cpl', '=', 'cpl.id_cpl')
            ->leftJoin('capaian_pembelajaran_mata_kuliahs as cpmk', 'cpl_cpmk.id_cpmk', '=', 'cpmk.id_cpmk')
            ->leftJoin('cpmk_mk', 'cpl_cpmk.id_cpmk', '=', 'cpmk_mk.id_cpmk')
            ->leftJoin('mata_kuliahs as mk', 'cpmk_mk.kode_mk', '=', 'mk.kode_mk')
            ->where('prodis.kode_prodi', $kodeProdi)
            ->select(
                'cpl.kode_cpl',
                'cpl.deskripsi_cpl',
                'cpmk.kode_cpmk',
                'cpmk.deskripsi_cpmk',
                'mk.kode_mk',
                'nama_mk',
                'mk.semester_mk',
                'prodis.nama_prodi'
            )
            ->orderBy('cpl.kode_cpl')
            ->orderBy('cpmk.kode_cpmk')
            ->get();

        $matrix = [];
        foreach ($data as $row) {
            $kode_cpl = $row->kode_cpl;
            $kode_cpmk = $row->kode_cpmk;
            $semester = $row->semester_mk;

            $matrix[$kode_cpl]['deskripsi'] = $row->deskripsi_cpl;
            $matrix[$kode_cpl]['prodi'] = $row->nama_prodi;
            $matrix[$kode_cpl]['cpmk'][$kode_cpmk]['deskripsi'] = $row->deskripsi_cpmk;
            $matrix[$kode_cpl]['cpmk'][$kode_cpmk]['prodi'] = $row->nama_prodi;

            if ($semester >= 1 && $semester <= 8) {
                $matrix[$kode_cpl]['cpmk'][$kode_cpmk]['semester'][$semester][] = $row->nama_mk;
            }
        }

        return view('kaprodi.pemetaancplcpmkmk.pemenuhancplcpmkmk', compact('data', 'matrix'));
    }

    public function pemetaanmkcplcpmk()
    {
        $kodeProdi = Auth::user()->kode_prodi;

        $semuaCpl = DB::table('capaian_profil_lulusans as cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->join('prodis', 'pl.kode_prodi', '=', 'prodis.kode_prodi')
            ->where('prodis.kode_prodi', $kodeProdi)
            ->select('cpl.id_cpl', 'cpl.kode_cpl', 'cpl.deskripsi_cpl', 'prodis.nama_prodi')
            ->orderBy('cpl.kode_cpl')
            ->get();


        $semuaMk = DB::table('capaian_profil_lulusans as cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->join('prodis', 'pl.kode_prodi', '=', 'prodis.kode_prodi')
            ->join('cpl_mk', 'cpl.id_cpl', '=', 'cpl_mk.id_cpl')
            ->join('mata_kuliahs as mk', 'cpl_mk.kode_mk', '=', 'mk.kode_mk')
            ->where('prodis.kode_prodi', $kodeProdi)
            ->select('mk.kode_mk', 'mk.nama_mk', 'mk.semester_mk')
            ->orderBy('mk.kode_mk')
            ->get();

        $relasi = DB::table('cpl_cpmk')
            ->join('capaian_pembelajaran_mata_kuliahs as cpmk', 'cpl_cpmk.id_cpmk', '=', 'cpmk.id_cpmk')
            ->join('capaian_profil_lulusans as cpl', 'cpl_cpmk.id_cpl', '=', 'cpl.id_cpl')
            ->join('cpmk_mk', 'cpl_cpmk.id_cpmk', '=', 'cpmk_mk.id_cpmk')
            ->join('mata_kuliahs as mk', 'cpmk_mk.kode_mk', '=', 'mk.kode_mk')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->join('prodis', 'pl.kode_prodi', '=', 'prodis.kode_prodi')
            ->where('prodis.kode_prodi', $kodeProdi)
            ->select(
                'mk.kode_mk',
                'mk.nama_mk',
                'mk.semester_mk',
                'cpl.kode_cpl',
                'cpl.deskripsi_cpl',
                'cpmk.kode_cpmk',
                'cpmk.deskripsi_cpmk',
                'prodis.nama_prodi'
            )
            ->orderBy('mk.kode_mk')
            ->orderBy('cpl.kode_cpl')
            ->get();

        $matrix = [];

        foreach ($semuaMk as $mk) {
            $matrix[$mk->kode_mk]['nama'] = $mk->nama_mk;
            foreach ($semuaCpl as $cpl) {
                $matrix[$mk->kode_mk]['cpl'][$cpl->kode_cpl]['cpmks'] = [];
            }
        }

        foreach ($relasi as $row) {
            $matrix[$row->kode_mk]['cpl'][$row->kode_cpl]['cpmks'][] = $row->kode_cpmk;
            $matrix[$row->kode_mk]['cpl'][$row->kode_cpl]['cpmk_details'][$row->kode_cpmk] = [
                'nama_prodi' => $row->nama_prodi,
                'deskripsi_cpmk' => $row->deskripsi_cpmk,
            ];
        }

        return view('kaprodi.pemetaancplcpmkmk.pemetaanmkcplcpmk', compact('matrix', 'semuaMk', 'semuaCpl'));
    }
}
