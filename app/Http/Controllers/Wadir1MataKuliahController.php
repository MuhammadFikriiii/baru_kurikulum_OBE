<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\MataKuliah;
use App\Models\CapaianProfilLulusan;
use App\Models\BahanKajian;

class Wadir1MataKuliahController extends Controller
{
    public function index(Request $request)
    {
        $kode_prodi = $request->get('kode_prodi');
        $id_tahun = $request->get('id_tahun');
        $prodis = DB::table('prodis')->get();

        if (!$kode_prodi) {
            $tahun_tersedia = \App\Models\Tahun::orderBy('tahun', 'desc')->get();
            return view("wadir1.matakuliah.index", compact("prodis", "kode_prodi", "id_tahun", "tahun_tersedia"));
        }

        $query = DB::table('mata_kuliahs as mk')
            ->select(
                'mk.kode_mk',
                'mk.nama_mk',
                'mk.jenis_mk',
                'mk.sks_mk',
                'mk.semester_mk',
                'mk.kompetensi_mk',
                'prodis.nama_prodi',
                'tahun.tahun',
            )
            ->leftJoin('cpl_mk', 'mk.kode_mk', '=', 'cpl_mk.kode_mk')
            ->leftJoin('capaian_profil_lulusans as cpl', 'cpl_mk.id_cpl', '=', 'cpl.id_cpl')
            ->leftJoin('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->leftJoin('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->join('tahun', 'pl.id_tahun', '=', 'tahun.id_tahun')
            ->leftJoin('prodis', 'pl.kode_prodi', '=', 'prodis.kode_prodi')
            ->groupBy('mk.kode_mk', 'mk.nama_mk', 'mk.jenis_mk', 'mk.sks_mk', 'mk.semester_mk', 'mk.kompetensi_mk', 'prodis.nama_prodi', 'tahun.tahun');

        if ($kode_prodi) {
            $query->where('prodis.kode_prodi', $kode_prodi);
        }

        if ($id_tahun) {
            $query->where('pl.id_tahun', $id_tahun);
        }

        $mata_kuliahs = $query->get();

        $tahun_tersedia = \App\Models\Tahun::orderBy('tahun', 'desc')->get();

        $dataKosong = $mata_kuliahs->isEmpty() && $kode_prodi;

        return view("wadir1.matakuliah.index", compact("mata_kuliahs", 'kode_prodi', 'prodis', 'id_tahun', 'tahun_tersedia', 'dataKosong'));
    }
    public function detail(MataKuliah $matakuliah)
    {
        $selectedCplIds = DB::table('cpl_mk')
            ->where('kode_mk', $matakuliah->kode_mk)
            ->pluck('id_cpl')
            ->toArray();

        $capaianprofillulusans = CapaianProfilLulusan::whereIn('id_cpl', $selectedCplIds)->get();

        $selectedBksIds = DB::table('bk_mk')
            ->where('kode_mk', $matakuliah->kode_mk)
            ->pluck('id_bk')
            ->toArray();
        $bahanKajians = BahanKajian::whereIn('id_bk', $selectedBksIds)->get();

        return view('wadir1.matakuliah.detail', ['matakuliah' => $matakuliah, 'selectedCplIds' => $selectedCplIds, 'selectedBksIds' => $selectedBksIds, 'capaianprofillulusans' => $capaianprofillulusans,  'bahanKajians' => $bahanKajians]);
    }

    public function organisasi_mk(Request $request)
    {
        $prodis = DB::table('prodis')->get();

        $kode_prodi = $request->input('kode_prodi', 'all');

        $query = DB::table('mata_kuliahs as mk')
            ->select(
                'mk.kode_mk',
                'mk.nama_mk',
                'mk.jenis_mk',
                'mk.sks_mk',
                'mk.semester_mk',
                'mk.kompetensi_mk',
                'prodis.nama_prodi',
                'prodis.kode_prodi'
            )
            ->leftJoin('cpl_mk', 'mk.kode_mk', '=', 'cpl_mk.kode_mk')
            ->leftJoin('capaian_profil_lulusans as cpl', 'cpl_mk.id_cpl', '=', 'cpl.id_cpl')
            ->leftJoin('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->leftJoin('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->leftJoin('prodis', 'pl.kode_prodi', '=', 'prodis.kode_prodi')
            ->groupBy(
                'mk.kode_mk',
                'mk.nama_mk',
                'mk.jenis_mk',
                'mk.sks_mk',
                'mk.semester_mk',
                'mk.kompetensi_mk',
                'prodis.nama_prodi',
                'prodis.kode_prodi'
            );

        if ($kode_prodi != 'all') {
            $query->where('prodis.kode_prodi', $kode_prodi);
        }

        $matakuliah = $query->get();

        $organisasiMK = $matakuliah->groupBy('semester_mk')->map(function ($items, $semester_mk) {
            return [
                'semester_mk' => $semester_mk,
                'sks_mk' => $items->sum('sks_mk'),
                'jumlah_mk' => $items->count(),
                'nama_mk' => $items->pluck('nama_mk')->toArray(),
                'mata_kuliah' => $items,
            ];
        });

        return view('wadir1.matakuliah.organisasimk', compact('organisasiMK', 'prodis', 'kode_prodi'));
    }
}
