<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CapaianProfilLulusan;
use App\Models\CapaianPembelajaranMataKuliah;
use App\Models\MataKuliah;

class AdminPemetaanCplCpmkMkController extends Controller
{
    public function index()
    {
        // Ambil data CPL dan CPMK dari database
        $data = DB::table('cpl_cpmk')
            ->join('capaian_pembelajaran_mata_kuliahs as cpmk', 'cpl_cpmk.id_cpmk', '=', 'cpmk.id_cpmk')
            ->join('capaian_profil_lulusans as cpl', 'cpl_cpmk.id_cpl', '=', 'cpl.id_cpl')
            ->join('cpmk_mk', 'cpl_cpmk.id_cpmk', '=', 'cpmk_mk.id_cpmk')
            ->join('mata_kuliahs as mk', 'cpmk_mk.kode_mk', '=', 'mk.kode_mk')
            ->select(
                'cpl.id_cpl',
                'cpl.kode_cpl',
                'cpl.deskripsi_cpl',
                'cpmk.id_cpmk',
                'cpmk.kode_cpmk',
                'cpmk.deskripsi_cpmk',
                'mk.nama_mk'
            )
            ->orderBy('cpl.kode_cpl')
            ->get();

        // Menyusun data dalam format yang mudah dipakai
        $matrix = [];
        foreach ($data as $row) {
            $matrix[$row->kode_cpl]['deskripsi'] = $row->deskripsi_cpl;
            $matrix[$row->kode_cpl]['cpmk'][$row->kode_cpmk]['deskripsi'] = $row->deskripsi_cpmk;
            $matrix[$row->kode_cpl]['cpmk'][$row->kode_cpmk]['mk'][] = $row->nama_mk;
        }

        return view('admin.pemetaancplcpmkmk.index', compact('matrix'));
    }

    public function pemenuhancplcpmkmk()
    {
        $data = DB::table('cpl_cpmk')
            ->join('capaian_pembelajaran_mata_kuliahs as cpmk', 'cpl_cpmk.id_cpmk', '=', 'cpmk.id_cpmk')
            ->join('capaian_profil_lulusans as cpl', 'cpl_cpmk.id_cpl', '=', 'cpl.id_cpl')
            ->join('cpmk_mk', 'cpl_cpmk.id_cpmk', '=', 'cpmk_mk.id_cpmk')
            ->join('mata_kuliahs as mk', 'cpmk_mk.kode_mk', '=', 'mk.kode_mk')
            ->select(
                'cpl.kode_cpl',
                'cpl.deskripsi_cpl',
                'cpmk.kode_cpmk',
                'cpmk.deskripsi_cpmk',
                'mk.kode_mk',
                'nama_mk',
                'mk.semester_mk'
            )
            ->orderBy('cpl.kode_cpl')
            ->get();

        $matrix = [];

        foreach ($data as $row) {
            $kode_cpl = $row->kode_cpl;
            $kode_cpmk = $row->kode_cpmk;
            $semester = $row->semester_mk;

            $matrix[$kode_cpl]['deskripsi'] = $row->deskripsi_cpl;
            $matrix[$kode_cpl]['cpmk'][$kode_cpmk]['deskripsi'] = $row->deskripsi_cpmk;

            if ($semester >= 1 && $semester <= 8) {
                $matrix[$kode_cpl]['cpmk'][$kode_cpmk]['semester'][$semester][] = $row->kode_mk;
            }
        }

        return view('admin.pemetaancplcpmkmk.pemenuhancplcpmkmk', compact('matrix'));
    }

    public function pemetaanmkcpmkcpl()
    {
        $data = DB::table('cpl_cpmk')
            ->join('capaian_pembelajaran_mata_kuliahs as cpmk', 'cpl_cpmk.id_cpmk', '=', 'cpmk.id_cpmk')
            ->join('capaian_profil_lulusans as cpl', 'cpl_cpmk.id_cpl', '=', 'cpl.id_cpl')
            ->join('cpmk_mk', 'cpl_cpmk.id_cpmk', '=', 'cpmk_mk.id_cpmk')
            ->join('mata_kuliahs as mk', 'cpmk_mk.kode_mk', '=', 'mk.kode_mk')
            ->select(
                'mk.kode_mk',
                'mk.nama_mk',
                'cpl.kode_cpl',
                'cpmk.kode_cpmk'
            )
            ->orderBy('mk.kode_mk')
            ->get();

        $matrix = [];
        $semuaCpl = collect();

        foreach ($data as $row) {
            $kode_mk = $row->kode_mk;
            $kode_cpl = $row->kode_cpl;
            $kode_cpmk = $row->kode_cpmk;

            $matrix[$kode_mk]['nama'] = $row->nama_mk;
            $matrix[$kode_mk]['cpl'][$kode_cpl]['cpmks'][] = $kode_cpmk;

            $semuaCpl->push($kode_cpl);
        }

        $semuaCpl = $semuaCpl->unique()->sort()->values();

        return view('admin.pemetaancplcpmkmk.pemetaanmkcplcpmk', compact('matrix', 'semuaCpl'));
    }
}
