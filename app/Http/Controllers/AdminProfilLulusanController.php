<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfilLulusan;
use App\Models\Prodi;
use Illuminate\Validation\Rule;
use App\Models\Tahun;

class AdminProfilLulusanController extends Controller
{
    public function index(Request $request)
    {
        $kode_prodi = $request->get('kode_prodi');
        $id_tahun = $request->get('id_tahun');
        $prodis = Prodi::all();

        // Ambil tahun-tahun yang tersedia dari tabel tahun
        $tahun_tersedia = \App\Models\Tahun::orderBy('tahun', 'desc')->get();

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

        return view('admin.profillulusan.index', compact('profillulusans', 'prodis', 'kode_prodi', 'id_tahun', 'tahun_tersedia'));
    }

    public function create()
    {
        $prodis = Prodi::all();
        $tahuns = Tahun::all();
        return view('admin.profillulusan.create', compact('prodis', 'tahuns'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_tahun' => 'required|exists:tahun,id_tahun',
            'kode_pl' => 'required|string|max:10|',
            'kode_prodi' => 'required|string|max:10',
            'deskripsi_pl' => 'required',
            'profesi_pl' => 'required',
            'unsur_pl' => 'required|in:Pengetahuan,Keterampilan Khusus,Sikap dan Keterampilan Umum',
            'keterangan_pl' => 'required|in:Kompetensi Utama Bidang,Kompetensi Tambahan',
            'sumber_pl' => 'required',
        ]);
        ProfilLulusan::create($request->all());
        return redirect()->route('admin.profillulusan.index')->with('success', 'Profil lulusan berhasil ditambahkan.');
    }

    public function edit($id_pl)
    {
        $prodis = Prodi::all();
        $tahuns = Tahun::all();
        $profillulusan = ProfilLulusan::findOrFail($id_pl);
        return view('admin.profillulusan.edit', compact('profillulusan', 'prodis', 'tahuns'));
    }

    public function update(Request $request, $id_pl)
    {
        $request->validate([
            'id_tahun' => 'required|exists:tahun,id_tahun',
            'kode_pl' => 'required|string|max:10',
            'kode_prodi' => 'required|string|max:10',
            'deskripsi_pl' => 'required',
            'profesi_pl' => 'required',
            'unsur_pl' => 'required|in:Pengetahuan,Keterampilan Khusus,Sikap dan Keterampilan Umum',
            'keterangan_pl' => 'required|in:Kompetensi Utama Bidang,Kompetensi Tambahan',
            'sumber_pl' => 'required',
        ]);

        $profillulusan = ProfilLulusan::findOrFail($id_pl);
        $profillulusan->update($request->all());
        return redirect()->route('admin.profillulusan.index')->with('success', 'Profil Lulusan berhasil diperbarui.');
    }

    public function detail(ProfilLulusan $id_pl)
    {
        return view('admin.profillulusan.detail', compact('id_pl'));
    }

    public function destroy(ProfilLulusan $id_pl)
    {
        $id_pl->delete();
        return redirect()->route('admin.profillulusan.index')->with('sukses', 'Profil Lulusan Berhasil Dihapus');
    }
}
