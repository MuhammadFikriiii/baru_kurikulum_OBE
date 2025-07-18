<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\ProfilLulusan;
use App\Models\CapaianProfilLulusan;
use Illuminate\Support\Facades\DB;

class AdminProdiController extends Controller
{
    public function index()
    {
        $prodis = Prodi::with('jurusan')->get();
        return view('admin.prodi.index', compact('prodis'));
    }

    public function create()
    {
        $jurusans = Jurusan::all();
        return view('admin.prodi.create', compact('jurusans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_prodi' => 'required|string|max:10|unique:prodis,kode_prodi',
            'id_jurusan' => 'required|exists:jurusans,id_jurusan',
            'nama_prodi' => 'required|string|max:100',
            'visi_prodi' => 'required|string',
            'nama_kaprodi' => 'required|string|max:50',
            'tgl_berdiri_prodi' => 'required|date',
            'penyelenggaraan_prodi' => 'required|date',
            'nomor_sk' => 'required|string',
            'tanggal_sk' => 'required|date',
            'peringkat_akreditasi' => ['required', Rule::in(['A', 'B', 'C'])],
            'nomor_sk_banpt' => 'required|string',
            'jenjang_pendidikan' => ['required', Rule::in(['D3', 'D4'])],
            'gelar_lulusan' => 'required|string',
            'telepon_prodi' => 'nullable|string',
            'faksimili_prodi' => 'nullable|string',
            'website_prodi' => 'nullable|string',
            'email_prodi' => 'nullable|email',
        ]);

        Prodi::create($request->all());
        return redirect()->route('admin.prodi.index')->with('success', 'Prodi berhasil ditambahkan.');
    }

    public function edit(Prodi $prodi)
    {
        $jurusans = Jurusan::all();
        return view('admin.prodi.edit', compact('prodi', 'jurusans'));
    }

    public function update(Request $request, Prodi $prodi)
    {
        $request->validate([
            'kode_prodi' => ['required', 'string', 'max:10', Rule::unique('prodis', 'kode_prodi')->ignore($prodi->kode_prodi, 'kode_prodi')],
            'id_jurusan' => 'required|exists:jurusans,id_jurusan',
            'nama_prodi' => 'required|string|max:100',
            'visi_prodi' => 'required|string',
            'nama_kaprodi' => 'required|string|max:50',
            'tgl_berdiri_prodi' => 'required|date',
            'penyelenggaraan_prodi' => 'required|date',
            'nomor_sk' => 'required|string',
            'tanggal_sk' => 'required|date',
            'peringkat_akreditasi' => ['required', Rule::in(['A', 'B', 'C'])],
            'nomor_sk_banpt' => 'required|string',
            'jenjang_pendidikan' => ['required', Rule::in(['D3', 'D4'])],
            'gelar_lulusan' => 'required|string',
            'telepon_prodi' => 'nullable|string',
            'faksimili_prodi' => 'nullable|string',
            'website_prodi' => 'nullable|string',
            'email_prodi' => 'nullable|email',
        ]);

        $prodi->update($request->all());
        return redirect()->route('admin.prodi.index')->with('success', 'Prodi berhasil diperbarui.');
    }

    public function detail(Prodi $prodi)
    {
        return view('admin.prodi.detail', compact('prodi'));
    }

    public function destroy($kode_prodi)
    {
        $plIds = DB::table('profil_lulusans')
            ->where('kode_prodi', $kode_prodi)
            ->pluck('id_pl');

        $cplIds = DB::table('cpl_pl')
            ->whereIn('id_pl', $plIds)
            ->pluck('id_cpl')
            ->unique();

        DB::table('cpl_pl')->whereIn('id_pl', $plIds)->delete();
        ProfilLulusan::whereIn('id_pl', $plIds)->delete();

        foreach ($cplIds as $id_cpl) {
            $stillHasRelation = DB::table('cpl_pl')->where('id_cpl', $id_cpl)->exists();
            if (!$stillHasRelation) {
                CapaianProfilLulusan::where('id_cpl', $id_cpl)->delete();
            }
        }

        DB::table('prodis')->where('kode_prodi', $kode_prodi)->delete();

        return redirect()->route('admin.prodi.index')->with('sukses', 'Prodi berhasil dihapus beserta data terkait.');
    }
}
