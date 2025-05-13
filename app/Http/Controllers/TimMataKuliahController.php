<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\MataKuliah;

class TimMataKuliahController extends Controller
{
    public function index()
    {
        $kodeProdi = Auth::user()->kode_prodi;

        $mata_kuliahs = DB::table('mata_kuliahs as mk')
            ->select(
                'mk.kode_mk', 'mk.nama_mk', 'mk.jenis_mk', 'mk.sks_mk',
                'mk.semester_mk', 'mk.kompetensi_mk',
                'prodis.nama_prodi'
            )
            ->leftJoin('cpl_mk', 'mk.kode_mk', '=', 'cpl_mk.kode_mk')
            ->leftJoin('capaian_profil_lulusans as cpl', 'cpl_mk.id_cpl', '=', 'cpl.id_cpl')
            ->leftJoin('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->leftJoin('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->leftJoin('prodis', 'pl.kode_prodi', '=', 'prodis.kode_prodi')
            ->where('prodis.kode_prodi', '=', $kodeProdi)
            ->groupBy('mk.kode_mk', 'mk.nama_mk', 'mk.jenis_mk', 'mk.sks_mk',
                'mk.semester_mk', 'mk.kompetensi_mk', 'prodis.nama_prodi')
            ->get();

        return view('tim.matakuliah.index', compact('mata_kuliahs'));
    }

    public function create()
    {
        $kodeProdi = Auth::user()->kode_prodi;

        $capaianProfilLulusans = DB::table('capaian_profil_lulusans as cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->where('pl.kode_prodi', $kodeProdi)
            ->select('cpl.id_cpl', 'cpl.kode_cpl', 'cpl.deskripsi_cpl')
            ->distinct()
            ->get();
        $bahanKajians = DB::table('bahan_kajians as bk')
            ->select(
                'bk.id_bk', 'bk.nama_bk', 'bk.kode_bk', 'bk.deskripsi_bk',
                'bk.referensi_bk', 'bk.status_bk', 'bk.knowledge_area'
            )
            ->leftJoin('cpl_bk', 'bk.id_bk', '=', 'cpl_bk.id_bk')
            ->leftJoin('capaian_profil_lulusans as cpl', 'cpl_bk.id_cpl', '=', 'cpl.id_cpl')
            ->leftJoin('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->leftJoin('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->leftJoin('prodis', 'pl.kode_prodi', '=', 'prodis.kode_prodi')
            ->where('prodis.kode_prodi', '=', $kodeProdi)
            ->groupBy('bk.id_bk', 'bk.nama_bk', 'bk.kode_bk', 'bk.deskripsi_bk',
                'bk.referensi_bk', 'bk.status_bk', 'bk.knowledge_area')
            ->get();

        return view('tim.matakuliah.create', compact('capaianProfilLulusans', 'bahanKajians'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_mk'=> 'required|string|max:10|unique:mata_kuliahs,kode_mk',
            'nama_mk'=> 'required|string|max:50',
            'jenis_mk'=> 'required|string|max:50',
            'sks_mk'=> 'required|integer',
            'semester_mk'=> 'required|integer|in:1,2,3,4,5,6,7,8',
            'kompetensi_mk'=> 'required|string|in:pendukung,utama',
        ]);
        $mk = MataKuliah::create($request->only(['kode_mk', 'nama_mk', 'jenis_mk', 'sks_mk', 'semester_mk', 'kompetensi_mk']));

        foreach ($request->id_cpls as $id_cpl) {
            DB::table('cpl_mk')->insert([
                'kode_mk' => $mk->kode_mk,
                'id_cpl' => $id_cpl
            ]);
        }

        foreach ($request->id_bks as $id_bk) {
            DB::table('bk_mk')->insert([
                'kode_mk' => $mk->kode_mk,
                'id_bk' => $id_bk
            ]);
        }
        return redirect()->route('tim.matakuliah.index')->with('success', 'Mata kuliah berhasil ditambahkan!');
    }

    public function edit(MataKuliah $matakuliah)
    {
        $kodeProdi = Auth::user()->kode_prodi;

        $matakuliah = DB::table('mata_kuliahs as mk')
            ->leftJoin('cpl_mk', 'mk.kode_mk', '=', 'cpl_mk.kode_mk')
            ->leftJoin('capaian_profil_lulusans as cpl', 'cpl_mk.id_cpl', '=', 'cpl.id_cpl')
            ->leftJoin('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->leftJoin('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->leftJoin('prodis', 'pl.kode_prodi', '=', 'prodis.kode_prodi')
            ->where('mk.kode_mk', $matakuliah->kode_mk)
            ->where('prodis.kode_prodi', '=', $kodeProdi)
            ->first();
            if(!$matakuliah) {
                abort(403, 'akses ditolak');
            }

        $capaianprofillulusans = DB::table('capaian_profil_lulusans as cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->where('pl.kode_prodi', $kodeProdi)
            ->select('cpl.id_cpl', 'cpl.kode_cpl', 'cpl.deskripsi_cpl')
            ->distinct()
            ->get();
        $bahankajians = DB::table('bahan_kajians as bk')
            ->select(
                'bk.id_bk', 'bk.nama_bk', 'bk.kode_bk', 'bk.deskripsi_bk',
                'bk.referensi_bk', 'bk.status_bk', 'bk.knowledge_area'
            )
            ->leftJoin('cpl_bk', 'bk.id_bk', '=', 'cpl_bk.id_bk')
            ->leftJoin('capaian_profil_lulusans as cpl', 'cpl_bk.id_cpl', '=', 'cpl.id_cpl')
            ->leftJoin('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->leftJoin('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->leftJoin('prodis', 'pl.kode_prodi', '=', 'prodis.kode_prodi')
            ->where('prodis.kode_prodi', '=', $kodeProdi)
            ->groupBy('bk.id_bk', 'bk.nama_bk', 'bk.kode_bk', 'bk.deskripsi_bk',
                'bk.referensi_bk', 'bk.status_bk', 'bk.knowledge_area')
            ->get();

            $selectedCapaianProfilLulusan = DB::table('cpl_mk')
            ->where('kode_mk', $matakuliah->kode_mk)
            ->pluck('id_cpl')
            ->toArray();

            $selectedBahanKajian = DB::table('bk_mk')
            ->where('kode_mk', $matakuliah->kode_mk)
            ->pluck('id_bk')
            ->toArray();

        return view("tim.matakuliah.edit", compact('matakuliah','capaianprofillulusans', 'bahankajians','selectedCapaianProfilLulusan', 'selectedBahanKajian'));
    }

    public function update(Request $request, MataKuliah $matakuliah)
    {
        $request->validate([
            'kode_mk'=> 'required|string|max:10',
            'nama_mk'=> 'required|string|max:50',
            'jenis_mk'=> 'required|string|max:50',
            'sks_mk'=> 'required|integer',
            'semester_mk'=> 'required|integer|in:1,2,3,4,5,6,7,8',
            'kompetensi_mk'=> 'required|string|in:pendukung,utama',
        ]);

        $matakuliah->update($request->only(['kode_mk', 'nama_mk', 'jenis_mk', 'sks_mk', 'semester_mk', 'kompetensi_mk']));

        DB::table('cpl_mk')->where('kode_mk', $matakuliah->kode_mk)->delete();
        foreach ($request->id_cpls as $id_cpl) {
            DB::table('cpl_mk')->insert([
                'kode_mk' => $matakuliah->kode_mk,
                'id_cpl' => $id_cpl
            ]);
        }

        DB::table('bk_mk')->where('kode_mk', $matakuliah->kode_mk)->delete();
        foreach ($request->id_bks as $id_bk) {
            DB::table('bk_mk')->insert([
                'kode_mk' => $matakuliah->kode_mk,
                'id_bk' => $id_bk
            ]);
        }

        return redirect()->route('tim.matakuliah.index')->with('success', 'Mata kuliah berhasil diperbarui!');
    }
}
