<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CapaianProfilLulusan;
use App\Models\BahanKajian;
use App\Models\MataKuliah;
use Illuminate\Support\Facades\DB;

class AdminPemetaanCplMkBkController extends Controller
{
    public function index()
    {
        $cpls = CapaianProfilLulusan::orderBy('id_cpl')->get();
        $bks = BahanKajian::orderBy('id_bk')->get();

        // Ambil data relasi CPL - BK melalui MK
        $mkCplBk = DB::table('mata_kuliahs as mk')
            ->leftJoin('cpl_mk', 'mk.kode_mk', '=', 'cpl_mk.kode_mk')
            ->leftJoin('bk_mk', 'mk.kode_mk', '=', 'bk_mk.kode_mk')
            ->select('cpl_mk.id_cpl', 'bk_mk.id_bk', 'mk.nama_mk')
            ->get();

        // Bangun matriks: CPL x BK => daftar nama mata kuliah
        $matrix = [];
        foreach ($mkCplBk as $row) {
            if ($row->id_cpl && $row->id_bk) {
                $matrix[$row->id_cpl][$row->id_bk][] = $row->nama_mk;
            }
        }

        return view('admin.pemetaancplmkbk.index', compact('cpls', 'bks', 'matrix'));
    }
}