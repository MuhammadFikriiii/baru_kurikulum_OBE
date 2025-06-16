<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CapaianProfilLulusan;
use App\Models\ProfilLulusan;
use Illuminate\Support\Facades\DB;

class Wadir1CapaianPembelajaranLulusanController extends Controller
{
    public function index(Request $request)
    {
        $kode_prodi = $request->get('kode_prodi');
        $id_tahun = $request->get('id_tahun');
        $prodis = DB::table('prodis')->get();

        if (!$kode_prodi) {
            // Ambil tahun-tahun yang tersedia dari tabel tahun
            $tahun_tersedia = \App\Models\Tahun::orderBy('tahun', 'desc')->get();
            return view("wadir1.capaianpembelajaranlulusan.index", compact("prodis", "kode_prodi", "id_tahun", "tahun_tersedia"));
        }

        $query = DB::table('capaian_profil_lulusans')
            ->leftJoin('cpl_pl', 'capaian_profil_lulusans.id_cpl', '=', 'cpl_pl.id_cpl')
            ->leftJoin('profil_lulusans', 'cpl_pl.id_pl', '=', 'profil_lulusans.id_pl')
            ->leftJoin('prodis', 'profil_lulusans.kode_prodi', '=', 'prodis.kode_prodi')
            ->select('capaian_profil_lulusans.id_cpl', 'capaian_profil_lulusans.deskripsi_cpl', 'capaian_profil_lulusans.kode_cpl', 'capaian_profil_lulusans.status_cpl', 'prodis.nama_prodi')
            ->groupBy('capaian_profil_lulusans.id_cpl', 'capaian_profil_lulusans.deskripsi_cpl', 'capaian_profil_lulusans.kode_cpl', 'capaian_profil_lulusans.status_cpl', 'prodis.nama_prodi')
            ->orderBy('kode_cpl', 'asc');

        if ($kode_prodi) {
            $query->where('prodis.kode_prodi', $kode_prodi);
        }

        // Filter berdasarkan tahun jika ada
        if ($id_tahun) {
            $query->where('profil_lulusans.id_tahun', $id_tahun);
        }

        $capaianprofillulusans = $query->get();

        // Ambil tahun-tahun yang tersedia dari tabel tahun
        $tahun_tersedia = \App\Models\Tahun::orderBy('tahun', 'desc')->get();

        $dataKosong = $capaianprofillulusans->isEmpty() && $kode_prodi;

        return view("wadir1.capaianpembelajaranlulusan.index", compact("capaianprofillulusans", "prodis", "kode_prodi", "id_tahun", "tahun_tersedia", "dataKosong"));
    }


    public function detail(CapaianProfilLulusan $id_cpl)
    {
        $selectedPlIds = DB::table('cpl_pl')
        ->where('id_cpl', $id_cpl->id_cpl)
        ->pluck('id_pl')
        ->toArray();

    $profilLulusans = ProfilLulusan::whereIn('id_pl', $selectedPlIds)->get();

    return view('wadir1.capaianpembelajaranlulusan.detail', [
        'id_cpl' => $id_cpl,
        'selectedProfilLulusans' => $selectedPlIds,
        'profilLulusans' => $profilLulusans
    ]);
    }
}
