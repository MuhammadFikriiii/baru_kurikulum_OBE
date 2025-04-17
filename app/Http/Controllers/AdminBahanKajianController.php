<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BahanKajian;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class AdminBahanKajianController extends Controller
{
    public function index()
    {
        $bahankajians = BahanKajian::all();
        return view('admin.bahankajian.index', compact('bahankajians'));
    }

    public function create()
    {
        $capaianProfilLulusans = DB::table('capaian_profil_lulusans')->get();
        return view('admin.bahankajian.create', compact('capaianProfilLulusans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_bk' => 'required|string|max:10',
            'nama_bk' => 'required|string|max:50',
            'deskripsi_bk' => 'nullable|string',
            'referensi_bk' => 'required|string|max:50',
            'status_bk' => 'required|in:core,elective',
            'knowledge_area' => 'required|string',
        ]);

        $bk = BahanKajian::create($request->only(['kode_bk', 'nama_bk', 'deskripsi_bk', 'referensi_bk', 'status_bk', 'knowledge_area']));

        foreach ($request->id_cpls as $id_cpl) {
            DB::table('cpl_bk')->insert([
                'id_bk' => $bk->id_bk,
                'id_cpl' => $id_cpl
            ]);
        }
        return redirect()->route('admin.bahankajian.index')->with('success', 'Bahan Kajian berhasil diperbaharui.');
    }

    public function edit($id_bk)
    {
        $bahankajian = BahanKajian::findOrFail($id_bk);
        return view('admin.bahankajian.edit', compact('bahankajian'));
    }

    public function update(Request $request, $id_bk)
    {
        request()->validate([
            'kode_bk' => 'required|string|max:10',
            'nama_bk' => 'required|string|max:50',
            'deskripsi_bk' => 'nullable|string',
            'referensi_bk' => 'required|string|max:50',
            'status_bk' => 'required|in:core,elective',
            'knowledge_area' => 'required|string',
        ]);
        $bahankajian = BahanKajian::findOrFail($id_bk);
        $bahankajian->update($request->all());
        return redirect()->route('admin.bahankajian.index')->with('success', 'Bahan Kajian berhasil diperbaharui.');
    }

    public function destroy($id_bk)
    {
        $id_bk = BahanKajian::findOrFail($id_bk);
        $id_bk->delete();
        return redirect()->route('admin.bahankajian.index')->with('sukses','Bahan Kajian Berhasil Di Hapus');
    }
}
