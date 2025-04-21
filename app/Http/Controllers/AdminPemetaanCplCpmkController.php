<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CapaianProfilLulusan;
use App\Models\CapaianPembelajaranMataKuliah;
use Illuminate\Support\Facades\DB;

class AdminPemetaanCplCpmkController extends Controller
{
    public function index()
    {
        $cpls = CapaianProfilLulusan::all();
        $cpmks = CapaianPembelajaranMataKuliah::all();
        
        $relasi = DB::table('cpl_cpmk')->get()->groupBy('id_cpmk');

        return view('admin.pemetaancplcpmk.index', compact('cpls', 'cpmks', 'relasi'));
    }
}