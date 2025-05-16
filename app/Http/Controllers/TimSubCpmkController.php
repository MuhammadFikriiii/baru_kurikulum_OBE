<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\SubCpmk;

class TimSubCpmkController extends Controller
{
    public function index()
    {
        
    }
    public function create()
    {
        $kodeProdi = Auth::user()->kode_prodi;

        $cpmks = DB::table('capaian_pembelajaran_mata_kuliahs as cpmk')
            ->join('cpl_cpmk as cplcpmk', 'cpmk.id_cpmk', '=', 'cplcpmk.id_cpmk')
            ->join('capaian_profil_lulusans as cpl', 'cplcpmk.id_cpl', '=', 'cpl.id_cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->select('cpmk.id_cpmk', 'cpmk.kode_cpmk', 'cpmk.deskripsi_cpmk')
            ->where('pl.kode_prodi', $kodeProdi)
            ->distinct()
            ->orderBy('cpmk.kode_cpmk')
            ->get();

        return view('tim.subcpmk.create', compact('cpmks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_cpmk' => 'required|exists:capaian_pembelajaran_mata_kuliahs,id_cpmk',
            'sub_cpmk' => 'required|string|max:10',
            'uraian_cpmk' => 'required|string|max:255'
        ]);

        SubCpmk::create($request->all());

        dd($request->all());

        return redirect()->route('tim.subcpmk.index')->with('success', 'Sub CPMK berhasil dibuat');
    }
}
