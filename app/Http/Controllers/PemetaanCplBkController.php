<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CapaianProfilLulusan;
use App\Models\BahanKajian;
use Illuminate\Support\Facades\DB;

class PemetaanCplBkController extends Controller
{
    public function index()
    {
        $cpls = CapaianProfilLulusan::all(); // Ambil semua CPL dari database
        $bks = BahanKajian::all(); // Ambil semua PL dari database
        
        // Ambil semua relasi CPL & PL dalam bentuk array
        $relasi = DB::table('cpl_bk')->get()->groupBy('kode_bk');

        return view('admin.pemetaancplbk.index', compact('cpls', 'bks', 'relasi'));
    }
}
