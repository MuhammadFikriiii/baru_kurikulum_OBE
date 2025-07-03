<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\CapaianPembelajaranMataKuliah;
use Illuminate\Http\Request;

class Wadir1CapaianPembelajaranMataKuliahController extends Controller
{
    public function index(Request $request)
    {
        $prodis = DB::table('prodis')->get();
        $kode_prodi = $request->get('kode_prodi');
        $id_tahun = $request->get('id_tahun');

        $tahun_tersedia = DB::table('tahun')
            ->select('id_tahun', 'nama_kurikulum', 'tahun')
            ->orderBy('tahun', 'desc')
            ->get();

        // Jika prodi belum dipilih, tampilkan view kosong
        if (empty($kode_prodi)) {
            return view('wadir1.capaianpembelajaranmatakuliah.index', [
                'kode_prodi' => '',
                'prodis' => $prodis,
                'prodi' => null,
                'cpmks' => [],
                'id_tahun' => $id_tahun,
                'tahun_tersedia' => $tahun_tersedia,
            ]);
        }

        $prodi = $prodis->where('kode_prodi', $kode_prodi)->first();

        // Gunakan query builder agar filter tahun bisa diterapkan
        $query = DB::table('capaian_pembelajaran_mata_kuliahs as cpmk')
            ->select(
                'cpmk.id_cpmk',
                'cpmk.kode_cpmk',
                'cpmk.deskripsi_cpmk',
                'prodis.nama_prodi'
            )
            ->leftJoin('cpl_cpmk', 'cpmk.id_cpmk', '=', 'cpl_cpmk.id_cpmk')
            ->leftJoin('capaian_profil_lulusans as cpl', 'cpl_cpmk.id_cpl', '=', 'cpl.id_cpl')
            ->leftJoin('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->leftJoin('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->leftJoin('prodis', 'pl.kode_prodi', '=', 'prodis.kode_prodi')
            ->where('prodis.kode_prodi', $kode_prodi)
            ->groupBy('cpmk.id_cpmk', 'cpmk.kode_cpmk', 'cpmk.deskripsi_cpmk', 'prodis.nama_prodi')
            ->orderBy('cpmk.kode_cpmk', 'asc');

        // Filter tahun jika dipilih
        if (!empty($id_tahun)) {
            $query->where('pl.id_tahun', $id_tahun);
        }

        $cpmks = $query->get();

        return view('wadir1.capaianpembelajaranmatakuliah.index', compact(
            'cpmks',
            'prodis',
            'kode_prodi',
            'prodi',
            'id_tahun',
            'tahun_tersedia'
        ));
    }

    public function detail($id_cpmk)
    {
        $cpmk = CapaianPembelajaranMataKuliah::findOrFail($id_cpmk);

        $cpls = DB::table('cpl_cpmk')
            ->join('capaian_profil_lulusans as cpl', 'cpl_cpmk.id_cpl', '=', 'cpl.id_cpl')
            ->where('cpl_cpmk.id_cpmk', $id_cpmk)
            ->select('cpl.id_cpl', 'cpl.kode_cpl', 'cpl.deskripsi_cpl')
            ->get();

        $mks = DB::table('cpmk_mk')
            ->join('mata_kuliahs as mk', 'cpmk_mk.kode_mk', '=', 'mk.kode_mk')
            ->where('cpmk_mk.id_cpmk', $id_cpmk)
            ->select('mk.kode_mk', 'mk.nama_mk')
            ->get();

        return view('wadir1.capaianpembelajaranmatakuliah.detail', compact('cpls', 'mks', 'cpmk'));
    }
}
