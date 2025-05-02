<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CapaianProfilLulusan;
use App\Models\BahanKajian;
use Illuminate\Support\Facades\DB;

class AdminPemetaanCplBkController extends Controller
{
    public function index(Request $request)
    {
        $prodis = DB::table('prodis')->get();
        $kode_prodi = $request->get('kode_prodi');
        
        // Query for CPLs based on prodi selection
        $query = DB::table('cpl_pl as cp')
            ->join('capaian_profil_lulusans as cpl', 'cp.id_cpl', '=', 'cpl.id_cpl')
            ->join('profil_lulusans as pl', 'cp.id_pl', '=', 'pl.id_pl')
            ->select('cpl.*')
            ->OrderBy('id_cpl', 'asc');
        
        // Only apply the where clause if a specific prodi is selected
        if ($kode_prodi && $kode_prodi !== 'all') {
            $query->where('pl.kode_prodi', $kode_prodi);
        }
        
        $cpls = $query->get();
        $cplIds = $cpls->pluck('id_cpl');
        
        $relasi = DB::table('cpl_bk')
            ->whereIn('id_cpl', $cplIds)
            ->get()
            ->groupBy('id_bk');
        
        $bks = BahanKajian::all();
        
        return view('admin.pemetaancplbk.index', compact('cpls', 'bks', 'relasi', 'kode_prodi', 'prodis'));
    }
}
