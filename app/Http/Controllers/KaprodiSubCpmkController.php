<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\SubCpmk;

class KaprodiSubCpmkController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if (!$user || !$user->kode_prodi) {
            abort(404);
        }

        $kodeProdi = $user->kode_prodi;
        $id_tahun = $request->get('id_tahun');

        $tahun_tersedia = \App\Models\Tahun::orderBy('tahun', 'desc')->get();

        $query = DB::table('sub_cpmks as sc')
            ->join('capaian_pembelajaran_mata_kuliahs as cpmk', 'sc.id_cpmk', '=', 'cpmk.id_cpmk')
            ->join('cpl_cpmk as cplcpmk', 'cpmk.id_cpmk', '=', 'cplcpmk.id_cpmk')
            ->join('capaian_profil_lulusans as cpl', 'cplcpmk.id_cpl', '=', 'cpl.id_cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->select('sc.*', 'cpmk.kode_cpmk', 'cpmk.deskripsi_cpmk', 'cpmk.kode_cpmk')
            ->where('pl.kode_prodi', $kodeProdi)
            ->orderBy('sc.sub_cpmk');

        // Tambahkan filter tahun jika ada
        if ($id_tahun) {
            $query->where('pl.id_tahun', $id_tahun);
        }

        $subcpmks = $query->get();

        return view('kaprodi.subcpmk.index', compact('subcpmks', 'id_tahun', 'tahun_tersedia'));
    }

    public function detail($id)
    {
        $kodeProdi = Auth::user()->kode_prodi;

        $subcpmk = DB::table('sub_cpmks as sc')
            ->join('capaian_pembelajaran_mata_kuliahs as cpmk', 'sc.id_cpmk', '=', 'cpmk.id_cpmk')
            ->join('cpl_cpmk as cplcpmk', 'cpmk.id_cpmk', '=', 'cplcpmk.id_cpmk')
            ->join('capaian_profil_lulusans as cpl', 'cplcpmk.id_cpl', '=', 'cpl.id_cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->where('pl.kode_prodi', $kodeProdi)
            ->where('sc.id_sub_cpmk', $id)
            ->select(
                'sc.id_sub_cpmk',
                'sc.sub_cpmk',
                'sc.uraian_cpmk',
                'cpmk.kode_cpmk',
                'cpmk.deskripsi_cpmk'
            )
            ->first();

        if (!$subcpmk) {
            abort(403, 'Akses ditolak atau data tidak ditemukan');
        }

        return view('kaprodi.subcpmk.detail', compact('subcpmk'));
    }

    public function pemetaanmkcpmksubcpmk(Request $request)
    {
        $user = Auth::user();

        if (!$user || !$user->kode_prodi) {
            abort(404);
        }

        $kodeProdi = $user->kode_prodi;
        $id_tahun = $request->get('id_tahun');

        $tahun_tersedia = \App\Models\Tahun::orderBy('tahun', 'desc')->get();

        $query = DB::table('sub_cpmks as sub')
            ->join('capaian_pembelajaran_mata_kuliahs as cpmk', 'sub.id_cpmk', '=', 'cpmk.id_cpmk')
            ->join('cpl_cpmk', 'cpmk.id_cpmk', '=', 'cpl_cpmk.id_cpmk')
            ->join('capaian_profil_lulusans as cpl', 'cpl_cpmk.id_cpl', '=', 'cpl.id_cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->join('prodis', 'pl.kode_prodi', '=', 'prodis.kode_prodi')
            ->join('mata_kuliahs as mk', 'sub.kode_mk', '=', 'mk.kode_mk') // <-- ambil dari sub_cpmk langsung
            ->where('prodis.kode_prodi', $kodeProdi)
            ->select(
                'mk.kode_mk',
                'mk.nama_mk',
                'cpmk.kode_cpmk',
                'cpmk.deskripsi_cpmk',
                'sub.id_sub_cpmk',
                'sub.sub_cpmk',
                'sub.uraian_cpmk',
            )
            ->orderBy('mk.kode_mk')
            ->orderBy('cpmk.kode_cpmk')
            ->distinct();

        // Tambahkan filter tahun jika ada
        if ($id_tahun) {
            $query->where('pl.id_tahun', $id_tahun);
        }

        $data = $query->get();

        return view('kaprodi.pemetaanmkcpmksubcpmk.index', compact('data', 'id_tahun', 'tahun_tersedia'));
    }
}
