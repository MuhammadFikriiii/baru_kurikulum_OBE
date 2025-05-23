<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CapaianProfilLulusan;
use App\Models\BahanKajian;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class KaprodiPemetaanCplBkController extends Controller
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

        $bks = BahanKajian::whereIn('id_bk', function ($query) use ($kodeProdi) {
            $query->select('id_bk')
                ->from('cpl_bk')
                ->join('capaian_profil_lulusans', 'cpl_bk.id_cpl', '=', 'capaian_profil_lulusans.id_cpl')
                ->join('cpl_pl', 'capaian_profil_lulusans.id_cpl', '=', 'cpl_pl.id_cpl')
                ->join('profil_lulusans', 'cpl_pl.id_pl', '=', 'profil_lulusans.id_pl')
                ->where('profil_lulusans.kode_prodi', $kodeProdi);
        })
            ->orderBy('kode_bk', 'asc')
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

        $relasi = DB::table('cpl_bk')->get()->groupBy('id_bk');

        return view('kaprodi.pemetaancplbk.index', compact('cpls', 'bks', 'relasi', 'prodi', 'prodiByCpl'));
    }
}
