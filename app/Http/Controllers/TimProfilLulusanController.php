<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfilLulusan;
use Illuminate\Support\Facades\Auth;

class TimProfilLulusanController extends Controller
{
    public function index()
    {
        $user = Auth::guard('userprodi')->user();

        if (!$user || !$user->kode_prodi) {
            abort(404);
        }
        $kodeProdi = $user->kode_prodi;

        $profillulusans = ProfilLulusan::where('kode_prodi', $kodeProdi)->with('prodi')->get();
        return view('tim.profillulusan.index', compact('profillulusans'));
    }

    public function create()
    {
        $user = Auth::guard('userprodi')->user();

        if (!$user || !$user->kode_prodi) {
            abort(404);
        }

        return view('tim.profillulusan.create');
    }

    public function store(Request $request)
    {
        $user = Auth::guard('userprodi')->user();

        if (!$user || !$user->kode_prodi) {
            abort(404);
        }

        $request->merge(['kode_prodi' => $user->kode_prodi]);

        $request->validate([
            'kode_pl' => 'required|string',
            'kode_prodi' => 'required|string',
            'deskripsi_pl' => 'required|string',
            'profesi_pl' => 'required|string',
            'unsur_pl' => 'required|in:Pengetahuan,Keterampilan Khusus,Sikap dan Keterampilan Umum',
            'keterangan_pl' => 'required|in:Kompetensi Utama Bidang,Kompetensi Tambahan',
            'sumber_pl' => 'required|string',
        ]);

        ProfilLulusan::create($request->all());

        return redirect()->route('tim.profillulusan.index')->with('success', 'Profil Lulusan berhasil ditambahkan!');
    }

}
