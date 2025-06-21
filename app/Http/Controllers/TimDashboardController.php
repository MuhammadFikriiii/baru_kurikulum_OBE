<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TimDashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        if (!$user || !$user->kode_prodi) {
            abort(404);
        }

        $kodeProdi = $user->kode_prodi;

        $prodis = Prodi::with('profillulusans')
            ->where('kode_prodi', $kodeProdi)
            ->get();

        $prodicount = Prodi::count();

        $ProdiSelesai = 0;

        $ProdiProgress = 0;

        $ProdiBelumMulai = 0;

        foreach ($prodis as $prodi) {
            $plIds = $prodi->profillulusans->pluck('id_pl')->toArray();

            $prodi->pl_count = count($plIds);

            $prodi->cpl_count = DB::table('cpl_pl')
                ->whereIn('id_pl', $plIds)
                ->distinct()
                ->count('id_cpl');

            $prodi->bk_count = DB::table('cpl_bk')
                ->join('capaian_profil_lulusans', 'cpl_bk.id_cpl', '=', 'capaian_profil_lulusans.id_cpl')
                ->join('cpl_pl', 'capaian_profil_lulusans.id_cpl', '=', 'cpl_pl.id_cpl')
                ->whereIn('cpl_pl.id_pl', $plIds)
                ->distinct()
                ->count('cpl_bk.id_bk');

            $prodi->sks_mk = DB::table('mata_kuliahs')
                ->whereIn('kode_mk', function ($query) use ($plIds) {
                    $query->select('cpl_mk.kode_mk')
                        ->from('cpl_mk')
                        ->join('capaian_profil_lulusans', 'cpl_mk.id_cpl', '=', 'capaian_profil_lulusans.id_cpl')
                        ->join('cpl_pl', 'capaian_profil_lulusans.id_cpl', '=', 'cpl_pl.id_cpl')
                        ->whereIn('cpl_pl.id_pl', $plIds)
                        ->distinct();
                })
                ->sum('sks_mk');

            $prodi->cpmk_count = DB::table('cpl_cpmk')
                ->join('capaian_profil_lulusans', 'cpl_cpmk.id_cpl', '=', 'capaian_profil_lulusans.id_cpl')
                ->join('cpl_pl', 'capaian_profil_lulusans.id_cpl', '=', 'cpl_pl.id_cpl')
                ->whereIn('cpl_pl.id_pl', $plIds)
                ->distinct()
                ->count('cpl_cpmk.id_cpmk');

            $prodi->subcpmk_count = DB::table('sub_cpmks')
                ->join('cpl_cpmk', 'sub_cpmks.id_cpmk', '=', 'cpl_cpmk.id_cpmk')
                ->join('capaian_profil_lulusans', 'cpl_cpmk.id_cpl', '=', 'capaian_profil_lulusans.id_cpl')
                ->join('cpl_pl', 'capaian_profil_lulusans.id_cpl', '=', 'cpl_pl.id_cpl')
                ->whereIn('cpl_pl.id_pl', $plIds)
                ->distinct()
                ->count('sub_cpmks.id_sub_cpmk');

            $target_pl = 3;
            $target_cpl = 9;
            $target_bk = 8;
            $target_sks_mk = 108;
            $target_cpmk = 18;
            $target_subcpmk = 36;

            $progress_pl = $prodi->pl_count > 0 ? min(100, round(($prodi->pl_count / $target_pl) * 100)) : 0;

            $progress_cpl = $prodi->cpl_count > 0 ? min(100, round(($prodi->cpl_count / $target_cpl) * 100)) : 0;

            $progress_bk = $prodi->bk_count > 0 ? min(100, round(($prodi->bk_count / $target_bk) * 100)) : 0;

            $progress_sks_mk = $prodi->sks_mk > 0 ? min(100, round(($prodi->sks_mk / $target_sks_mk) * 100)) : 0;

            $progress_cpmk = $prodi->cpmk_count > 0 ? min(100, round(($prodi->cpmk_count / $target_cpmk) * 100)) : 0;

            $progress_subcpmk = $prodi->subcpmk_count > 0 ? min(100, round(($prodi->subcpmk_count / $target_subcpmk) * 100)) : 0;

            // Assign progress to prodi object
            $prodi->progress_pl = $progress_pl;
            $prodi->progress_cpl = $progress_cpl;
            $prodi->progress_bk = $progress_bk;
            $prodi->progress_sks_mk = $progress_sks_mk;
            $prodi->progress_cpmk = $progress_cpmk;
            $prodi->progress_subcpmk = $progress_subcpmk;

            $avg = round(($progress_pl + $progress_cpl + $progress_bk + $progress_sks_mk + $progress_cpmk + $progress_subcpmk) / 6);
            $prodi->avg_progress = $avg;

            if ($progress_pl == 100 && $progress_cpl == 100 && $progress_bk == 100 && $progress_sks_mk == 100 && $progress_cpmk == 100 && $progress_subcpmk == 100) {
                $ProdiSelesai++;
            }

            if ($avg > 0 && $avg < 100) {
                $ProdiProgress++;
            }

            if ($avg == 0) {
                $ProdiBelumMulai++;
            }
        }

        return view('tim.dashboard', compact('prodis', 'prodicount', 'ProdiSelesai', 'ProdiProgress', 'ProdiBelumMulai'));
    }
}
