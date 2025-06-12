<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BahanKajian;
use App\Models\CapaianProfilLulusan;
use Illuminate\Validation\Rule;
use App\Models\Prodi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminBahanKajianController extends Controller
{
    public function index(Request $request)
    {
        $kode_prodi = $request->get('kode_prodi');
        $id_tahun = $request->get('id_tahun');
        $prodis = DB::table('prodis')->get();
        if (!$kode_prodi) {
            $tahun_tersedia = \App\Models\Tahun::orderBy('tahun', 'desc')->get();
            return view("admin.bahankajian.index", compact("prodis", "kode_prodi", "id_tahun", "tahun_tersedia"));
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

        return view('admin.bahankajian.index', compact('bahankajians', 'prodis', 'kode_prodi', 'dataKosong', 'id_tahun', 'tahun_tersedia'));
    }


    public function create()
    {
        $capaianProfilLulusans = DB::table('capaian_profil_lulusans')
        ->join('cpl_pl', 'capaian_profil_lulusans.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans', 'cpl_pl.id_pl', '=', 'profil_lulusans.id_pl')
            ->join('tahun', 'profil_lulusans.id_tahun', '=', 'tahun.id_tahun')
            ->join('prodis', 'profil_lulusans.kode_prodi', '=', 'prodis.kode_prodi')
            ->select('capaian_profil_lulusans.id_cpl', 'capaian_profil_lulusans.deskripsi_cpl', 'capaian_profil_lulusans.kode_cpl', 'prodis.nama_prodi', 'tahun.tahun')
            ->orderBy('prodis.nama_prodi')
            ->get();

        return view('admin.bahankajian.create', compact('capaianProfilLulusans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_bk' => 'required|string|max:10',
            'nama_bk' => 'required|string|max:50',
            'deskripsi_bk' => 'nullable|string',
            'referensi_bk' => 'required|string|max:50',
            'status_bk' => 'required|in:core,elective',
            'knowledge_area' => 'required|string',
        ]);

        $bk = BahanKajian::create($request->only(['kode_bk', 'nama_bk', 'deskripsi_bk', 'referensi_bk', 'status_bk', 'knowledge_area']));

        foreach ($request->id_cpls as $id_cpl) {
            DB::table('cpl_bk')->insert([
                'id_bk' => $bk->id_bk,
                'id_cpl' => $id_cpl
            ]);
        }
        return redirect()->route('admin.bahankajian.index')->with('success', 'Bahan Kajian berhasil ditambahkan.');
    }

    public function edit($id_bk)
    {
        $bahankajian = BahanKajian::findOrFail($id_bk);

        $capaianprofillulusans = DB::table('capaian_profil_lulusans')
        ->join('cpl_pl', 'capaian_profil_lulusans.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans', 'cpl_pl.id_pl', '=', 'profil_lulusans.id_pl')
            ->join('tahun', 'profil_lulusans.id_tahun', '=', 'tahun.id_tahun')
            ->join('prodis', 'profil_lulusans.kode_prodi', '=', 'prodis.kode_prodi')
            ->select('capaian_profil_lulusans.id_cpl', 'capaian_profil_lulusans.deskripsi_cpl', 'capaian_profil_lulusans.kode_cpl', 'prodis.nama_prodi', 'tahun.tahun')
            ->orderBy('prodis.nama_prodi')
            ->get();

        $selectedCapaianProfilLulusans = DB::table('cpl_bk')
            ->where('id_bk', $id_bk)
            ->pluck('id_cpl')
            ->toArray();

        return view('admin.bahankajian.edit', compact('bahankajian', 'capaianprofillulusans', 'selectedCapaianProfilLulusans'));
    }

    public function update(Request $request, $id_bk)
    {
        request()->validate([
            'kode_bk' => 'required|string|max:10',
            'nama_bk' => 'required|string|max:50',
            'deskripsi_bk' => 'nullable|string',
            'referensi_bk' => 'required|string|max:50',
            'status_bk' => 'required|in:core,elective',
            'knowledge_area' => 'required|string',
        ]);

        $bahankajian = BahanKajian::findOrFail($id_bk);

        // Ambil CPL lama sebelum update untuk tracking perubahan
        $oldCpls = DB::table('cpl_bk')
            ->where('id_bk', $id_bk)
            ->pluck('id_cpl')
            ->toArray();

        // Update data bahan kajian
        $bahankajian->update($request->all());

        // Delete relasi CPL-BK lama
        DB::table('cpl_bk')->where('id_bk', $id_bk)->delete();

        // Insert relasi CPL-BK baru
        $newCpls = [];
        if ($request->has('id_cpls')) {
            foreach ($request->id_cpls as $id_cpl) {
                DB::table('cpl_bk')->insert([
                    'id_bk' => $id_bk,
                    'id_cpl' => $id_cpl
                ]);
                $newCpls[] = $id_cpl;
            }
        }

        // TAMBAHAN: Auto-sync CPL ke semua Mata Kuliah yang menggunakan BK ini
        if (!empty($oldCpls) || !empty($newCpls)) {
            // Cari semua mata kuliah yang menggunakan BK ini
            $affectedMataKuliahs = DB::table('bk_mk')
                ->where('id_bk', $id_bk)
                ->pluck('kode_mk')
                ->toArray();

            if (!empty($affectedMataKuliahs)) {
                Log::info('Auto-sync CPL untuk mata kuliah:', [
                    'id_bk' => $id_bk,
                    'old_cpls' => $oldCpls,
                    'new_cpls' => $newCpls,
                    'affected_mk' => $affectedMataKuliahs
                ]);

                foreach ($affectedMataKuliahs as $kode_mk) {
                    // Hapus relasi CPL-MK lama untuk mata kuliah ini
                    DB::table('cpl_mk')->where('kode_mk', $kode_mk)->delete();

                    // Ambil semua BK yang digunakan mata kuliah ini
                    $allBksForThisMk = DB::table('bk_mk')
                        ->where('kode_mk', $kode_mk)
                        ->pluck('id_bk')
                        ->toArray();

                    // Ambil semua CPL dari semua BK yang digunakan mata kuliah ini
                    $allCplsForThisMk = DB::table('cpl_bk')
                        ->whereIn('id_bk', $allBksForThisMk)
                        ->pluck('id_cpl')
                        ->unique()
                        ->toArray();

                    // Insert ulang relasi CPL-MK dengan CPL yang baru
                    foreach ($allCplsForThisMk as $id_cpl) {
                        DB::table('cpl_mk')->insert([
                            'kode_mk' => $kode_mk,
                            'id_cpl' => $id_cpl
                        ]);
                    }

                    // FIX: Update juga relasi CPL-CPMK untuk mata kuliah ini dengan logika yang sama seperti di controller MK
                    // 1. Cari semua CPMK yang terkait dengan mata kuliah ini dari berbagai sumber
                    $relatedCpmks = collect();

                    // Dari cpmk_mk
                    $cpmksFromMk = DB::table('cpmk_mk')
                        ->where('kode_mk', $kode_mk)
                        ->pluck('id_cpmk');

                    $relatedCpmks = $relatedCpmks->merge($cpmksFromMk);

                    // Jika tidak ada dari cpmk_mk, cari dari cpl_cpmk yang tidak sesuai dengan CPL baru
                    if ($cpmksFromMk->isEmpty()) {
                        // Cari CPMK yang ada di cpl_cpmk tapi CPL-nya bukan dari BK yang dipilih
                        $cpmksFromCplCpmk = DB::table('cpl_cpmk')
                            ->whereNotIn('id_cpl', $allCplsForThisMk)
                            ->pluck('id_cpmk')
                            ->unique();

                        Log::info('CPMK found from cpl_cpmk with different CPL for MK ' . $kode_mk . ':', $cpmksFromCplCpmk->toArray());
                        $relatedCpmks = $relatedCpmks->merge($cpmksFromCplCpmk);
                    }

                    $relatedCpmks = $relatedCpmks->unique()->toArray();

                    // Debug: Log data yang diambil
                    Log::info('Data untuk update cpl_cpmk dari BK untuk MK ' . $kode_mk . ':', [
                        'allCplsForThisMk' => $allCplsForThisMk,
                        'relatedCpmks' => $relatedCpmks,
                        'cpmksFromMk' => $cpmksFromMk->toArray(),
                    ]);

                    // Proses update cpl_cpmk
                    if (!empty($relatedCpmks)) {
                        // Hapus relasi lama untuk CPMK yang ditemukan
                        $deletedRows = DB::table('cpl_cpmk')->whereIn('id_cpmk', $relatedCpmks)->delete();
                        Log::info('Deleted cpl_cpmk rows for MK ' . $kode_mk . ': ' . $deletedRows);

                        // Insert ulang relasi cpl_cpmk berdasarkan cpmk dan cpl (dari BK yang dipilih)
                        $insertedData = [];
                        foreach ($relatedCpmks as $id_cpmk) {
                            foreach ($allCplsForThisMk as $id_cpl) {
                                $data = [
                                    'id_cpmk' => $id_cpmk,
                                    'id_cpl' => $id_cpl,
                                ];
                                DB::table('cpl_cpmk')->insert($data);
                                $insertedData[] = $data;
                            }
                        }
                        Log::info('Inserted cpl_cpmk data for MK ' . $kode_mk . ':', $insertedData);
                    } else {
                        Log::warning('No related CPMK found for mata kuliah: ' . $kode_mk);
                    }
                }

                Log::info('Auto-sync CPL selesai untuk ' . count($affectedMataKuliahs) . ' mata kuliah');
            }
        }

        return redirect()->route('admin.bahankajian.index')->with('success', 'Bahan Kajian berhasil diperbaharui');
    }

    public function destroy($id_bk)
    {
        $id_bk = BahanKajian::findOrFail($id_bk);
        $id_bk->delete();
        return redirect()->route('admin.bahankajian.index')->with('sukses', 'Bahan Kajian Berhasil Di Hapus');
    }

    public function detail(BahanKajian $id_bk)
    {
        $selectedCplIds = DB::table('cpl_bk')
            ->where('id_bk', $id_bk->id_bk)
            ->pluck('id_cpl')
            ->toArray();

        $capaianprofillulusans = CapaianProfilLulusan::whereIn('id_cpl', $selectedCplIds)->get();

        return view('admin.bahankajian.detail', [
            'id_bk' => $id_bk,
            'selectedCapaianProfilLulusans' => $selectedCplIds,
            'capaianprofillulusans' => $capaianprofillulusans
        ]);
    }
}
