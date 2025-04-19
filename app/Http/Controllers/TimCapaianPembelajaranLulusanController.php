<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\CapaianProfilLulusan;
use App\Models\ProfilLulusan;
use App\Models\UserProdi;

class TimCapaianPembelajaranLulusanController extends Controller
{
    public function index()
    {
        $user = Auth::guard('userprodi')->user();

        if (!$user || !$user->kode_prodi) {
            abort(403);
        }
        $kodeProdi = $user->kode_prodi;

        $capaianprofillulusans = DB::table('capaian_profil_lulusans')
            ->leftJoin('cpl_pl', 'capaian_profil_lulusans.id_cpl', '=', 'cpl_pl.id_cpl')
            ->leftJoin('profil_lulusans', 'cpl_pl.id_pl', '=', 'profil_lulusans.id_pl')
            ->leftJoin('prodis', 'profil_lulusans.kode_prodi', '=', 'prodis.kode_prodi')
            ->where('profil_lulusans.kode_prodi', $kodeProdi)
            ->select('capaian_profil_lulusans.id_cpl', 'capaian_profil_lulusans.deskripsi_cpl','capaian_profil_lulusans.kode_cpl', 'capaian_profil_lulusans.status_cpl', 'prodis.nama_prodi')
            ->groupBy('capaian_profil_lulusans.id_cpl', 'capaian_profil_lulusans.deskripsi_cpl', 'capaian_profil_lulusans.kode_cpl', 'capaian_profil_lulusans.status_cpl', 'prodis.nama_prodi')
            ->get();

        return view("tim.capaianpembelajaranlulusan.index", compact("capaianprofillulusans"));
    }

    public function create()
    {
        $user = Auth::guard('userprodi')->user();

        if (!$user || !$user->kode_prodi) {
            abort(403, 'Akses ditolak');
        }

        $prodiId = $user->kode_prodi;
        
        $profilLulusans = ProfilLulusan::where('kode_prodi', $prodiId)->get();
        
        return view('tim.capaianpembelajaranlulusan.create', compact('profilLulusans'));
    }

    public function store(Request $request)
    {
        $user = Auth::guard('userprodi')->user();

        if (!$user || !$user->kode_prodi) {
            abort(403, 'Akses ditolak');
        }
        
        $prodiId = $user->kode_prodi;

        $profilLulusans = ProfilLulusan::where('kode_prodi', $prodiId)->get();

        request()->validate([
            'kode_cpl'=> 'required|string|max:10',
            'deskripsi_cpl'=> 'required',
            'status_cpl'=>'required|in:Kompetensi Utama Bidang,Kompetensi Tambahan',
        ]);
        CapaianProfilLulusan::create($request->all());
        return redirect()->route('tim.capaianpembelajaranlulusan.index', compact('profilLulusan'))->with('success', 'Capaian Profil lulusan berhasil ditambahkan.',);
    }

}
