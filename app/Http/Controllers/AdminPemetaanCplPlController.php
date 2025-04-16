<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CapaianProfilLulusan;
use App\Models\ProfilLulusan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class AdminPemetaanCplPlController extends Controller
{
    public function index()
    {
        $cpls = CapaianProfilLulusan::all();
        $pls = ProfilLulusan::all();
        
        $relasi = DB::table('cpl_pl')->get()->groupBy('id_pl');

        return view('admin.pemetaancplpl.index', compact('cpls', 'pls', 'relasi'));
    }
}
