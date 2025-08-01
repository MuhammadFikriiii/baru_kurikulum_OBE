<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CapaianProfilLulusan;
use App\Models\BahanKajian;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TimPemetaanCplBkController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user || !$user->kode_prodi) {
            abort(403);
        }

        $kodeProdi = $user->kode_prodi;
        $id_tahun = request()->get('id_tahun');
        $tahun_tersedia = \App\Models\Tahun::orderBy('tahun', 'desc')->get();

        $prodi = DB::table('prodis')->where('kode_prodi', $kodeProdi)->first();

        // Query untuk CPL
        $query = CapaianProfilLulusan::whereIn('id_cpl', function ($query) use ($kodeProdi, $id_tahun) {
            $query->select('id_cpl')
                ->from('cpl_pl')
                ->join('profil_lulusans', 'cpl_pl.id_pl', '=', 'profil_lulusans.id_pl')
                ->where('profil_lulusans.kode_prodi', $kodeProdi);

            if ($id_tahun) {
                $query->where('profil_lulusans.id_tahun', $id_tahun);
            }
        });
        $cpls = $query->orderBy('kode_cpl', 'asc')->get();

        // Query untuk BK
        $query = BahanKajian::whereIn('id_bk', function ($query) use ($kodeProdi, $id_tahun) {
            $query->select('id_bk')
                ->from('cpl_bk')
                ->join('capaian_profil_lulusans', 'cpl_bk.id_cpl', '=', 'capaian_profil_lulusans.id_cpl')
                ->join('cpl_pl', 'capaian_profil_lulusans.id_cpl', '=', 'cpl_pl.id_cpl')
                ->join('profil_lulusans', 'cpl_pl.id_pl', '=', 'profil_lulusans.id_pl')
                ->where('profil_lulusans.kode_prodi', $kodeProdi);

            if ($id_tahun) {
                $query->where('profil_lulusans.id_tahun', $id_tahun);
            }
        });
        $bks = $query->orderBy('kode_bk', 'asc')->get();

        // Query untuk prodi by CPL
        $query = DB::table('cpl_pl')
            ->join('profil_lulusans', 'cpl_pl.id_pl', '=', 'profil_lulusans.id_pl')
            ->join('prodis', 'profil_lulusans.kode_prodi', '=', 'prodis.kode_prodi')
            ->where('profil_lulusans.kode_prodi', $kodeProdi)
            ->select('cpl_pl.id_cpl', 'prodis.nama_prodi');

        if ($id_tahun) {
            $query->where('profil_lulusans.id_tahun', $id_tahun);
        }

        $prodiByCpl = $query->get()
            ->groupBy('id_cpl')
            ->map(function ($items) {
                return $items->first()->nama_prodi ?? '-';
            });

        // Query untuk relasi
        $query = DB::table('cpl_bk')
            ->join('capaian_profil_lulusans', 'cpl_bk.id_cpl', '=', 'capaian_profil_lulusans.id_cpl')
            ->join('cpl_pl', 'capaian_profil_lulusans.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans', 'cpl_pl.id_pl', '=', 'profil_lulusans.id_pl')
            ->where('profil_lulusans.kode_prodi', $kodeProdi)
            ->select('cpl_bk.*');

        if ($id_tahun) {
            $query->where('profil_lulusans.id_tahun', $id_tahun);
        }

        $relasi = $query->get()->groupBy('id_bk');

        return view('tim.pemetaancplbk.index', compact('cpls', 'bks', 'relasi', 'prodi', 'prodiByCpl', 'id_tahun', 'tahun_tersedia'));
    }
}
