<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CapaianProfilLulusan;
use App\Models\ProfilLulusan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class AdminPemetaanCplPlController extends Controller
{
    public function index(Request $request)
    {
        $kode_prodi = $request->get('kode_prodi','null');

        $prodis = DB::table('prodis')->get();

        $pls = ProfilLulusan::when($kode_prodi && $kode_prodi !== 'all', function ($query) use ($kode_prodi) {
            $query->where('kode_prodi', $kode_prodi);
        })->get();

        $plIds = $pls->pluck('id_pl');

        if ($plIds->isNotEmpty()) {
            $cplIds = DB::table('cpl_pl')
                ->whereIn('id_pl', $plIds)
                ->pluck('id_cpl')
                ->unique();

            $cpls = CapaianProfilLulusan::whereIn('id_cpl', $cplIds)->get();
        } else {
            $cpls = collect();
        }
        $relasi = DB::table('cpl_pl')
            ->whereIn('id_pl', $plIds)
            ->get()
            ->groupBy('id_pl');

        return view('admin.pemetaancplpl.index', compact('cpls', 'pls', 'relasi', 'kode_prodi', 'prodis'));
    }
}
