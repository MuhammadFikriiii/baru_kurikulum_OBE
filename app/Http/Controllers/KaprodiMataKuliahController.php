<?php

namespace App\Http\Controllers;

use App\Models\BahanKajian;
use App\Models\CapaianProfilLulusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\MataKuliah;

class KaprodiMataKuliahController extends Controller
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
            ->where('prodis.kode_prodi', '=', $kodeProdi)
            ->groupBy(
                'mk.kode_mk',
                'mk.nama_mk',
                'mk.jenis_mk',
                'mk.sks_mk',
                'mk.semester_mk',
                'mk.kompetensi_mk',
                'prodis.nama_prodi'
            );
        if ($id_tahun) {
            $query->where('pl.id_tahun', $id_tahun);
        }
        $mata_kuliahs = $query->get();

        return view('kaprodi.matakuliah.index', compact('mata_kuliahs', 'id_tahun', 'tahun_tersedia'));
    }

    public function detail(MataKuliah $matakuliah)
    {

        $kodeProdi = Auth::user()->kode_prodi;

        $selectedCPL = DB::table('cpl_mk as cplmk')
            ->join('capaian_profil_lulusans as cpl', 'cplmk.id_cpl', '=', 'cpl.id_cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->join('prodis', 'pl.kode_prodi', '=', 'prodis.kode_prodi')
            ->where('cplmk.kode_mk', $matakuliah->kode_mk)
            ->where('prodis.kode_prodi', $kodeProdi)
            ->pluck('cplmk.id_cpl')
            ->unique()
            ->toArray();

        $cplList = CapaianProfilLulusan::whereIn('id_cpl', $selectedCPL)->get();

        $selectedBK = DB::table('bk_mk as bkmk')
            ->join('bahan_kajians as bk', 'bkmk.id_bk', '=', 'bk.id_bk')
            ->join('cpl_bk', 'bk.id_bk', '=', 'cpl_bk.id_bk')
            ->join('capaian_profil_lulusans as cpl', 'cpl_bk.id_cpl', '=', 'cpl.id_cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->join('prodis', 'pl.kode_prodi', '=', 'prodis.kode_prodi')
            ->where('bkmk.kode_mk', $matakuliah->kode_mk)
            ->where('prodis.kode_prodi', $kodeProdi)
            ->orderBy('bk.kode_bk')
            ->pluck('bkmk.id_bk')
            ->unique()
            ->toArray();

        if (empty($selectedCPL)) {
            abort(403, 'Akses ditolak');
        }
        $bkList = BahanKajian::whereIn('id_bk', $selectedBK)->get();

        return view("kaprodi.matakuliah.detail", compact('matakuliah', 'cplList', 'selectedCPL', 'bkList', 'selectedBK'));
    }

    public function organisasi_mk(Request $request)
    {
        $user = Auth::user();

        if (!$user || !$user->kode_prodi) {
            abort(403);
        }

        $kodeProdi = $user->kode_prodi;
        $id_tahun = request()->get('id_tahun');
        $tahun_tersedia = \App\Models\Tahun::orderBy('tahun', 'desc')->get();

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
            ->where('prodis.kode_prodi', '=', $kodeProdi);

        // Tambahkan filter tahun jika ada
        if ($id_tahun) {
            $query->where('pl.id_tahun', $id_tahun);
        }

        $query->groupBy(
            'mk.kode_mk',
            'mk.nama_mk',
            'mk.jenis_mk',
            'mk.sks_mk',
            'mk.semester_mk',
            'mk.kompetensi_mk',
            'prodis.nama_prodi',
            'prodis.kode_prodi'
        );

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

        return view('kaprodi.matakuliah.organisasimk', compact('organisasiMK', 'kodeProdi', 'id_tahun', 'tahun_tersedia'));
    }
}
