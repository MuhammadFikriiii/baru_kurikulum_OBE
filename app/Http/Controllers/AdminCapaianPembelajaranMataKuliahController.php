<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CapaianPembelajaranMataKuliah;
use Illuminate\Support\Facades\DB;

class AdminCapaianPembelajaranMataKuliahController extends Controller
{
    public function index(Request $request)
    {
        $kode_prodi = $request->get('kode_prodi');
        $id_tahun = $request->get('id_tahun');
        $prodis = DB::table('prodis')->get();

        // Ambil tahun-tahun yang tersedia dari tabel tahun
        $tahun_tersedia = \App\Models\Tahun::orderBy('tahun', 'desc')->get();

        if (!$kode_prodi) {
            // Jika tidak ada prodi dipilih, kirim data kosong untuk cpmks
            $cpmks = collect(); // Collection kosong
            return view("admin.capaianpembelajaranmatakuliah.index", compact("prodis", "kode_prodi", "id_tahun", "tahun_tersedia", "cpmks"));
        }

        $query = DB::table('capaian_pembelajaran_mata_kuliahs as cpmk')
            ->leftJoin('cpl_cpmk', 'cpmk.id_cpmk', '=', 'cpl_cpmk.id_cpmk')
            ->leftJoin('capaian_profil_lulusans as cpl', 'cpl_cpmk.id_cpl', '=', 'cpl.id_cpl')
            ->leftJoin('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->leftJoin('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->leftJoin('prodis', 'pl.kode_prodi', '=', 'prodis.kode_prodi')
            ->select('cpmk.id_cpmk', 'cpmk.kode_cpmk', 'cpmk.deskripsi_cpmk', 'prodis.nama_prodi')
            ->groupBy('cpmk.id_cpmk', 'cpmk.kode_cpmk', 'cpmk.deskripsi_cpmk', 'prodis.nama_prodi')
            ->orderBy('cpmk.kode_cpmk', 'asc');

        if ($kode_prodi) {
            $query->where('prodis.kode_prodi', $kode_prodi);
        }

        // Filter berdasarkan tahun jika ada
        if ($id_tahun) {
            $query->where('pl.id_tahun', $id_tahun);
        }

        $cpmks = $query->get();

        $dataKosong = $cpmks->isEmpty() && $kode_prodi;

        return view("admin.capaianpembelajaranmatakuliah.index", compact("cpmks", "prodis", "kode_prodi", "id_tahun", "tahun_tersedia", "dataKosong"));
    }

    public function getMkByCpl(Request $request)
    {
        $id_cpls = $request->id_cpls ?? [];

        $mks = DB::table('cpl_mk')
            ->join('mata_kuliahs as mk', 'cpl_mk.kode_mk', '=', 'mk.kode_mk')
            ->whereIn('cpl_mk.id_cpl', $id_cpls)
            ->select('mk.kode_mk', 'mk.nama_mk')
            ->distinct()
            ->orderBy('mk.kode_mk')
            ->get();

        return response()->json($mks);
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
            'id_cpls' => 'required|array',
            'selected_mks' => 'required|array', // Validasi MK yang dipilih
        ]);

        $cpmk = CapaianPembelajaranMataKuliah::create($request->only(['kode_cpmk', 'deskripsi_cpmk']));

        // Insert ke tabel cpl_cpmk berdasarkan CPL yang dipilih
        foreach ($request->id_cpls as $id_cpl) {
            DB::table('cpl_cpmk')->insert([
                'id_cpmk' => $cpmk->id_cpmk,
                'id_cpl' => $id_cpl,
            ]);
        }

        // Insert ke tabel cpmk_mk berdasarkan MK yang dipilih user
        foreach ($request->selected_mks as $kode_mk) {
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
        $capaianProfilLulusans = DB::table('capaian_profil_lulusans')->get();
        $mataKuliahs = DB::table('mata_kuliahs')->get();

        // Ambil CPL yang terkait dengan CPMK ini
        $selectedCpls = DB::table('cpl_cpmk')
            ->join('capaian_profil_lulusans as cpl', 'cpl_cpmk.id_cpl', '=', 'cpl.id_cpl')
            ->where('cpl_cpmk.id_cpmk', $cpmks->id_cpmk)
            ->select('cpl.id_cpl', 'cpl.kode_cpl', 'cpl.deskripsi_cpl')
            ->orderBy('cpl.kode_cpl')
            ->get();

        // Ambil ID CPL yang dipilih untuk keperluan JavaScript
        $selectedCplIds = $selectedCpls->pluck('id_cpl')->toArray();

        // Ambil SEMUA MK yang terkait dengan CPL yang dipilih (bukan hanya yang sudah dipilih untuk CPMK)
        $availableMKs = collect();
        if (!empty($selectedCplIds)) {
            $availableMKs = DB::table('cpl_mk')
                ->join('mata_kuliahs as mk', 'cpl_mk.kode_mk', '=', 'mk.kode_mk')
                ->whereIn('cpl_mk.id_cpl', $selectedCplIds)
                ->select('mk.kode_mk', 'mk.nama_mk')
                ->distinct()
                ->orderBy('mk.kode_mk')
                ->get();
        }

        // Ambil kode MK yang sudah dipilih untuk CPMK ini (untuk menandai yang sudah ter-check)
        $selectedMKCodes = DB::table('cpmk_mk')
            ->where('id_cpmk', $id_cpmk)
            ->pluck('kode_mk')
            ->toArray();

        return view('admin.capaianpembelajaranmatakuliah.edit', compact(
            'cpmks',
            'capaianProfilLulusans',
            'mataKuliahs',
            'selectedCpls',
            'selectedCplIds',
            'availableMKs',
            'selectedMKCodes'
        ));
    }

    public function update(Request $request, $id_cpmk)
    {
        $request->validate([
            'kode_cpmk' => 'required|string|max:10',
            'deskripsi_cpmk' => 'required|string|max:255',
            'id_cpls' => 'required|array',
            'selected_mks' => 'required|array', // Validasi MK yang dipilih
        ]);

        $cpmk = CapaianPembelajaranMataKuliah::findOrFail($id_cpmk);

        // Update data CPMK
        $cpmk->update($request->only(['kode_cpmk', 'deskripsi_cpmk']));

        // Hapus relasi lama
        DB::table('cpl_cpmk')->where('id_cpmk', $cpmk->id_cpmk)->delete();
        DB::table('cpmk_mk')->where('id_cpmk', $cpmk->id_cpmk)->delete();

        // Insert relasi CPL-CPMK berdasarkan CPL yang dipilih
        foreach ($request->id_cpls as $id_cpl) {
            DB::table('cpl_cpmk')->insert([
                'id_cpmk' => $cpmk->id_cpmk,
                'id_cpl' => $id_cpl,
            ]);
        }

        // Insert relasi CPMK-MK berdasarkan MK yang dipilih user
        foreach ($request->selected_mks as $kode_mk) {
            DB::table('cpmk_mk')->insert([
                'id_cpmk' => $cpmk->id_cpmk,
                'kode_mk' => $kode_mk,
            ]);
        }

        return redirect()->route('admin.capaianpembelajaranmatakuliah.index')
            ->with('success', 'CPMK berhasil diperbarui.');
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
