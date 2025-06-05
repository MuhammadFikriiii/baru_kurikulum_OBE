<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\CapaianProfilLulusan;
use App\Models\BahanKajian;

class AdminMataKuliahController extends Controller
{
    public function index(Request $request)
    {
        $kode_prodi = $request->get('kode_prodi');
        $prodis = DB::table('prodis')->get();

        $query = DB::table('mata_kuliahs as mk')
            ->select(
                'mk.kode_mk',
                'mk.nama_mk',
                'mk.jenis_mk',
                'mk.sks_mk',
                'mk.semester_mk',
                'mk.kompetensi_mk',
                'prodis.nama_prodi'
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

        return view("admin.matakuliah.index", compact("mata_kuliahs", 'kode_prodi', 'prodis'));
    }

    public function getCplByBk(Request $request)
    {
        $id_bks = $request->id_bks ?? [];

        $cpls = DB::table('cpl_bk')
            ->join('capaian_profil_lulusans as cpl', 'cpl_bk.id_cpl', '=', 'cpl.id_cpl')
            ->whereIn('cpl_bk.id_bk', $id_bks)
            ->select('cpl.id_cpl', 'cpl.kode_cpl', 'cpl.deskripsi_cpl')
            ->distinct()
            ->orderBy('cpl.kode_cpl')
            ->get();

        return response()->json($cpls);
    }

    public function create()
    {
        $capaianProfilLulusans = CapaianProfilLulusan::orderBy('kode_cpl', 'asc')->get();

        $bahanKajians = DB::table('bahan_kajians')->get();
        return view("admin.matakuliah.create",  compact("capaianProfilLulusans", "bahanKajians"));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_mk' => 'required|string|max:10|unique:mata_kuliahs,kode_mk',
            'nama_mk' => 'required|string|max:50',
            'jenis_mk' => 'required|string|max:50',
            'sks_mk' => 'required|integer',
            'semester_mk' => 'required|integer|in:1,2,3,4,5,6,7,8',
            'kompetensi_mk' => 'required|string|in:pendukung,utama',
        ]);
        $mk = MataKuliah::create($request->only(['kode_mk', 'nama_mk', 'jenis_mk', 'sks_mk', 'semester_mk', 'kompetensi_mk']));

        $cpls = DB::table('cpl_bk')
            ->whereIn('id_bk', $request->id_bks)
            ->select('id_cpl')
            ->distinct()
            ->pluck('id_cpl');

        foreach ($cpls as $id_cpl) {
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
        return redirect()->route('admin.matakuliah.index')->with('success', 'Mata kuliah berhasil ditambahkan!');
    }

    public function edit(MataKuliah $matakuliah)
    {
        $capaianProfilLulusans = CapaianProfilLulusan::orderBy('kode_cpl', 'asc')->get();
        $bahanKajians = DB::table('bahan_kajians')->get();
        $selectedCpls = DB::table('cpl_mk')
            ->join('capaian_profil_lulusans as cpl', 'cpl_mk.id_cpl', '=', 'cpl.id_cpl')
            ->where('cpl_mk.kode_mk', $matakuliah->kode_mk)
            ->select('cpl.kode_cpl', 'cpl.deskripsi_cpl')
            ->get();
        $selectedBahanKajian = DB::table('bk_mk')
            ->where('kode_mk', $matakuliah->kode_mk)
            ->pluck('id_bk')
            ->toArray();

        return view('admin.matakuliah.edit', compact('matakuliah', 'capaianProfilLulusans', 'bahanKajians', 'selectedCpls', 'selectedBahanKajian'));
    }

