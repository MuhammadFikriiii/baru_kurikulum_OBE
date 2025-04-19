<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CapaianProfilLulusan;
use App\Models\MataKuliah;
use Illuminate\Support\Facades\DB;

class AdminPemetaanCplMkController extends Controller
{
    public function index()
    {
        $cpls = CapaianProfilLulusan::all();
        $mks = MataKuliah::all();
        
        $relasi = DB::table('cpl_mk')->get()->groupBy('kode_mk');

        return view('admin.pemetaancplmk.index', compact('cpls', 'mks', 'relasi'));
    }
}