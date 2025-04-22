<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BahanKajian;
use App\Models\MataKuliah;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TimPemetaanBkMkController extends Controller
{
    public function index()
    {
        $user = Auth::guard('userprodi')->user();

        if (!$user || !$user->kode_prodi) {
            abort(403);
        }

        $kodeProdi = $user->kode_prodi;
        $prodi = DB::table('prodis')->where('kode_prodi', $kodeProdi)->first();

        $bks = BahanKajian::whereIn('id_bk', function ($query) use ($kodeProdi) {
            $query->select('cpl_bk.id_bk')
                  ->from('cpl_bk')
                  ->join('cpl_pl', 'cpl_bk.id_cpl', '=', 'cpl_pl.id_cpl')
                  ->join('profil_lulusans', 'cpl_pl.id_pl', '=', 'profil_lulusans.id_pl')
                  ->where('profil_lulusans.kode_prodi', $kodeProdi);
        })
        ->orderBy('kode_bk', 'asc')
        ->get();

        $mks = MataKuliah::whereIn('kode_mk', function ($query) use ($kodeProdi) {
            $query->select('bk_mk.kode_mk')
                  ->from('bk_mk')
                  ->join('cpl_bk', 'bk_mk.id_bk', '=', 'cpl_bk.id_bk')
                  ->join('cpl_pl', 'cpl_bk.id_cpl', '=', 'cpl_pl.id_cpl')
                  ->join('profil_lulusans', 'cpl_pl.id_pl', '=', 'profil_lulusans.id_pl')
                  ->where('profil_lulusans.kode_prodi', $kodeProdi);
        })
        ->orderBy('kode_mk', 'asc')
        ->get();

        $relasi = DB::table('bk_mk')->get()->groupBy('id_bk');

        return view('tim.pemetaanbkmk.index', compact('bks', 'mks', 'relasi', 'prodi'));
    }
}
