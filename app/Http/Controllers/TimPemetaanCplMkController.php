<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CapaianProfilLulusan;
use App\Models\MataKuliah;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TimPemetaanCplMkController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user || !$user->kode_prodi) {
            abort(403);
        }
        $kodeProdi = $user->kode_prodi;
        $prodi = DB::table('prodis')->where('kode_prodi', $kodeProdi)->first();
        $cpls = CapaianProfilLulusan::whereIn('id_cpl', function ($query) use ($kodeProdi) {
            $query->select('id_cpl')
                  ->from('cpl_pl')
                  ->join('profil_lulusans', 'cpl_pl.id_pl', '=', 'profil_lulusans.id_pl')
                  ->where('profil_lulusans.kode_prodi', $kodeProdi);
        })
        ->orderBy('kode_cpl', 'asc')
        ->get();
        
        $prodiByCpl = DB::table('cpl_mk')
            ->join('capaian_profil_lulusans', 'cpl_mk.id_cpl', '=', 'capaian_profil_lulusans.id_cpl')
            ->join('cpl_pl', 'capaian_profil_lulusans.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans', 'cpl_pl.id_pl', '=', 'profil_lulusans.id_pl')
            ->join('prodis', 'profil_lulusans.kode_prodi', '=', 'prodis.kode_prodi')
            ->select('cpl_mk.id_cpl', 'prodis.nama_prodi')
            ->get()
            ->groupBy('id_cpl')
            ->map(function ($items) {
                return $items->first()->nama_prodi ?? '-';
            });

        $mks = MataKuliah::whereIn('kode_mk', function ($query) use ($kodeProdi) {
            $query->select('kode_mk')
                ->from('cpl_mk')
                ->join('capaian_profil_lulusans', 'cpl_mk.id_cpl', '=', 'capaian_profil_lulusans.id_cpl')
                ->join('cpl_pl', 'capaian_profil_lulusans.id_cpl', '=', 'cpl_pl.id_cpl')
                ->join('profil_lulusans', 'cpl_pl.id_pl', '=', 'profil_lulusans.id_pl')
                ->where('profil_lulusans.kode_prodi', $kodeProdi);
        })
        ->orderBy('kode_mk', 'asc')
        ->get();        
        
        $relasi = DB::table('cpl_mk')->get()->groupBy('kode_mk');

        return view('tim.pemetaancplmk.index', compact('cpls', 'mks', 'relasi', 'prodi','prodiByCpl'));
    }
}
