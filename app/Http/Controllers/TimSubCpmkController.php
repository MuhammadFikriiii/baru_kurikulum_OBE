<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\SubCpmk;

class TimSubCpmkController extends Controller
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

        return view('tim.subcpmk.index', compact('subcpmks', 'id_tahun', 'tahun_tersedia'));
    }

    public function getCpmkByMk(Request $request)
    {
        $kodeMk = $request->kode_mk;
        $kodeProdi = Auth::user()->kode_prodi;

        $cpmks = DB::table('cpmk_mk')
            ->join('capaian_pembelajaran_mata_kuliahs as cpmk', 'cpmk_mk.id_cpmk', '=', 'cpmk.id_cpmk')
            ->join('cpl_cpmk', 'cpmk.id_cpmk', '=', 'cpl_cpmk.id_cpmk')
            ->join('capaian_profil_lulusans as cpl', 'cpl_cpmk.id_cpl', '=', 'cpl.id_cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->where('cpmk_mk.kode_mk', $kodeMk)
            ->where('pl.kode_prodi', $kodeProdi)
            ->select('cpmk.id_cpmk', 'cpmk.kode_cpmk', 'cpmk.deskripsi_cpmk')
            ->distinct()
            ->get();

        return response()->json($cpmks);
    }

    public function create()
    {
        $user = Auth::user();

        // Ambil semua CPMK terkait prodi
        $cpmks = DB::table('capaian_pembelajaran_mata_kuliahs as cpmk')
            ->join('cpmk_mk', 'cpmk.id_cpmk', '=', 'cpmk_mk.id_cpmk')
            ->join('mata_kuliahs as mk', 'cpmk_mk.kode_mk', '=', 'mk.kode_mk')
            ->join('cpl_cpmk', 'cpmk.id_cpmk', '=', 'cpl_cpmk.id_cpmk')
            ->join('capaian_profil_lulusans as cpl', 'cpl_cpmk.id_cpl', '=', 'cpl.id_cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->where('pl.kode_prodi', $user->kode_prodi)
            ->select('cpmk.id_cpmk', 'cpmk.kode_cpmk', 'cpmk.deskripsi_cpmk')
            ->distinct()
            ->get();

        $mks = DB::table('mata_kuliahs as mk')
            ->join('cpmk_mk', 'mk.kode_mk', '=', 'cpmk_mk.kode_mk')
            ->join('capaian_pembelajaran_mata_kuliahs as cpmk', 'cpmk_mk.id_cpmk', '=', 'cpmk.id_cpmk')
            ->join('cpl_cpmk', 'cpmk.id_cpmk', '=', 'cpl_cpmk.id_cpmk')
            ->join('capaian_profil_lulusans as cpl', 'cpl_cpmk.id_cpl', '=', 'cpl.id_cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->where('pl.kode_prodi', $user->kode_prodi)
            ->select('mk.kode_mk', 'mk.nama_mk')
            ->distinct()
            ->get();

        return view('tim.subcpmk.create', compact('cpmks', 'mks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_mk' => 'required|exists:mata_kuliahs,kode_mk',
            'id_cpmk' => 'required|exists:capaian_pembelajaran_mata_kuliahs,id_cpmk',
            'sub_cpmk' => 'required|string|max:10',
            'uraian_cpmk' => 'required|string|max:255'
        ]);

        // Validasi bahwa MK dan CPMK benar-benar berelasi (harus ada di tabel pivot)
        $relasiValid = DB::table('cpmk_mk')
            ->where('kode_mk', $request->kode_mk)
            ->where('id_cpmk', $request->id_cpmk)
            ->exists();

        if (!$relasiValid) {
            return redirect()->back()
                ->withErrors(['CPMK yang dipilih tidak terkait dengan Mata Kuliah ini.'])
                ->withInput();
        }

        // Cek duplikasi (jika perlu)
        $duplikat = DB::table('sub_cpmks')
            ->where('kode_mk', $request->kode_mk)
            ->where('id_cpmk', $request->id_cpmk)
            ->where('sub_cpmk', $request->sub_cpmk)
            ->exists();

        if ($duplikat) {
            return redirect()->back()
                ->withErrors(['Sub CPMK ini sudah ada untuk kombinasi MK dan CPMK tersebut.'])
                ->withInput();
        }

        SubCpmk::create([
            'id_cpmk' => $request->id_cpmk,
            'kode_mk' => $request->kode_mk,
            'sub_cpmk' => $request->sub_cpmk,
            'uraian_cpmk' => $request->uraian_cpmk,
        ]);

        return redirect()->route('tim.subcpmk.index')->with('success', 'Sub CPMK berhasil ditambahkan.');
    }

    public function edit(SubCpmk $id_sub_cpmk)
    {
        $kodeProdi = Auth::user()->kode_prodi;

        // Cek akses: pastikan sub_cpmk ini milik prodi user
        $akses = DB::table('sub_cpmks as sc')
            ->join('capaian_pembelajaran_mata_kuliahs as cpmk', 'sc.id_cpmk', '=', 'cpmk.id_cpmk')
            ->join('cpl_cpmk as cplcpmk', 'cpmk.id_cpmk', '=', 'cplcpmk.id_cpmk')
            ->join('capaian_profil_lulusans as cpl', 'cplcpmk.id_cpl', '=', 'cpl.id_cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->where('sc.id_sub_cpmk', $id_sub_cpmk->id_sub_cpmk)
            ->where('pl.kode_prodi', $kodeProdi)
            ->exists();

        if (!$akses) {
            abort(403, 'Akses ditolak');
        }

        $cpmks = DB::table('capaian_pembelajaran_mata_kuliahs as cpmk')
            ->join('cpl_cpmk', 'cpmk.id_cpmk', '=', 'cpl_cpmk.id_cpmk')
            ->join('capaian_profil_lulusans as cpl', 'cpl_cpmk.id_cpl', '=', 'cpl.id_cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->where('pl.kode_prodi', $kodeProdi)
            ->select('cpmk.id_cpmk', 'cpmk.kode_cpmk', 'cpmk.deskripsi_cpmk')
            ->distinct()
            ->get();

        return view('tim.subcpmk.edit', [
            'subcpmk' => $id_sub_cpmk,
            'cpmks' => $cpmks
        ]);
    }

    public function update(Request $request, SubCpmk $id_sub_cpmk)
    {
        $request->validate([
            'id_cpmk' => 'required|exists:capaian_pembelajaran_mata_kuliahs,id_cpmk',
            'sub_cpmk' => 'required|string|max:10',
            'uraian_cpmk' => 'required|string|max:255'
        ]);

        $id_sub_cpmk->update($request->only(['id_cpmk', 'sub_cpmk', 'uraian_cpmk']));

        return redirect()->route('tim.subcpmk.index')->with('success', 'Sub CPMK berhasil diperbarui');
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
            ->join('cpmk_mk', 'cpmk.id_cpmk', '=', 'cpmk_mk.id_cpmk')
            ->join('mata_kuliahs as mk', 'cpmk_mk.kode_mk', '=', 'mk.kode_mk')
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

        return view('tim.pemetaanmkcpmksubcpmk.index', compact('data', 'id_tahun', 'tahun_tersedia'));
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

        return view('tim.subcpmk.detail', compact('subcpmk'));
    }

    public function destroy($id)
    {
        $kodeProdi = Auth::user()->kode_prodi;

        // Pastikan Sub CPMK milik prodi user
        $akses = DB::table('sub_cpmks as sc')
            ->join('capaian_pembelajaran_mata_kuliahs as cpmk', 'sc.id_cpmk', '=', 'cpmk.id_cpmk')
            ->join('cpl_cpmk as cplcpmk', 'cpmk.id_cpmk', '=', 'cplcpmk.id_cpmk')
            ->join('capaian_profil_lulusans as cpl', 'cplcpmk.id_cpl', '=', 'cpl.id_cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->where('sc.id_sub_cpmk', $id)
            ->where('pl.kode_prodi', $kodeProdi)
            ->exists();

        if (!$akses) {
            abort(403, 'Akses ditolak');
        }

        $deleted = SubCpmk::where('id_sub_cpmk', $id)->delete();

        if (!$deleted) {
            return redirect()->back()->with('error', 'Gagal menghapus Sub CPMK.');
        }

        return redirect()->route('tim.subcpmk.index')->with('success', 'Sub CPMK berhasil dihapus.');
    }
}
