<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CapaianProfilLulusan;
use App\Models\ProfilLulusan;
use App\Models\Prodi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class AdminPemetaanCplPlController extends Controller
{
    public function index(Request $request)
    {
        $kode_prodi = $request->get('kode_prodi');

        $prodis = Prodi::all();

        $pls = ProfilLulusan::when($kode_prodi, function ($query) use ($kode_prodi) {
            $query->where('kode_prodi', $kode_prodi);
        })
        ->get();

        $plIds = $pls->pluck('id_pl');

        if ($plIds->isNotEmpty()) {
            $cplIds = DB::table('cpl_pl')
                ->whereIn('id_pl', $plIds)
                ->pluck('id_cpl')
                ->unique();

            $cpls = CapaianProfilLulusan::whereIn('id_cpl', $cplIds)->orderBy('id_cpl', 'asc')->get();
        } else {
            $cpls = collect();
        }
        $relasi = DB::table('cpl_pl')
            ->whereIn('id_pl', $plIds)
            ->orderBy('id_pl', 'asc')
            ->get()
            ->groupBy('id_pl');

            if (empty($kode_prodi)) {
                $pls = collect(); // Jika prodi belum dipilih, tampilkan data kosong
                $cpls = collect(); // Kosongkan data CPL
            }

        $prodiByCpl = DB::table('cpl_pl')
            ->join('profil_lulusans', 'cpl_pl.id_pl', '=', 'profil_lulusans.id_pl')
            ->join('prodis', 'profil_lulusans.kode_prodi', '=', 'prodis.kode_prodi')
            ->select('cpl_pl.id_cpl', 'prodis.nama_prodi')
            ->get()
            ->groupBy('id_cpl')
            ->map(function ($items) {
                return $items->first()->nama_prodi ?? '-';
            })
            ;
            
        return view('admin.pemetaancplpl.index', compact('cpls', 'pls', 'relasi', 'kode_prodi', 'prodis', 'prodiByCpl'));
    }
}
