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
        $user = Auth::user();

        if (!$user || !$user->kode_prodi) {
            abort(403);
        }

        $kodeProdi = $user->kode_prodi;
        $id_tahun = request()->get('id_tahun');
        $tahun_tersedia = \App\Models\Tahun::orderBy('tahun', 'desc')->get();
        $prodi = DB::table('prodis')->where('kode_prodi', $kodeProdi)->first();

        // Query untuk BK dengan filter tahun
        $query = BahanKajian::whereIn('id_bk', function ($query) use ($kodeProdi, $id_tahun) {
            $query->select('cpl_bk.id_bk')
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

        // Query untuk MK dengan filter tahun
        $query = MataKuliah::whereIn('kode_mk', function ($query) use ($kodeProdi, $id_tahun) {
            $query->select('bk_mk.kode_mk')
                ->from('bk_mk')
                ->join('cpl_bk', 'bk_mk.id_bk', '=', 'cpl_bk.id_bk')
                ->join('capaian_profil_lulusans', 'cpl_bk.id_cpl', '=', 'capaian_profil_lulusans.id_cpl')
                ->join('cpl_pl', 'capaian_profil_lulusans.id_cpl', '=', 'cpl_pl.id_cpl')
                ->join('profil_lulusans', 'cpl_pl.id_pl', '=', 'profil_lulusans.id_pl')
                ->where('profil_lulusans.kode_prodi', $kodeProdi);

            if ($id_tahun) {
                $query->where('profil_lulusans.id_tahun', $id_tahun);
            }
        });
        $mks = $query->orderBy('kode_mk', 'asc')->get();

        // Query untuk relasi dengan filter tahun
        $query = DB::table('bk_mk')
            ->join('cpl_bk', 'bk_mk.id_bk', '=', 'cpl_bk.id_bk')
            ->join('capaian_profil_lulusans', 'cpl_bk.id_cpl', '=', 'capaian_profil_lulusans.id_cpl')
            ->join('cpl_pl', 'capaian_profil_lulusans.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans', 'cpl_pl.id_pl', '=', 'profil_lulusans.id_pl')
            ->where('profil_lulusans.kode_prodi', $kodeProdi)
            ->select('bk_mk.*');

        if ($id_tahun) {
            $query->where('profil_lulusans.id_tahun', $id_tahun);
        }

        $relasi = $query->get()->groupBy('id_bk');

        return view('tim.pemetaanbkmk.index', compact('bks', 'mks', 'relasi', 'prodi', 'id_tahun', 'tahun_tersedia'));
    }
}