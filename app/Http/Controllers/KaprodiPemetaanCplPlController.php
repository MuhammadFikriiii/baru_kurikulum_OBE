<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ProfilLulusan;
use App\Models\CapaianProfilLulusan;

class KaprodiPemetaanCplPlController extends Controller
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

        $prodiByCpl = DB::table('cpl_pl')
            ->join('profil_lulusans', 'cpl_pl.id_pl', '=', 'profil_lulusans.id_pl')
            ->join('prodis', 'profil_lulusans.kode_prodi', '=', 'prodis.kode_prodi')
            ->select('cpl_pl.id_cpl', 'prodis.nama_prodi')
            ->get()
            ->groupBy('id_cpl')
            ->map(function ($items) {
                return $items->first()->nama_prodi ?? '-';
            });

        $relasi = DB::table('cpl_pl')->get()->groupBy('id_pl');

        return view('kaprodi.pemetaancplpl.index', compact('cpls', 'pls', 'relasi', 'prodiByCpl'));
    }
}
