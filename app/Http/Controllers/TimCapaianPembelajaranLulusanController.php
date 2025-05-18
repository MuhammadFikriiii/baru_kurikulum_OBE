<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\CapaianProfilLulusan;
use App\Models\ProfilLulusan;
use App\Models\UserProdi;

class TimCapaianPembelajaranLulusanController extends Controller
{
    public function index()
    {
        $kodeProdi = Auth::user()->kode_prodi;

        $capaianpembelajaranlulusans = DB::table('capaian_profil_lulusans')
            ->leftJoin('cpl_pl', 'capaian_profil_lulusans.id_cpl', '=', 'cpl_pl.id_cpl')
            ->leftJoin('profil_lulusans', 'cpl_pl.id_pl', '=', 'profil_lulusans.id_pl')
            ->leftJoin('prodis', 'profil_lulusans.kode_prodi', '=', 'prodis.kode_prodi')
            ->where('profil_lulusans.kode_prodi', $kodeProdi)
            ->select('capaian_profil_lulusans.id_cpl', 'capaian_profil_lulusans.deskripsi_cpl','capaian_profil_lulusans.kode_cpl', 'capaian_profil_lulusans.status_cpl', 'prodis.nama_prodi')
            ->groupBy('capaian_profil_lulusans.id_cpl', 'capaian_profil_lulusans.deskripsi_cpl', 'capaian_profil_lulusans.kode_cpl', 'capaian_profil_lulusans.status_cpl', 'prodis.nama_prodi')
            ->get();

        return view("tim.capaianpembelajaranlulusan.index", compact("capaianpembelajaranlulusans"));
    }

    public function create()
    {

        $prodiId =  Auth::user()->kode_prodi;
        
        $profilLulusans = ProfilLulusan::where('kode_prodi', $prodiId)->get();
        
        return view('tim.capaianpembelajaranlulusan.create', compact('profilLulusans'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'kode_cpl'=> 'required|string|max:10',
            'deskripsi_cpl'=> 'required',
            'status_cpl'=>'required|in:Kompetensi Utama Bidang,Kompetensi Tambahan',
            'id_pls' => 'required|array'
        ]);
        
        $cpl = CapaianProfilLulusan::create($request->only(['kode_cpl', 'deskripsi_cpl', 'status_cpl']));

        foreach ($request->id_pls as $id_pl) {
            DB::table('cpl_pl')->insert([
                'id_cpl' => $cpl->id_cpl,
                'id_pl' => $id_pl
            ]);
        }
        
        return redirect()->route('tim.capaianpembelajaranlulusan.index')->with('success', 'Capaian Profil lulusan berhasil ditambahkan.',);
    }

    public function edit($id_cpl)
    {
        $kodeProdi = Auth::user()->kode_prodi;

        $selectedProfilLulusans = DB::table('cpl_pl')
        ->join('profil_lulusans', 'cpl_pl.id_pl', '=', 'profil_lulusans.id_pl')
        ->where('cpl_pl.id_cpl', $id_cpl)
        ->where('profil_lulusans.kode_prodi', Auth::user()->kode_prodi)
        ->pluck('cpl_pl.id_pl')
        ->toArray();

        $capaianpembelajaranlulusan = DB::table('capaian_profil_lulusans as cpl')
        ->leftJoin('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
        ->leftJoin('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
        ->where('cpl.id_cpl', $id_cpl)
        ->where('pl.kode_prodi', $kodeProdi)
        ->select('cpl.id_cpl', 'cpl.kode_cpl', 'cpl.deskripsi_cpl', 'cpl.status_cpl')
        ->distinct()
        ->first();
        if (!$capaianpembelajaranlulusan){
            abort(403, 'akses ditolak');
        }
        $profilLulusans = ProfilLulusan::where('kode_prodi', Auth::user()->kode_prodi)->get();
        
        return view('tim.capaianpembelajaranlulusan.edit', compact('capaianpembelajaranlulusan', 'profilLulusans', 'selectedProfilLulusans'));
    }

    public function update(Request $request, $id_cpl)
    {
        request()->validate([
            'kode_cpl'=> 'required|string|max:10',
            'deskripsi_cpl'=> 'required',
            'status_cpl'=>'required|in:Kompetensi Utama Bidang,Kompetensi Tambahan'
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
        return redirect()->route('tim.capaianpembelajaranlulusan.index')->with('success', 'Capaian Profil lulusan berhasil diperbarui.');
    }

    public function detail(CapaianProfilLulusan $id_cpl)
    {
        $kodeProdi = Auth::user()->kode_prodi;

        $selectedProfilLulusans = DB::table('cpl_pl')
        ->where('id_cpl', $id_cpl->id_cpl)
        ->pluck('id_pl')
        ->toArray();

        $capaianpembelajaranlulusan = DB::table('capaian_profil_lulusans as cpl')
        ->leftJoin('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
        ->leftJoin('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
        ->where('cpl.id_cpl', $id_cpl->id_cpl)
        ->where('pl.kode_prodi', $kodeProdi)
        ->first();
        if (!$capaianpembelajaranlulusan){
            abort(403, 'akses ditolak');
        }
    $profilLulusans = ProfilLulusan::whereIn('id_pl', $selectedProfilLulusans)->get();
        
        return view('tim.capaianpembelajaranlulusan.detail', compact('id_cpl', 'selectedProfilLulusans', 'profilLulusans'));
    }

    public function destroy(CapaianProfilLulusan $id_cpl)
    {
        $id_cpl->delete();
        return redirect()->route('tim.capaianpembelajaranlulusan.index')->with('sukses', 'Capaian Pembelajaran lulusan berhasil dihapus.');
    }

    public function pemenuhan_cpl()
    {
        $kodeProdi = Auth::user()->kode_prodi;

        $cpls = DB::table('capaian_profil_lulusans as cpl')
        ->join('cpl_pl as cplpl', 'cpl.id_cpl', '=', 'cplpl.id_cpl')
        ->join('profil_lulusans as pl', 'cplpl.id_pl', '=', 'pl.id_pl')
        ->join('prodis as ps', 'pl.kode_prodi', '=', 'ps.kode_prodi')
        ->leftJoin('cpl_mk as cmk', 'cpl.id_cpl', '=', 'cmk.id_cpl')
        ->leftJoin('mata_kuliahs as mk', 'cmk.kode_mk', '=', 'mk.kode_mk')
        ->where('ps.kode_prodi', $kodeProdi)
        ->select('cpl.id_cpl','cpl.kode_cpl', 'deskripsi_cpl', 'ps.nama_prodi', 'mk.semester_mk', 'mk.kode_mk','mk.nama_mk', 'ps.kode_prodi')
        ->distinct();

        $data = $cpls
            ->orderBy('cpl.kode_cpl', 'asc')
            ->orderBy('mk.semester_mk', 'asc')
            ->get();

            $petaCPL = [];

            foreach ($data as $row) {
                $semester = 'Semester ' . $row->semester_mk;
                $namamk = $row->nama_mk;
            
                $petaCPL[$row->id_cpl]['label'] = $row->kode_cpl; // yang ditampilkan
                $petaCPL[$row->id_cpl]['deskripsi_cpl'] = $row->deskripsi_cpl; // yang ditampilkan
                $petaCPL[$row->id_cpl]['prodi'] = $row->nama_prodi; // yang ditampilkan
                $petaCPL[$row->id_cpl]['semester'][$semester][] = $namamk; // pengelompokan tetap pakai id
            }        
            return view('tim.pemenuhancpl.index', compact('petaCPL'));
    }
}
