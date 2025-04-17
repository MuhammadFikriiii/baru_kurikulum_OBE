<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BahanKajian;
use App\Models\CapaianProfilLulusan;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class AdminBahanKajianController extends Controller
{
    public function index()
    {
        $bahankajians = DB::table('bahan_kajians as bk')
    ->leftJoin('cpl_bk', 'bk.id_bk', '=', 'cpl_bk.id_bk')
    ->leftJoin('capaian_profil_lulusans as cpl', 'cpl_bk.id_cpl', '=', 'cpl.id_cpl')
    ->leftJoin('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
    ->leftJoin('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
    ->leftJoin('prodis', 'pl.kode_prodi', '=', 'prodis.kode_prodi')
    ->select(
        'bk.id_bk','bk.nama_bk','bk.kode_bk','bk.deskripsi_bk','bk.referensi_bk','bk.status_bk','bk.knowledge_area',
        'cpl.id_cpl','cpl.kode_cpl','cpl.deskripsi_cpl',
        'pl.id_pl','pl.deskripsi_pl',
        'prodis.nama_prodi'
    )
    ->distinct()
    ->get();

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
        return redirect()->route('admin.bahankajian.index')->with('success', 'Bahan Kajian berhasil ditambahkan.');
    }

    public function edit($id_bk)
    {
        $bahankajian = BahanKajian::findOrFail($id_bk);

        $capaianprofillulusans = CapaianProfilLulusan::all();
        $selectedCapaianProfilLulusans = DB::table('cpl_bk')
            ->where('id_bk', $id_bk)
            ->pluck('id_cpl')
            ->toArray();
        return view('admin.bahankajian.edit', compact('bahankajian','capaianprofillulusans'));
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
        DB::table('cpl_bk')->where('id_bk', $id_bk)->delete();
        if ($request->has('id_cpls')) {
            foreach ($request->id_cpls as $id_cpl) {
                DB::table('cpl_bk')->insert([
                    'id_bk' => $id_bk,
                    'id_cpl' => $id_cpl
                ]);
            }
        }
        return redirect()->route('admin.bahankajian.index')->with('success', 'Bahan Kajian berhasil diperbaharui.');
    }

    public function destroy($id_bk)
    {
        $id_bk = BahanKajian::findOrFail($id_bk);
        $id_bk->delete();
        return redirect()->route('admin.bahankajian.index')->with('sukses','Bahan Kajian Berhasil Di Hapus');
    }
}
