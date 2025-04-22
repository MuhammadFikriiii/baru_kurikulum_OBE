<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CapaianProfilLulusan;
use App\Models\CapaianPembelajaranMataKuliah;
use App\Models\MataKuliah;

class AdminPemetaanCplCpmkMkController extends Controller
{
    public function index()
    {
        $cpls = CapaianProfilLulusan::orderBy('id_cpl')->get();
        $cpmks = CapaianPembelajaranMataKuliah::orderBy('id_cpmk')->get();

        $data = DB::table('cpl_cpmk')
        ->join('cpmk_mk', 'cpl_cpmk.id_cpmk', '=', 'cpmk_mk.id_cpmk')
        ->join('mata_kuliahs as mk', 'cpmk_mk.kode_mk', '=', 'mk.kode_mk')
        ->select('cpl_cpmk.id_cpl', 'cpl_cpmk.id_cpmk', 'mk.nama_mk')
        ->get();    

        $matrix = [];
        foreach ($data as $row) {
            if ($row->id_cpl && $row->id_cpmk) {
                $matrix[$row->id_cpl][$row->id_cpmk][] = $row->nama_mk;
            }
        }

        return view('admin.pemetaancplcpmkmk.index', compact('cpls', 'cpmks', 'matrix'));
    }
}
