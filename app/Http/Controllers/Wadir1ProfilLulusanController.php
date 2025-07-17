<?php

namespace App\Http\Controllers;

use App\Models\ProfilLulusan;
use Illuminate\Http\Request;
use App\Models\Prodi;
use App\Models\Tahun;
use Illuminate\Support\Facades\DB;

class Wadir1ProfilLulusanController extends Controller
{
    public function index(Request $request)
    {
        $kode_prodi = $request->get('kode_prodi');
        $id_tahun = $request->get('id_tahun');
        $prodis = Prodi::all();

        // Ambil tahun-tahun yang tersedia dari tabel tahun
        $tahun_tersedia = Tahun::orderBy('tahun', 'desc')->get();

        $query = ProfilLulusan::with(['prodi', 'tahun']);

        if ($kode_prodi) {
            $query->where('kode_prodi', $kode_prodi);
        }

        if ($id_tahun) {
            $query->where('id_tahun', $id_tahun);
        }

        $profillulusans = $query->orderBy('kode_pl', 'asc')->get();

        if (empty($kode_prodi)) {
            $profillulusans = collect();
        }

        return view('wadir1.profillulusan.index', compact('profillulusans', 'prodis', 'kode_prodi', 'id_tahun', 'tahun_tersedia'));
    }

    public function detail(Profillulusan $id_pl)
    {
        $tahuns = Tahun::all();
        $profillulusan = $id_pl;
        return view('wadir1.profillulusan.detail', compact('profillulusan', 'tahuns'));
    }
}
