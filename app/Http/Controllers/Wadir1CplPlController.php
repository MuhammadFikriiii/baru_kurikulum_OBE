<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CapaianProfilLulusan;
use App\Models\ProfilLulusan;
use Illuminate\Support\Facades\DB;

class Wadir1CplPlController extends Controller
{
    public function index()
    {
        $cpls = CapaianProfilLulusan::all();
        $pls = ProfilLulusan::all();
        
        $relasi = DB::table('cpl_pl')->get()->groupBy('id_pl');

        return view('wadir1.pemetaancplpl.index', compact('cpls', 'pls', 'relasi'));
    }
}
