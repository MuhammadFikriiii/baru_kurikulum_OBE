<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\BahanKajian;
use App\Models\CapaianProfilLulusan;

class Wadir1BahanKajianController extends Controller
{
    public function index(Request $request)
    {
        $kode_prodi = $request->get('kode_prodi');
        $id_tahun = $request->get('id_tahun');
        $prodis = DB::table('prodis')->get();
        if (!$kode_prodi) {
            $tahun_tersedia = \App\Models\Tahun::orderBy('tahun', 'desc')->get();
            return view("wadir1.bahankajian.index", compact("prodis", "kode_prodi", "id_tahun", "tahun_tersedia"));
        }

        $query = DB::table('bahan_kajians as bk')
            ->select(
                'bk.id_bk',
                'bk.nama_bk',
                'bk.kode_bk',
                'bk.deskripsi_bk',
                'bk.referensi_bk',
                'bk.status_bk',
                'bk.knowledge_area',
                'prodis.nama_prodi',
                'tahun.tahun',
            )
            ->leftJoin('cpl_bk', 'bk.id_bk', '=', 'cpl_bk.id_bk')
            ->leftJoin('capaian_profil_lulusans as cpl', 'cpl_bk.id_cpl', '=', 'cpl.id_cpl')
            ->leftJoin('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->leftJoin('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->leftJoin('tahun', 'pl.id_tahun', '=', 'tahun.id_tahun')
            ->leftJoin('prodis', 'pl.kode_prodi', '=', 'prodis.kode_prodi')
            ->orderBy('bk.kode_bk', 'asc')
            ->groupBy(
                'bk.id_bk',
                'bk.nama_bk',
                'bk.kode_bk',
                'bk.deskripsi_bk',
                'bk.referensi_bk',
                'bk.status_bk',
                'bk.knowledge_area',
                'tahun.tahun',
                'prodis.nama_prodi'
            );

        if ($kode_prodi) {
            $query->where('prodis.kode_prodi', $kode_prodi);
        }

        if ($id_tahun) {
            $query->where('pl.id_tahun', $id_tahun);
        }

        $bahankajians = $query->get();

        $tahun_tersedia = \App\Models\Tahun::orderBy('tahun', 'desc')->get();

        $dataKosong = $bahankajians->isEmpty() && $kode_prodi;

        return view('wadir1.bahankajian.index', compact('bahankajians', 'prodis', 'kode_prodi', 'dataKosong', 'id_tahun', 'tahun_tersedia'));
    }

    public function detail(BahanKajian $id_bk)
    {
        $selectedCplIds = DB::table('cpl_bk')
            ->where('id_bk', $id_bk->id_bk)
            ->pluck('id_cpl')
            ->toArray();

        $capaianprofillulusans = CapaianProfilLulusan::whereIn('id_cpl', $selectedCplIds)->get();

        return view('wadir1.bahankajian.detail', [
            'id_bk' => $id_bk,
            'selectedCapaianProfilLulusans' => $selectedCplIds,
            'capaianprofillulusans' => $capaianprofillulusans
        ]);
    }
}
