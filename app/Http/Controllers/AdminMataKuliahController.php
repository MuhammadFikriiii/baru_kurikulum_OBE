<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\CapaianProfilLulusan;
use App\Models\BahanKajian;

class AdminMataKuliahController extends Controller
{
    public function index(Request $request)
    {
        $kode_prodi = $request->get('kode_prodi');
        $prodis = DB::table('prodis')->get();

        $query = DB::table('mata_kuliahs as mk')
            ->select(
                'mk.kode_mk', 'mk.nama_mk', 'mk.jenis_mk', 'mk.sks_mk',
                'mk.semester_mk', 'mk.kompetensi_mk', 'prodis.nama_prodi'
            )
            ->leftJoin('cpl_mk', 'mk.kode_mk', '=', 'cpl_mk.kode_mk')
            ->leftJoin('capaian_profil_lulusans as cpl', 'cpl_mk.id_cpl', '=', 'cpl.id_cpl')
            ->leftJoin('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->leftJoin('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->leftJoin('prodis', 'pl.kode_prodi', '=', 'prodis.kode_prodi')
            ->groupBy('mk.kode_mk', 'mk.nama_mk', 'mk.jenis_mk', 'mk.sks_mk', 'mk.semester_mk', 'mk.kompetensi_mk', 'prodis.nama_prodi');

            if ($kode_prodi && $kode_prodi !== 'all') {
                $query->where('prodis.kode_prodi', $kode_prodi);
                $mata_kuliahs = $query->get();
            }
            $mata_kuliahs = $query->get();

        return view("admin.matakuliah.index", compact("mata_kuliahs", 'kode_prodi', 'prodis'));
    }


    public function create()
    {
        $capaianProfilLulusans = CapaianProfilLulusan::orderBy('kode_cpl', 'asc')->get();

        $bahanKajians = DB::table('bahan_kajians')->get();
        return view("admin.matakuliah.create",  compact("capaianProfilLulusans", "bahanKajians"));
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

        foreach ($request->id_bks as $id_bk) {
            DB::table('bk_mk')->insert([
                'kode_mk' => $mk->kode_mk,
                'id_bk' => $id_bk
            ]);
        }
        return redirect()->route('admin.matakuliah.index')->with('success', 'Mata kuliah berhasil ditambahkan!');
    }

    public function edit(MataKuliah $matakuliah)
    { 
    // return view("admin.matakuliah.edit", compact('matakuliah'));
    $capaianProfilLulusans = CapaianProfilLulusan::orderBy('kode_cpl', 'asc')->get();
    $bahanKajians = DB::table('bahan_kajians')->get();
    
    return view("admin.matakuliah.edit", compact('matakuliah', 'capaianProfilLulusans', 'bahanKajians'));

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

    public function detail(MataKuliah $matakuliah)
    {
        $selectedCplIds = DB::table('cpl_mk')
            ->where('kode_mk', $matakuliah->kode_mk)
            ->pluck('id_cpl')
            ->toArray();

            $capaianprofillulusans = CapaianProfilLulusan::whereIn('id_cpl', $selectedCplIds)->get();

        $selectedBksIds = DB::table('bk_mk')
            ->where('kode_mk', $matakuliah->kode_mk)
            ->pluck('id_bk')
            ->toArray();
            $bahanKajians = BahanKajian::whereIn('id_bk', $selectedBksIds)->get();

        return view('admin.matakuliah.detail',['matakuliah'=>$matakuliah, 'selectedCplIds' =>$selectedCplIds, 'selectedBksIds'=>$selectedBksIds, 'capaianprofillulusans'=>$capaianprofillulusans,  'bahanKajians'=>$bahanKajians]);
    }

    public function destroy(MataKuliah $matakuliah)
    {
        $matakuliah->delete();
        return redirect()->route('admin.matakuliah.index')->with('sukses', 'matakuliah berhasil dihapus');
    }
    
    public function organisasi_mk(Request $request)
    {
        $prodis = DB::table('prodis')->get();
        
        $kode_prodi = $request->input('kode_prodi', 'all');
        
        $query = DB::table('mata_kuliahs as mk')
            ->select(
                'mk.kode_mk', 'mk.nama_mk', 'mk.jenis_mk', 'mk.sks_mk', 
                'mk.semester_mk', 'mk.kompetensi_mk', 'prodis.nama_prodi', 'prodis.kode_prodi'
            )
            ->leftJoin('cpl_mk', 'mk.kode_mk', '=', 'cpl_mk.kode_mk')
            ->leftJoin('capaian_profil_lulusans as cpl', 'cpl_mk.id_cpl', '=', 'cpl.id_cpl')
            ->leftJoin('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->leftJoin('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->leftJoin('prodis', 'pl.kode_prodi', '=', 'prodis.kode_prodi')
            ->groupBy('mk.kode_mk', 'mk.nama_mk', 'mk.jenis_mk', 'mk.sks_mk', 
                    'mk.semester_mk', 'mk.kompetensi_mk', 'prodis.nama_prodi', 'prodis.kode_prodi');
        
        if ($kode_prodi != 'all') {
            $query->where('prodis.kode_prodi', $kode_prodi);
        }
        
        $matakuliah = $query->get();
        
        $organisasiMK = $matakuliah->groupBy('semester_mk')->map(function ($items, $semester_mk) {
            return [
                'semester_mk' => $semester_mk,
                'sks_mk' => $items->sum('sks_mk'),
                'jumlah_mk' => $items->count(),
                'nama_mk' => $items->pluck('nama_mk')->toArray(),
                'mata_kuliah' => $items,
            ];
        });
        
        return view('admin.matakuliah.organisasimk', compact('organisasiMK', 'prodis', 'kode_prodi'));
    }
}