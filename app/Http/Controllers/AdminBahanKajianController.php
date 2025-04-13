<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BahanKajian;
use Illuminate\Validation\Rule;

class AdminBahanKajianController extends Controller
{
    public function index()
    {
        $bahankajians = BahanKajian::all();
        return view('admin.bahankajian.index', compact('bahankajians'));
    }

    public function create()
    {
        return view('admin.bahankajian.create');
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
        BahanKajian::create($request->all());
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
