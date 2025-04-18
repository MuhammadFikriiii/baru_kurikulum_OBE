<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CapaianProfilLulusan;
use App\Models\BahanKajian;
use Illuminate\Support\Facades\DB;

class AdminPemetaanCplBkController extends Controller
{
    public function index()
    {
        $cpls = CapaianProfilLulusan::all();
        $bks = BahanKajian::all();
        
        // Ambil semua relasi CPL & bk dalam bentuk array
        $relasi = DB::table('cpl_bk')->get()->groupBy('id_bk');

        return view('admin.pemetaancplbk.index', compact('cpls', 'bks', 'relasi'));
    }
}
