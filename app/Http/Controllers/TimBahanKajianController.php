<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\BahanKajian;   

class TimBahanKajianController extends Controller
{
    public function index()
{
    $user = Auth::guard('userprodi')->user();

        if (!$user || !$user->kode_prodi) {
            abort(403);
        }
        $kodeProdi = $user->kode_prodi;

    $bahankajians = DB::table('bahan_kajians as bk')
        ->select(
            'bk.id_bk', 'bk.nama_bk', 'bk.kode_bk', 'bk.deskripsi_bk', 
            'bk.referensi_bk', 'bk.status_bk', 'bk.knowledge_area',
            'prodis.nama_prodi'
        )
        ->leftJoin('cpl_bk', 'bk.id_bk', '=', 'cpl_bk.id_bk')
        ->leftJoin('capaian_profil_lulusans as cpl', 'cpl_bk.id_cpl', '=', 'cpl.id_cpl')
        ->leftJoin('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
        ->leftJoin('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
        ->leftJoin('prodis', 'pl.kode_prodi', '=', 'prodis.kode_prodi')
        ->where('prodis.kode_prodi', '=', $kodeProdi)
        ->groupBy('bk.id_bk', 'bk.nama_bk', 'bk.kode_bk', 'bk.deskripsi_bk', 
                 'bk.referensi_bk', 'bk.status_bk', 'bk.knowledge_area', 'prodis.nama_prodi')
        ->get();

    return view('tim.bahankajian.index', compact('bahankajians'));
}

public function create()
    {
        $user = Auth::guard('userprodi')->user();

        if (!$user || !$user->kode_prodi) {
            abort(403, 'Akses ditolak');
        }

        $kodeProdi = $user->kode_prodi;
        
        $capaianProfilLulusans = DB::table('capaian_profil_lulusans as cpl')
        ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
        ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
        ->where('pl.kode_prodi', $kodeProdi)
        ->select('cpl.id_cpl', 'cpl.kode_cpl', 'cpl.deskripsi_cpl')
        ->distinct()
        ->get();
        return view('tim.bahankajian.create', compact('capaianProfilLulusans'));
    }

    public function store(Request $request)
    {
        $user = Auth::guard('userprodi')->user();

        if (!$user || !$user->kode_prodi) {
            abort(403, 'Akses ditolak');
        }
        
        $request->validate([
            'kode_bk' => 'required|string|max:10',
            'nama_bk' => 'required|string|max:50',
            'deskripsi_bk' => 'nullable|string',
            'referensi_bk' => 'required|string|max:50',
            'status_bk' => 'required|in:core,elective',
            'knowledge_area' => 'required|string',
        ]);

        $bk = BahanKajian::create($request->all());

        foreach ($request->id_cpls as $id_cpl) {
            DB::table('cpl_bk')->insert([
                'id_bk' => $bk->id_bk,
                'id_cpl' => $id_cpl
            ]);
        }
        return redirect()->route('tim.bahankajian.index')->with('success', 'Bahan Kajian berhasil ditambahkan.');
    }
}
