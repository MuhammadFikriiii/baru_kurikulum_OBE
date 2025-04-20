<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\BahanKajian;
use App\Models\MataKuliah;

class AdminPemetaanBkMkController extends Controller
{
    public function index()
    {
        $bks = BahanKajian::all();
        $mks = MataKuliah::all();
        
        // Ambil semua relasi bk & mk dalam bentuk array
        $relasi = DB::table('bk_mk')->get()->groupBy('kode_mk');

        return view('admin.pemetaanbkmk.index', compact('bks', 'mks', 'relasi'));
    }
}
