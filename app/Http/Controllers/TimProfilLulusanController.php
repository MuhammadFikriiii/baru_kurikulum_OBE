<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfilLulusan;
use Illuminate\Support\Facades\Auth;
use App\Models\Prodi;

class TimProfilLulusanController extends Controller
{
    public function index()
    {
        $user = Auth::user();

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
            abort(403);
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

    public function edit ($id_pl)
    {
        $user = Auth::guard('userprodi')->user();

        $profillulusan = ProfilLulusan::where('id_pl', $id_pl)
            ->where('kode_prodi', $user->kode_prodi)
            ->first();

    if (!$profillulusan) {
        abort(403, 'Akses ditolak');
    }
        $prodis = Prodi::all();
        $profillulusan = ProfilLulusan::findOrFail($id_pl);
        return view('tim.profillulusan.edit', compact('profillulusan', 'prodis'));
    }

    public function update(Request $request, $id_pl)
    {
        $user = Auth::guard('userprodi')->user();

        if (!$user || !$user->kode_prodi) {
            abort(403);
        }
        $profillulusan = ProfilLulusan::where('id_pl', $id_pl)
        ->where('kode_prodi', $user->kode_prodi)
        ->first();

        if (!$profillulusan) {
            abort(403, 'Akses ditolak');
        }
        $request->merge(['kode_prodi' => $user->kode_prodi]);
        $request->validate([
            'kode_pl' => 'required|string|max:10',
            'kode_prodi' => 'required|string|max:10',
            'deskripsi_pl' => 'required',
            'profesi_pl' => 'required',
            'unsur_pl' => 'required|in:Pengetahuan,Keterampilan Khusus,Sikap dan Keterampilan Umum',
            'keterangan_pl' => 'required|in:Kompetensi Utama Bidang,Kompetensi Tambahan',
            'sumber_pl' => 'required',
        ]);

        $profillulusan->update($request->all());
        return redirect()->route('tim.profillulusan.index')->with('success', 'Profil Lulusan berhasil diperbarui.');
    }

    public function detail(ProfilLulusan $id_pl)
    {
        $user = Auth::guard('userprodi')->user();

    if (!$user || !$user->kode_prodi || $id_pl->kode_prodi !== $user->kode_prodi) {
        abort(403, 'Akses ditolak');
    }

        return view('tim.profillulusan.detail', compact('id_pl'));
    }

    public function destroy(ProfilLulusan $id_pl)
    {
        $id_pl->delete();
        return redirect()->route('tim.profillulusan.index')->with('sukses','Profil Lulusan Berhasil Dihapus');
    }
}
