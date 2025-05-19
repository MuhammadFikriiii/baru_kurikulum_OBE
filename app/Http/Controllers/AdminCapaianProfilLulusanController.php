<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CapaianProfilLulusan;
use App\Models\ProfilLulusan;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class AdminCapaianProfilLulusanController extends Controller
{
    public function index(Request $request)
    {
        $kode_prodi = $request->get('kode_prodi');
        $prodis = DB::table('prodis')->get();
        
        if (!$kode_prodi) {
            return view("admin.capaianprofillulusan.index", compact("prodis", "kode_prodi"));
        }

        $query = DB::table('capaian_profil_lulusans')
            ->leftJoin('cpl_pl', 'capaian_profil_lulusans.id_cpl', '=', 'cpl_pl.id_cpl')
            ->leftJoin('profil_lulusans', 'cpl_pl.id_pl', '=', 'profil_lulusans.id_pl')
            ->leftJoin('prodis', 'profil_lulusans.kode_prodi', '=', 'prodis.kode_prodi')
            ->select('capaian_profil_lulusans.id_cpl', 'capaian_profil_lulusans.deskripsi_cpl', 'capaian_profil_lulusans.kode_cpl', 'capaian_profil_lulusans.status_cpl', 'prodis.nama_prodi')
            ->groupBy('capaian_profil_lulusans.id_cpl', 'capaian_profil_lulusans.deskripsi_cpl', 'capaian_profil_lulusans.kode_cpl', 'capaian_profil_lulusans.status_cpl', 'prodis.nama_prodi')
            ->orderBy('kode_cpl', 'asc');

        if ($kode_prodi) {
            $query->where('prodis.kode_prodi', $kode_prodi);
        }

        $capaianprofillulusans = $query->get();

        $dataKosong = $capaianprofillulusans->isEmpty() && $kode_prodi;

        return view("admin.capaianprofillulusan.index", compact("capaianprofillulusans", "prodis", "kode_prodi", "dataKosong"));
    }


    public function create()
    {
        $profilLulusans = DB::table('profil_lulusans')
        ->join('prodis', 'profil_lulusans.kode_prodi', '=', 'prodis.kode_prodi')
        ->select('profil_lulusans.id_pl', 'profil_lulusans.kode_pl', 'profil_lulusans.deskripsi_pl', 'prodis.nama_prodi')
        ->orderBy('prodis.nama_prodi')
        ->get();
        return view("admin.capaianprofillulusan.create", compact("profilLulusans"));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_cpl'=> 'required|string|max:10',
            'deskripsi_cpl'=> 'required',
            'status_cpl'=> 'required|in:Kompetensi Utama Bidang,Kompetensi Tambahan',
            'id_pls' => 'required|array'
        ]);

        $cpl = CapaianProfilLulusan::create($request->only(['kode_cpl', 'deskripsi_cpl', 'status_cpl']));

        foreach ($request->id_pls as $id_pl) {
            DB::table('cpl_pl')->insert([
                'id_cpl' => $cpl->id_cpl,
                'id_pl' => $id_pl
            ]);
        }

        return redirect()->route('admin.capaianprofillulusan.index')->with('success', 'Capaian Profil lulusan berhasil ditambahkan.');
    }


    public function edit($id_cpl)
    {
        $capaianprofillulusan = CapaianProfilLulusan::findOrFail($id_cpl);

        $profilLulusans = ProfilLulusan::all();
        $selectedProfilLulusans = DB::table('cpl_pl')
            ->where('id_cpl', $id_cpl)
            ->pluck('id_pl')
            ->toArray();
        return view('admin.capaianprofillulusan.edit' , compact('capaianprofillulusan', 'profilLulusans', 'selectedProfilLulusans'));
    }

    public function update(Request $request, $id_cpl)
    {
        request()->validate([
            'kode_cpl'=> 'required|string|max:10',
            'deskripsi_cpl'=> 'required',
            'status_cpl'=> 'required|in:Kompetensi Utama Bidang,Kompetensi Tambahan'
        ]);

        $capaianprofillulusan = CapaianProfilLulusan::findOrFail($id_cpl);

        $capaianprofillulusan->update($request->all());

        DB::table('cpl_pl')->where('id_cpl', $id_cpl)->delete();

        if ($request->has('id_pls')) {
            foreach ($request->id_pls as $id_pl) {
                DB::table('cpl_pl')->insert([
                    'id_cpl' => $id_cpl,
                    'id_pl' => $id_pl
                ]);
            }
        }
        return redirect()->route('admin.capaianprofillulusan.index')->with('success', 'Capaian Profil lulusan berhasil diperbaharui.');
    }

    public function detail(CapaianProfilLulusan $id_cpl)
    {
        $selectedPlIds = DB::table('cpl_pl')
        ->where('id_cpl', $id_cpl->id_cpl)
        ->pluck('id_pl')
        ->toArray();

    $profilLulusans = ProfilLulusan::whereIn('id_pl', $selectedPlIds)->get();

    return view('admin.capaianprofillulusan.detail', [
        'id_cpl' => $id_cpl,
        'selectedProfilLulusans' => $selectedPlIds,
        'profilLulusans' => $profilLulusans
    ]);
    }

    public function destroy(CapaianProfilLulusan $id_cpl)
    {
        $id_cpl->delete();
        return redirect()->route('admin.capaianprofillulusan.index')->with('sukses','Capaian Profil Lulusan Ini Berhasil Di Hapus');
    }

    public function peta_pemenuhan_cpl(Request $request)
    {
        $kode_prodi = $request->get('kode_prodi', 'all');

        $query = DB::table('capaian_profil_lulusans as cpl')
        ->join('cpl_pl as cplpl', 'cpl.id_cpl', '=', 'cplpl.id_cpl')
        ->join('profil_lulusans as pl', 'cplpl.id_pl', '=', 'pl.id_pl')
        ->join('prodis as ps', 'pl.kode_prodi', '=', 'ps.kode_prodi')
        ->leftJoin('cpl_mk as cmk', 'cpl.id_cpl', '=', 'cmk.id_cpl')
        ->leftJoin('mata_kuliahs as mk', 'cmk.kode_mk', '=', 'mk.kode_mk')
        ->select('cpl.id_cpl','cpl.kode_cpl', 'mk.semester_mk', 'mk.kode_mk','mk.nama_mk', 'ps.kode_prodi')
        ->distinct();


        if ($kode_prodi !== 'all') {
            $query->where('ps.kode_prodi', $kode_prodi);
        }

        $data = $query
            ->orderBy('cpl.kode_cpl', 'asc')
            ->orderBy('mk.semester_mk', 'asc')
            ->get();

            $petaCPL = [];

            foreach ($data as $row) {
                $semester = 'Semester ' . $row->semester_mk;
                $namamk = $row->nama_mk;
            
                $petaCPL[$row->id_cpl]['label'] = $row->kode_cpl; // yang ditampilkan
                $petaCPL[$row->id_cpl]['semester'][$semester][] = $namamk; // pengelompokan tetap pakai id
            }        

        $prodis = DB::table('prodis')->get();

        return view('admin.pemenuhancpl.index', compact('petaCPL', 'prodis', 'kode_prodi'));
    }
}