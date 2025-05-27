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
        $prodis = DB::table('prodis')->get();
        
        if (!$kode_prodi) {
            return view("wadir1.capaianpembelajaranlulusan.index", compact("prodis", "kode_prodi"));
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

        $capaianprofillulusans = $query->get();

        $dataKosong = $capaianprofillulusans->isEmpty() && $kode_prodi;

        return view("wadir1.capaianpembelajaranlulusan.index", compact("capaianprofillulusans", "prodis", "kode_prodi", "dataKosong"));
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
