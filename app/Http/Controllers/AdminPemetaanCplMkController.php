<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CapaianProfilLulusan;
use App\Models\MataKuliah;
use Illuminate\Support\Facades\DB;

class AdminPemetaanCplMkController extends Controller
{
    public function index(Request $request)
    {
        $prodis = DB::table('prodis')->get();
        $kode_prodi = $request->get('kode_prodi');
        
        $query = DB::table('cpl_pl as cp')
            ->join('capaian_profil_lulusans as cpl', 'cp.id_cpl', '=', 'cpl.id_cpl')
            ->join('profil_lulusans as pl', 'cp.id_pl', '=', 'pl.id_pl')
            ->select('cpl.*')
            ->OrderBy('id_cpl', 'asc');
        
        if ($kode_prodi && $kode_prodi !== 'all') {
            $query->where('pl.kode_prodi', $kode_prodi);
        }
        
        $cpls = $query->get();
        $cplIds = $cpls->pluck('id_cpl');
        
        $relasi = DB::table('cpl_mk')
            ->whereIn('id_cpl', $cplIds)
            ->get()
            ->groupBy('kode_mk');
        
        $mks = MataKuliah::all();
        
        return view('admin.pemetaancplmk.index', compact('cpls', 'mks', 'relasi', 'kode_prodi', 'prodis'));
    }
}