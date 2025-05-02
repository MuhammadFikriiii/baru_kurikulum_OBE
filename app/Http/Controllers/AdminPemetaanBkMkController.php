<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\BahanKajian;
use App\Models\MataKuliah;

class AdminPemetaanBkMkController extends Controller
{
    public function index(Request $request)
    {
        $prodis = DB::table('prodis')->get();
        $kode_prodi = $request->get('kode_prodi', 'all');
        
        $query = DB::table('mata_kuliahs as mk')
            ->join('cpl_mk', 'mk.kode_mk', '=', 'cpl_mk.kode_mk')
            ->join('capaian_profil_lulusans as cpl', 'cpl_mk.id_cpl', '=', 'cpl.id_cpl')
            ->join('cpl_pl as cp', 'cpl.id_cpl', '=', 'cp.id_cpl')
            ->join('profil_lulusans as pl', 'cp.id_pl', '=', 'pl.id_pl')
            ->select('mk.*')
            ->distinct()
            ->orderBy('mk.kode_mk', 'asc');
        
        $bkQuery = DB::table('bahan_kajians as bk')
            ->join('cpl_bk', 'bk.id_bk', '=', 'cpl_bk.id_bk')
            ->join('capaian_profil_lulusans as cpl', 'cpl_bk.id_cpl', '=', 'cpl.id_cpl')
            ->join('cpl_pl as cp', 'cpl.id_cpl', '=', 'cp.id_cpl')
            ->join('profil_lulusans as pl', 'cp.id_pl', '=', 'pl.id_pl')
            ->select('bk.*')
            ->distinct()
            ->orderBy('bk.kode_bk', 'asc');
        
        if ($kode_prodi && $kode_prodi !== 'all') {
            $query->where('pl.kode_prodi', $kode_prodi);
            $bkQuery->where('pl.kode_prodi', $kode_prodi);
        }
        
        $mks = $query->get();
        $bks = $bkQuery->get();
        
        $mkKodes = $mks->pluck('kode_mk');
        $bkIds = $bks->pluck('id_bk');
        
        $relasi = DB::table('bk_mk')
            ->whereIn('kode_mk', $mkKodes)
            ->whereIn('id_bk', $bkIds)
            ->get()
            ->groupBy('kode_mk');
        
        return view('admin.pemetaanbkmk.index', compact('bks', 'mks', 'relasi', 'kode_prodi', 'prodis'));
    }
}