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
        $prodis = DB::table('prodis')->get();

        $query = DB::table('mata_kuliahs as mk')
            ->select(
                'mk.kode_mk', 'mk.nama_mk', 'mk.jenis_mk', 'mk.sks_mk',
                'mk.semester_mk', 'mk.kompetensi_mk', 'prodis.nama_prodi'
            )
            ->leftJoin('cpl_mk', 'mk.kode_mk', '=', 'cpl_mk.kode_mk')
            ->leftJoin('capaian_profil_lulusans as cpl', 'cpl_mk.id_cpl', '=', 'cpl.id_cpl')
            ->leftJoin('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->leftJoin('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->leftJoin('prodis', 'pl.kode_prodi', '=', 'prodis.kode_prodi')
            ->groupBy('mk.kode_mk', 'mk.nama_mk', 'mk.jenis_mk', 'mk.sks_mk', 'mk.semester_mk', 'mk.kompetensi_mk', 'prodis.nama_prodi');

            if ($kode_prodi && $kode_prodi !== 'all') {
                $query->where('prodis.kode_prodi', $kode_prodi);
                $mata_kuliahs = $query->get();
            }
            $mata_kuliahs = $query->get();

        return view("wadir1.matakuliah.index", compact("mata_kuliahs", 'kode_prodi', 'prodis'));
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

        return view('wadir1.matakuliah.detail',['matakuliah'=>$matakuliah, 'selectedCplIds' =>$selectedCplIds, 'selectedBksIds'=>$selectedBksIds, 'capaianprofillulusans'=>$capaianprofillulusans,  'bahanKajians'=>$bahanKajians]);
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
