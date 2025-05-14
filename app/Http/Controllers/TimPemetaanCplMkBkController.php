<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CapaianProfilLulusan;
use App\Models\BahanKajian;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TimPemetaanCplMkBkController extends Controller
{
   public function index()
    {
        $kodeProdi = Auth::user()->kode_prodi;

        $cpls = CapaianProfilLulusan::whereIn('id_cpl', function ($query) use ($kodeProdi) {
                $query->select('id_cpl')
                    ->from('cpl_pl')
                    ->join('profil_lulusans', 'cpl_pl.id_pl', '=', 'profil_lulusans.id_pl')
                    ->where('profil_lulusans.kode_prodi', $kodeProdi);
            })
            ->orderBy('kode_cpl', 'asc')
            ->get();

        $bks = BahanKajian::whereIn('id_bk', function ($query) use ($kodeProdi) {
                $query->select('id_bk')
                    ->from('cpl_bk')
                    ->join('capaian_profil_lulusans', 'cpl_bk.id_cpl', '=', 'capaian_profil_lulusans.id_cpl')
                    ->join('cpl_pl', 'capaian_profil_lulusans.id_cpl', '=', 'cpl_pl.id_cpl')
                    ->join('profil_lulusans', 'cpl_pl.id_pl', '=', 'profil_lulusans.id_pl')
                    ->where('profil_lulusans.kode_prodi', $kodeProdi);
            })
            ->orderBy('kode_bk', 'asc')
            ->get();   

        $mkCplBk = DB::table('mata_kuliahs as mk')
            ->leftJoin('cpl_mk', 'mk.kode_mk', '=', 'cpl_mk.kode_mk')
            ->leftJoin('bk_mk', 'mk.kode_mk', '=', 'bk_mk.kode_mk')
            ->leftJoin('capaian_profil_lulusans as cpl', 'cpl_mk.id_cpl', '=', 'cpl.id_cpl')
            ->leftJoin('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->leftJoin('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->leftJoin('bahan_kajians as bk', 'bk_mk.id_bk', '=', 'bk.id_bk')
            ->where('pl.kode_prodi', $kodeProdi)
            ->select('cpl_mk.id_cpl', 'bk_mk.id_bk', 'mk.nama_mk')
            ->get();

        $matrix = [];
        foreach ($mkCplBk as $row) {
            if ($row->id_cpl && $row->id_bk) {
                $matrix[$row->id_cpl][$row->id_bk][] = $row->nama_mk;
            }
        }

        return view('tim.pemetaancplmkbk.index', compact('cpls', 'bks', 'matrix'));
    }
}
