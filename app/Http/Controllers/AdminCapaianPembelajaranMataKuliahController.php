<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CapaianPembelajaranMataKuliah;
use Illuminate\Support\Facades\DB;

class AdminCapaianPembelajaranMataKuliahController extends Controller
{
    public function index(Request $request)
    {
        $prodis = DB::table('prodis')->get();
        $kode_prodi = $request->get('kode_prodi');

        if (empty($kode_prodi)) {
            return view('admin.capaianpembelajaranmatakuliah.index', [
                'kode_prodi' => '',
                'prodis' => $prodis,
                'prodi' => null,
                'cpmks' => [],
            ]);
        }

        $prodi = $prodis->where('kode_prodi', $kode_prodi)->first();

        $cpmks = DB::table('capaian_pembelajaran_mata_kuliahs as cpmk')
            ->select(
                'cpmk.kode_cpmk',
                'cpmk.deskripsi_cpmk'
            )
            ->leftJoin('cpl_cpmk', 'cpmk.id_cpmk', '=', 'cpl_cpmk.id_cpmk')
            ->leftJoin('capaian_profil_lulusans as cpl', 'cpl_cpmk.id_cpl', '=', 'cpl.id_cpl')
            ->leftJoin('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->leftJoin('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->leftJoin('prodis', 'pl.kode_prodi', '=', 'prodis.kode_prodi')
            ->select('cpmk.id_cpmk', 'cpmk.kode_cpmk', 'cpmk.deskripsi_cpmk', 'prodis.nama_prodi')
            ->groupBy('cpmk.id_cpmk', 'cpmk.kode_cpmk', 'cpmk.deskripsi_cpmk', 'prodis.nama_prodi')
            ->where('prodis.kode_prodi', $kode_prodi)
            ->orderBy('cpmk.kode_cpmk', 'asc')
            ->get();
        return view('admin.capaianpembelajaranmatakuliah.index', compact('cpmks', 'prodis', 'kode_prodi', 'prodi'));
    }

    public function getCplByMk(Request $request)
    {
        $kode_mks = $request->kode_mks ?? [];

        $cpls = DB::table('cpl_mk')
            ->join('capaian_profil_lulusans as cpl', 'cpl_mk.id_cpl', '=', 'cpl.id_cpl')
            ->whereIn('cpl_mk.kode_mk', $kode_mks)
            ->select('cpl.id_cpl', 'cpl.kode_cpl', 'cpl.deskripsi_cpl')
            ->distinct()
            ->orderBy('cpl.kode_cpl')
            ->get();

        return response()->json($cpls);
    }

    public function create()
    {
        $capaianProfilLulusans = DB::table('capaian_profil_lulusans')->get();
        $mataKuliahs = DB::table('mata_kuliahs')->get();
        return view('admin.capaianpembelajaranmatakuliah.create', compact('capaianProfilLulusans', 'mataKuliahs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_cpmk' => 'required|string|max:10',
            'deskripsi_cpmk' => 'required|string|max:255',
            'kode_mks' => 'required|array',
        ]);

        $cpmk = CapaianPembelajaranMataKuliah::create($request->only(['kode_cpmk', 'deskripsi_cpmk']));

        $cpls = DB::table('cpl_mk')
            ->whereIn('kode_mk', $request->kode_mks)
            ->select('id_cpl')
            ->distinct()
            ->pluck('id_cpl');

        foreach ($cpls as $id_cpl) {
            DB::table('cpl_cpmk')->insert([
                'id_cpmk' => $cpmk->id_cpmk,
                'id_cpl' => $id_cpl,
            ]);
        }

        foreach ($request->kode_mks as $kode_mk) {
            DB::table('cpmk_mk')->insert([
                'id_cpmk' => $cpmk->id_cpmk,
                'kode_mk' => $kode_mk,
            ]);
        }
        return redirect()->route('admin.capaianpembelajaranmatakuliah.index')->with('success', 'Capaian Pembelajaran Mata Kuliah berhasil ditambahkan.');
    }

    public function edit($id_cpmk)
    {
        $cpmks = CapaianPembelajaranMataKuliah::findOrFail($id_cpmk);
        $capaianprofillulusans = DB::table('capaian_profil_lulusans')->get();
        $mataKuliahs = DB::table('mata_kuliahs')->get();

        $selectedCpls = DB::table('cpl_cpmk')
            ->join('capaian_profil_lulusans as cpl', 'cpl_cpmk.id_cpl', '=', 'cpl.id_cpl')
            ->where('cpl_cpmk.id_cpmk', $cpmks->id_cpmk)
            ->orderBy('cpl.kode_cpl')
            ->get();

        $selectedMKs = DB::table('cpmk_mk')
            ->where('id_cpmk', $id_cpmk)
            ->pluck('kode_mk')
            ->toArray();

        return view('admin.capaianpembelajaranmatakuliah.edit', compact('cpmks', 'capaianprofillulusans', 'mataKuliahs', 'selectedCpls', 'selectedMKs'));
    }

    public function update(Request $request, $id_cpmk)
    {
        request()->validate([
            'kode_cpmk' => 'required|string|max:10',
            'deskripsi_cpmk' => 'required',
        ]);

        $cpmk = CapaianPembelajaranMataKuliah::findOrFail($id_cpmk);

        $cpmk->update($request->only(['kode_cpmk', 'deskripsi_cpmk']));

        DB::table('cpl_cpmk')->where('id_cpmk', $cpmk->id_cpmk)->delete();
        DB::table('cpmk_mk')->where('id_cpmk', $cpmk->id_cpmk)->delete();

        $cpls = DB::table('cpl_mk')
            ->whereIn('kode_mk', $request->kode_mks)
            ->select('id_cpl')
            ->distinct()
            ->pluck('id_cpl');

        foreach ($cpls as $id_cpl) {
            DB::table('cpl_cpmk')->insert([
                'id_cpmk' => $cpmk->id_cpmk,
                'id_cpl' => $id_cpl,
            ]);
        }

        foreach ($request->kode_mks as $kode_mk) {
            DB::table('cpmk_mk')->insert([
                'id_cpmk' => $cpmk->id_cpmk,
                'kode_mk' => $kode_mk,
            ]);
        }
        return redirect()->route('admin.capaianpembelajaranmatakuliah.index')->with('success', 'CPMK berhasil diperbarui.');
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

        return view('admin.capaianpembelajaranmatakuliah.detail', compact('cpls', 'mks', 'cpmk'));
    }

    public function destroy($id_cpmk)
    {
        $cpmk = CapaianPembelajaranMataKuliah::findOrFail($id_cpmk);
        $cpmk->delete();

        DB::table('cpl_cpmk')->where('id_cpmk', $id_cpmk)->delete();
        DB::table('cpmk_mk')->where('id_cpmk', $id_cpmk)->delete();

        return redirect()->route('admin.capaianpembelajaranmatakuliah.index')->with('success', 'Capaian Pembelajaran Mata Kuliah berhasil dihapus.');
    }
}
