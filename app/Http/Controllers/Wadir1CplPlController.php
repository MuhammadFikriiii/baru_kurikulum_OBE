<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CapaianProfilLulusan;
use App\Models\ProfilLulusan;
use App\Models\Prodi;
use Illuminate\Support\Facades\DB;

class Wadir1CplPlController extends Controller
{
    public function index(Request $request)
    {
        $kode_prodi = $request->get('kode_prodi');
        $id_tahun = $request->get('id_tahun');

        $prodis = Prodi::all();

        // Ambil PL berdasarkan prodi dan tahun
        $pls = ProfilLulusan::when($kode_prodi, function ($query) use ($kode_prodi) {
            $query->where('kode_prodi', $kode_prodi);
        })
            ->when($id_tahun, function ($query) use ($id_tahun) {
                $query->where('id_tahun', $id_tahun);
            })
            ->get();

        $plIds = $pls->pluck('id_pl');

        // Ambil CPL yang terkait dengan PL
        if ($plIds->isNotEmpty()) {
            $cplIds = DB::table('cpl_pl')
                ->whereIn('id_pl', $plIds)
                ->pluck('id_cpl')
                ->unique();

            $cpls = CapaianProfilLulusan::whereIn('id_cpl', $cplIds)->orderBy('id_cpl', 'asc')->get();
        } else {
            $cpls = collect();
        }

        // Ambil relasi CPL-PL
        $relasi = DB::table('cpl_pl')
            ->whereIn('id_pl', $plIds)
            ->orderBy('id_pl', 'asc')
            ->get()
            ->groupBy('id_pl');

        // Jika prodi belum dipilih, kosongkan data
        if (empty($kode_prodi)) {
            $pls = collect();
            $cpls = collect();
        }

        // Ambil tahun yang tersedia berdasarkan prodi yang dipilih
        $tahun_tersedia = collect();
        if ($kode_prodi) {
            $tahun_tersedia = DB::table('profil_lulusans as pl')
                ->join('tahun', 'pl.id_tahun', '=', 'tahun.id_tahun')
                ->where('pl.kode_prodi', $kode_prodi)
                ->select('tahun.id_tahun', 'tahun.nama_kurikulum', 'tahun.tahun')
                ->distinct()
                ->orderBy('tahun.tahun', 'desc')
                ->get();
        }

        // Mapping prodi berdasarkan CPL
        $prodiByCpl = DB::table('cpl_pl')
            ->join('profil_lulusans', 'cpl_pl.id_pl', '=', 'profil_lulusans.id_pl')
            ->join('prodis', 'profil_lulusans.kode_prodi', '=', 'prodis.kode_prodi')
            ->when($kode_prodi, function ($query) use ($kode_prodi) {
                $query->where('profil_lulusans.kode_prodi', $kode_prodi);
            })
            ->when($id_tahun, function ($query) use ($id_tahun) {
                $query->where('profil_lulusans.id_tahun', $id_tahun);
            })
            ->select('cpl_pl.id_cpl', 'prodis.nama_prodi')
            ->get()
            ->groupBy('id_cpl')
            ->map(function ($items) {
                return $items->first()->nama_prodi ?? '-';
            });

        return view('wadir1.pemetaancplpl.index', compact(
            'cpls',
            'pls',
            'relasi',
            'kode_prodi',
            'id_tahun',
            'prodis',
            'tahun_tersedia',
            'prodiByCpl'
        ));
    }
}
