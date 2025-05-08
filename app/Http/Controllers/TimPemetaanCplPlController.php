<?php

namespace App\Http\Controllers;
use App\Models\CapaianProfilLulusan;
use App\Models\ProfilLulusan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TimPemetaanCplPlController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user || !$user->kode_prodi) {
            abort(404);
        }
        $kodeProdi = $user->kode_prodi;

        $pls = ProfilLulusan::where('kode_prodi', $kodeProdi)->get();
        $cpls = CapaianProfilLulusan::whereIn('id_cpl', function ($query) use ($kodeProdi) {
            $query->select('id_cpl')
                  ->from('cpl_pl')
                  ->join('profil_lulusans', 'cpl_pl.id_pl', '=', 'profil_lulusans.id_pl')
                  ->where('profil_lulusans.kode_prodi', $kodeProdi);
        })
        ->orderBy('kode_cpl', 'asc')
        ->get();

        $relasi = DB::table('cpl_pl')->get()->groupBy('id_pl');

        return view('tim.pemetaancplpl.index', compact('cpls', 'pls', 'relasi'));
    }
}