    public function update(Request $request, MataKuliah $matakuliah)
    {
        $request->validate([
            'kode_mk' => [
                'required',
                'string',
                'max:10',
                Rule::unique('mata_kuliahs', 'kode_mk')->ignore($matakuliah->kode_mk, 'kode_mk'),
            ],
            'nama_mk' => 'required|string|max:50',
            'jenis_mk' => 'required|string|max:50',
            'sks_mk' => 'required|integer',
            'semester_mk' => 'required|integer|in:1,2,3,4,5,6,7,8',
            'kompetensi_mk' => 'required|string|in:pendukung,utama',
            'id_bks' => 'required|array',
        ]);

        // Simpan kode_mk lama sebelum update untuk hapus data relasi lama
        $old_kode_mk = $matakuliah->kode_mk;

        // Update data dasar mata kuliah
        $matakuliah->update($request->only([
            'kode_mk',
            'nama_mk',
            'jenis_mk',
            'sks_mk',
            'semester_mk',
            'kompetensi_mk'
        ]));

        $new_kode_mk = $matakuliah->kode_mk;

        // Hapus relasi cpl_mk lama berdasarkan kode lama
        DB::table('cpl_mk')->where('kode_mk', $old_kode_mk)->delete();

        // Ambil id_cpl terkait id_bk dari input
        $cpls = DB::table('cpl_bk')
            ->whereIn('id_bk', $request->id_bks)
            ->pluck('id_cpl')
            ->unique();

        // Insert ulang relasi cpl_mk dengan kode mk baru
        foreach ($cpls as $id_cpl) {
            DB::table('cpl_mk')->insert([
                'kode_mk' => $new_kode_mk,
                'id_cpl' => $id_cpl
            ]);
        }

        // Hapus relasi bk_mk lama berdasarkan kode lama
        DB::table('bk_mk')->where('kode_mk', $old_kode_mk)->delete();

        // Insert ulang relasi bk_mk dengan kode mk baru
        foreach ($request->id_bks as $id_bk) {
            DB::table('bk_mk')->insert([
                'kode_mk' => $new_kode_mk,
                'id_bk' => $id_bk
            ]);
        }

        // PENDEKATAN BARU: Cari CPMK yang ada di cpl_cpmk dengan CPL yang berbeda dari CPL baru
        // Ini untuk menangani kasus dimana kode MK di cpmk_mk tidak sinkron

        // 1. Cari semua CPMK yang terkait dengan mata kuliah ini dari berbagai sumber
        $relatedCpmks = collect();

        // Dari cpmk_mk (dengan kode lama dan baru)
        $cpmksFromMk = DB::table('cpmk_mk')
            ->where(function ($query) use ($old_kode_mk, $new_kode_mk) {
                $query->where('kode_mk', $old_kode_mk)
                    ->orWhere('kode_mk', $new_kode_mk);
            })
            ->pluck('id_cpmk');

        $relatedCpmks = $relatedCpmks->merge($cpmksFromMk);

        // Jika tidak ada dari cpmk_mk, cari dari cpl_cpmk yang tidak sesuai dengan CPL baru
        if ($cpmksFromMk->isEmpty()) {
            // Cari CPMK yang ada di cpl_cpmk tapi CPL-nya bukan dari BK yang dipilih
            $cpmksFromCplCpmk = DB::table('cpl_cpmk')
                ->whereNotIn('id_cpl', $cpls)
                ->pluck('id_cpmk')
                ->unique();

            Log::info('CPMK found from cpl_cpmk with different CPL:', $cpmksFromCplCpmk->toArray());
            $relatedCpmks = $relatedCpmks->merge($cpmksFromCplCpmk);
        }

        $relatedCpmks = $relatedCpmks->unique()->toArray();

        // Debug: Log data yang diambil
        Log::info('Data untuk update cpl_cpmk:', [
            'old_kode_mk' => $old_kode_mk,
            'new_kode_mk' => $new_kode_mk,
            'cpls' => $cpls->toArray(),
            'relatedCpmks' => $relatedCpmks,
            'cpmksFromMk' => $cpmksFromMk->toArray(),
            'input_id_bks' => $request->id_bks
        ]);

        // Update kode_mk di tabel cpmk_mk jika ada dan berbeda
        if ($old_kode_mk !== $new_kode_mk && !$cpmksFromMk->isEmpty()) {
            $updatedRows = DB::table('cpmk_mk')
                ->where('kode_mk', $old_kode_mk)
                ->update(['kode_mk' => $new_kode_mk]);
            Log::info('Updated cpmk_mk rows: ' . $updatedRows);
        }

        // Proses update cpl_cpmk
        if (!empty($relatedCpmks)) {
            // Hapus relasi lama untuk CPMK yang ditemukan
            $deletedRows = DB::table('cpl_cpmk')->whereIn('id_cpmk', $relatedCpmks)->delete();
            Log::info('Deleted cpl_cpmk rows: ' . $deletedRows);

            // Insert ulang relasi cpl_cpmk berdasarkan cpmk dan cpl (dari BK yang dipilih)
            $insertedData = [];
            foreach ($relatedCpmks as $id_cpmk) {
                foreach ($cpls as $id_cpl) {
                    $data = [
                        'id_cpmk' => $id_cpmk,
                        'id_cpl' => $id_cpl,
                    ];
                    DB::table('cpl_cpmk')->insert($data);
                    $insertedData[] = $data;
                }
            }
            Log::info('Inserted cpl_cpmk data:', $insertedData);
        } else {
            Log::warning('No related CPMK found for mata kuliah old: ' . $old_kode_mk . ', new: ' . $new_kode_mk);
        }

        return redirect()->route('admin.matakuliah.index')->with('success', 'Matakuliah berhasil diperbarui.');
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

        return view('admin.matakuliah.detail', ['matakuliah' => $matakuliah, 'selectedCplIds' => $selectedCplIds, 'selectedBksIds' => $selectedBksIds, 'capaianprofillulusans' => $capaianprofillulusans,  'bahanKajians' => $bahanKajians]);
    }

    public function destroy(MataKuliah $matakuliah)
    {
        $matakuliah->delete();
        return redirect()->route('admin.matakuliah.index')->with('sukses', 'matakuliah berhasil dihapus');
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

        return view('admin.matakuliah.organisasimk', compact('organisasiMK', 'prodis', 'kode_prodi'));
    }
}
