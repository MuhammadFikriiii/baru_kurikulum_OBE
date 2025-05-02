<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
            'kode_jurusan' => 'nullable|string|exists:jurusans,kode_jurusan',
            'nama_prodi' => 'required|string|max:100',
            'fakultas_prodi' => 'required|string|max:100',
            'pt_prodi' => 'required|string|max:100',
            'tgl_berdiri_prodi' => 'required|date',
            'penyelenggaraan_prodi' => 'required|date',
            'nomor_sk' => 'required|string',
            'tanggal_sk' => 'required|date',
            'peringkat_akreditasi' => 'required|string',
            'nomor_sk_banpt' => 'required|string',
            'jenjang_pendidikan' => 'required|string',
            'gelar_lulusan' => 'required|string',
            'alamat_prodi' => 'required|string',
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
            'kode_jurusan' => 'nullable|string|exists:jurusans,kode_jurusan',
            'nama_prodi' => 'required|string|max:100',
            'fakultas_prodi' => 'required|string|max:100',
            'pt_prodi' => 'required|string|max:100',
            'tgl_berdiri_prodi' => 'required|date',
            'penyelenggaraan_prodi' => 'required|date',
            'nomor_sk' => 'required|string',
            'tanggal_sk' => 'required|date',
            'peringkat_akreditasi' => 'required|string',
            'nomor_sk_banpt' => 'required|string',
            'jenjang_pendidikan' => 'required|string',
            'gelar_lulusan' => 'required|string',
            'alamat_prodi' => 'required|string',
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

    public function destroy(Prodi $prodi)
    {
        $prodi->delete();
        return redirect()->route('admin.prodi.index')->with('sukses', 'Prodi berhasil dihapus.');
    }
}