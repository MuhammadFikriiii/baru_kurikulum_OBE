<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\BahanKajian;
use App\Models\CapaianProfilLulusan;

class Wadir1PemetaanCplBkController extends Controller
{
    public function index()
    {
        $cpls = CapaianProfilLulusan::all();
        $bks = BahanKajian::all();
        
        // Ambil semua relasi CPL & bk dalam bentuk array
        $relasi = DB::table('cpl_bk')->get()->groupBy('id_bk');

        return view('wadir1.pemetaancplbk.index', compact('cpls', 'bks', 'relasi'));
    }
}
