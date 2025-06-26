<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CapaianProfilLulusan;
use App\Models\ProfilLulusan;
use App\Models\Prodi;
use App\Models\Tahun;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminPemetaanCplPlController extends Controller
{
    public function index(Request $request)
    {
        $kode_prodi = $request->get('kode_prodi');
        $id_tahun = $request->get('id_tahun');

        $prodis = Prodi::all();

        // Ambil SEMUA tahun yang tersedia (tidak tergantung prodi)
        $tahun_tersedia = Tahun::orderBy('tahun', 'desc')->get();

        // Ambil PL berdasarkan prodi dan tahun
        $pls = ProfilLulusan::when($kode_prodi, function ($query) use ($kode_prodi) {
            $query->where('kode_prodi', $kode_prodi);
        })
            ->when($id_tahun, function ($query) use ($id_tahun) {
                $query->where('id_tahun', $id_tahun);
            })
            ->get();

        $plIds = $pls->pluck('id_pl');

        // Ambil CPL yang terkait dengan PL
        if ($plIds->isNotEmpty()) {
            $cplIds = DB::table('cpl_pl')
                ->whereIn('id_pl', $plIds)
                ->pluck('id_cpl')
                ->unique();

            $cpls = CapaianProfilLulusan::whereIn('id_cpl', $cplIds)->orderBy('kode_cpl', 'asc')->get();
        } else {
            $cpls = collect();
        }

        // Ambil relasi CPL-PL
        $relasi = DB::table('cpl_pl')
            ->whereIn('id_pl', $plIds)
            ->orderBy('id_pl', 'asc')
            ->get()
            ->groupBy('id_pl');

        // Jika prodi belum dipilih, kosongkan data
        if (empty($kode_prodi)) {
            $pls = collect();
            $cpls = collect();
        }

        // Mapping prodi berdasarkan CPL
        $prodiByCpl = DB::table('cpl_pl')
            ->join('profil_lulusans', 'cpl_pl.id_pl', '=', 'profil_lulusans.id_pl')
            ->join('prodis', 'profil_lulusans.kode_prodi', '=', 'prodis.kode_prodi')
            ->when($kode_prodi, function ($query) use ($kode_prodi) {
                $query->where('profil_lulusans.kode_prodi', $kode_prodi);
            })
            ->when($id_tahun, function ($query) use ($id_tahun) {
                $query->where('profil_lulusans.id_tahun', $id_tahun);
            })
            ->select('cpl_pl.id_cpl', 'prodis.nama_prodi')
            ->get()
            ->groupBy('id_cpl')
            ->map(function ($items) {
                return $items->first()->nama_prodi ?? '-';
            });

        return view('admin.pemetaancplpl.index', compact(
            'cpls',
            'pls',
            'relasi',
            'kode_prodi',
            'id_tahun',
            'prodis',
            'tahun_tersedia',
            'prodiByCpl'
        ));
    }
}
