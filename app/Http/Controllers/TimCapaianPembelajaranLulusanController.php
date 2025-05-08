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
        $user = Auth::user();

        if (!$user || !$user->kode_prodi) {
            abort(403);
        }
        $kodeProdi = $user->kode_prodi;

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
        $user = Auth::guard('userprodi')->user();

        if (!$user || !$user->kode_prodi) {
            abort(403, 'Akses ditolak');
        }

        $prodiId = $user->kode_prodi;
        
        $profilLulusans = ProfilLulusan::where('kode_prodi', $prodiId)->get();
        
        return view('tim.capaianpembelajaranlulusan.create', compact('profilLulusans'));
    }

    public function store(Request $request)
    {
        $user = Auth::guard('userprodi')->user();

        if (!$user || !$user->kode_prodi) {
            abort(404);
        }

        $request->merge(['kode_prodi' => $user->kode_prodi]);

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
        $user = Auth::guard('userprodi')->user();

        if (!$user || !$user->kode_prodi) {
            abort(403, 'Akses ditolak');
        }

        $selectedProfilLulusans = DB::table('cpl_pl')
        ->join('profil_lulusans', 'cpl_pl.id_pl', '=', 'profil_lulusans.id_pl')
        ->where('cpl_pl.id_cpl', $id_cpl)
        ->where('profil_lulusans.kode_prodi', $user->kode_prodi)
        ->pluck('cpl_pl.id_pl')
        ->toArray();

        if (empty($selectedProfilLulusans)) {
            abort(403, 'Akses ditolak');
        }
    
        $capaianpembelajaranlulusan = CapaianProfilLulusan::findOrFail($id_cpl);
    
        $profilLulusans = ProfilLulusan::where('kode_prodi', $user->kode_prodi)->get();
        
        return view('tim.capaianpembelajaranlulusan.edit', compact('capaianpembelajaranlulusan', 'profilLulusans', 'selectedProfilLulusans'));
    }

    public function update(Request $request, $id_cpl)
    {
        $user = Auth::guard('userprodi')->user();

        if (!$user || !$user->kode_prodi) {
            abort(403, 'Akses ditolak');
        }

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
        $user = Auth::guard('userprodi')->user();

        if (!$user || !$user->kode_prodi) {
            abort(403, 'Akses ditolak');
        }

        $selectedProfilLulusans = DB::table('cpl_pl')
        ->where('id_cpl', $id_cpl->id_cpl)
        ->pluck('id_pl')
        ->toArray();

    $profilLulusans = ProfilLulusan::whereIn('id_pl', $selectedProfilLulusans)->get();

        if (empty($selectedProfilLulusans)) {
            abort(403, 'Akses ditolak');
        }
        
        return view('tim.capaianpembelajaranlulusan.detail', compact('id_cpl', 'selectedProfilLulusans', 'profilLulusans'));
    }

    public function destroy(CapaianProfilLulusan $id_cpl)
    {
        $id_cpl->delete();
        return redirect()->route('tim.capaianpembelajaranlulusan.index')->with('success', 'Capaian Pembelajaran lulusan berhasil dihapus.');
    }
}
