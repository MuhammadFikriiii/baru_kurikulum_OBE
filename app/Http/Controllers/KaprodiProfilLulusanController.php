<?php

namespace App\Http\Controllers;

use App\Models\ProfilLulusan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class KaprodiProfilLulusanController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if (!$user || !$user->kode_prodi) {
            abort(404);
        }

        $kodeProdi = $user->kode_prodi;
        $id_tahun = $request->get('id_tahun');

        $tahun_tersedia = \App\Models\Tahun::whereHas('profillulusans', function ($query) use ($kodeProdi) {
            $query->where('kode_prodi', $kodeProdi);
        })->orderBy('tahun', 'desc')->get();

        $query = ProfilLulusan::where('kode_prodi', $kodeProdi)->with(['prodi', 'tahun']);

        if ($id_tahun) {
            $query->where('id_tahun', $id_tahun);
        }

        $profillulusans = $query->orderBy('kode_pl', 'asc')->get();

        return view('kaprodi.profillulusan.index', compact('profillulusans', 'id_tahun', 'tahun_tersedia'));
    }

    public function detail(ProfilLulusan $id_pl)
    {
        $user = Auth::user();

        if (!$user || !$user->kode_prodi || $id_pl->kode_prodi !== $user->kode_prodi) {
            abort(403, 'Akses ditolak');
        }

        return view('kaprodi.profillulusan.detail', compact('id_pl'));
    }
}
