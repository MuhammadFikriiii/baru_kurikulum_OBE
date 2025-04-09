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
            'kode_bk' => 'required|string|max:10|unique:bahan_kajians,kode_bk',
            'nama_bk' => 'required|string|max:50',
            'deskripsi_bk' => 'nullable|string',
            'referensi_bk' => 'required|string|max:50',
            'status_bk' => 'required|in:core,elective',
            'knowledge_area' => 'required|string',
            'max_bk' => 'integer|max:100|required',
            'min_bk' => 'integer|max:100|required',
        ]);
        BahanKajian::create($request->all());
        return redirect()->route('admin.bahankajian.index')->with('success', 'Bahan Kajian berhasil diperbaharui.');
    }

    public function edit(Bahankajian $bahankajian)
    {
        return view('admin.bahankajian.edit', compact('bahankajian'));
    }

    public function update(Request $request, BahanKajian $bahankajian)
    {
        request()->validate([
            'kode_bk' => ['required','string','max:10',Rule::unique('bahan_kajians','kode_bk')->ignore($bahankajian->kode_bk,'kode_bk')],
            'nama_bk' => 'required|string|max:50',
            'deskripsi_bk' => 'nullable|string',
            'referensi_bk' => 'required|string|max:50',
            'status_bk' => 'required|in:core,elective',
            'knowledge_area' => 'required|string',
            'max_bk' => 'integer|max:100|required',
            'min_bk' => 'integer|max:100|required',
        ]);
        $bahankajian->update($request->all());
        return redirect()->route('admin.bahankajian.index')->with('success', 'Bahan Kajian berhasil diperbaharui.');
    }

    public function destroy(BahanKajian $bahankajian)
    {
        $bahankajian->delete();
        return redirect()->route('admin.bahankajian.index')->with('sukses','Bahan Kajian Berhasil Di Hapus');
    }
}
