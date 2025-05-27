<?php

namespace App\Http\Controllers;

use App\Models\ProfilLulusan;
use Illuminate\Http\Request;
use App\Models\Prodi;
use Illuminate\Support\Facades\DB;

class Wadir1ProfilLulusanController extends Controller
{
    public function index(Request $request)
    {
        $kode_prodi = $request->get('kode_prodi');
        $prodis = Prodi::all();
    
        $query = ProfilLulusan::with('prodi');
    
        if ($kode_prodi) {
            $query->where('kode_prodi', $kode_prodi);
        }
    
        $profillulusans = $query->orderBy('kode_pl', 'asc')->get();
    
        if (empty($kode_prodi)) {
            $profillulusans = collect();
        }
    
        return view('wadir1.profillulusan.index', compact('profillulusans', 'prodis', 'kode_prodi'));
    }

    public function detail (ProfilLulusan $id_pl)
    {
        return view('wadir1.profillulusan.detail', compact('id_pl'));
    }
}
