<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class AdminMataKuliahController extends Controller
{
    public function index()
    {
        $mata_kuliahs = MataKuliah::all();
        $semesters = $mata_kuliahs->pluck('semester_mk')->unique()->sort()->values();

        return view("admin.matakuliah.index", compact("mata_kuliahs", "semesters"));
    }

    public function create()
    {
        $capaianProfilLulusans = DB::table('capaian_profil_lulusans')->get();
        return view("admin.matakuliah.create",  compact("capaianProfilLulusans"));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_mk'=> 'required|string|max:10|unique:mata_kuliahs,kode_mk',
            'nama_mk'=> 'required|string|max:50',
            'jenis_mk'=> 'required|string|max:50',
            'sks_mk'=> 'required|integer',
            'semester_mk'=> 'required|integer|in:1,2,3,4,5,6,7,8',
            'kompetensi_mk'=> 'required|string|in:pendukung,utama',
        ]);
        $mk = MataKuliah::create($request->only(['kode_mk', 'nama_mk', 'jenis_mk', 'sks_mk', 'semester_mk', 'kompetensi_mk']));

        foreach ($request->id_cpls as $id_cpl) {
            DB::table('cpl_mk')->insert([
                'kode_mk' => $mk->kode_mk,
                'id_cpl' => $id_cpl
            ]);
        }
        return redirect()->route('admin.matakuliah.index')->with('success', 'Mata kuliah berhasil ditambahkan!');
    }

    public function edit(MataKuliah $matakuliah)
    {
        return view("admin.matakuliah.edit", compact('matakuliah'));
    }

    public function update(Request $request, MataKuliah  $matakuliah)
    {
        request()->validate([
            'kode_mk'=>['required','string','max:10',Rule::unique('mata_kuliahs','kode_mk')->ignore($matakuliah->kode_mk,'kode_mk')],
            'nama_mk'=> 'required|string|max:50',
            'jenis_mk'=> 'required|string|max:50',
            'sks_mk'=> 'required|integer',
            'semester_mk'=> 'required|integer|in:1,2,3,4,5,6,7,8',
            'kompetensi_mk'=> 'required|string|in:pendukung,utama',
        ]);
        $matakuliah->update($request->all());
        return redirect()->route('admin.matakuliah.index')->with('success', 'matakuliah berhasil diperbaharui');
    }

    public function destroy(MataKuliah $matakuliah)
    {
        $matakuliah->delete();
        return redirect()->route('admin.matakuliah.index')->with('sukses', 'matakuliah berhasil dihapus');
    }
    
}