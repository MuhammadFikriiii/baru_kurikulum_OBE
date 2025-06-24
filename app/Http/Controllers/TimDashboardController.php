<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodi;
use App\Models\Tahun;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TimDashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $user = Auth::user();
        if (!$user || !$user->kode_prodi) {
            abort(403, 'Akses ditolak.');
        }

        $kodeProdi = $user->kode_prodi;
        $tahun_progress = $request->get('tahun_progress');
        $id_tahun = $request->get('id_tahun');
        $availableYears = Tahun::orderBy('tahun', 'desc')->get();

        $prodis = Prodi::with(['profillulusans' => function ($query) use ($tahun_progress) {
            if ($tahun_progress) {
                $query->where('id_tahun', $tahun_progress);
            }
        }])->where('kode_prodi', $kodeProdi)->get();

        $prodicount = $tahun_progress ? $prodis->count() : 0;
        $ProdiSelesai = 0;
        $ProdiProgress = 0;
        $ProdiBelumMulai = 0;

        if ($tahun_progress) {
            foreach ($prodis as $prodi) {
                $plIds = $prodi->profillulusans->pluck('id_pl')->toArray();

                $prodi->pl_count = count($plIds);

                $prodi->cpl_count = DB::table('cpl_pl')
                    ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
                    ->whereIn('pl.id_pl', $plIds)
                    ->where('pl.id_tahun', $tahun_progress)
                    ->distinct()->count('id_cpl');

                $prodi->bk_count = DB::table('cpl_bk')
                    ->join('capaian_profil_lulusans as cpl', 'cpl_bk.id_cpl', '=', 'cpl.id_cpl')
                    ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
                    ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
                    ->whereIn('pl.id_pl', $plIds)
                    ->where('pl.id_tahun', $tahun_progress)
                    ->distinct()->count('cpl_bk.id_bk');

                $prodi->sks_mk = DB::table('mata_kuliahs')
                    ->whereIn('kode_mk', function ($query) use ($plIds, $tahun_progress) {
                        $query->select('cpl_mk.kode_mk')
                            ->from('cpl_mk')
                            ->join('capaian_profil_lulusans as cpl', 'cpl_mk.id_cpl', '=', 'cpl.id_cpl')
                            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
                            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
                            ->whereIn('pl.id_pl', $plIds)
                            ->where('pl.id_tahun', $tahun_progress)
                            ->distinct();
                    })->sum('sks_mk');

                $prodi->cpmk_count = DB::table('cpl_cpmk')
                    ->join('capaian_profil_lulusans as cpl', 'cpl_cpmk.id_cpl', '=', 'cpl.id_cpl')
                    ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
                    ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
                    ->whereIn('pl.id_pl', $plIds)
                    ->where('pl.id_tahun', $tahun_progress)
                    ->distinct()->count('cpl_cpmk.id_cpmk');

                $prodi->subcpmk_count = DB::table('sub_cpmks')
                    ->join('cpl_cpmk', 'sub_cpmks.id_cpmk', '=', 'cpl_cpmk.id_cpmk')
                    ->join('capaian_profil_lulusans as cpl', 'cpl_cpmk.id_cpl', '=', 'cpl.id_cpl')
                    ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
                    ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
                    ->whereIn('pl.id_pl', $plIds)
                    ->where('pl.id_tahun', $tahun_progress)
                    ->distinct()->count('sub_cpmks.id_sub_cpmk');

                // Hitung progress
                $target = [
                    'pl' => 3,
                    'cpl' => 9,
                    'bk' => 8,
                    'sks_mk' => 108,
                    'cpmk' => 18,
                    'subcpmk' => 36
                ];

                $progress = [
                    'pl' => min(100, round(($prodi->pl_count / $target['pl']) * 100)),
                    'cpl' => min(100, round(($prodi->cpl_count / $target['cpl']) * 100)),
                    'bk' => min(100, round(($prodi->bk_count / $target['bk']) * 100)),
                    'sks_mk' => min(100, round(($prodi->sks_mk / $target['sks_mk']) * 100)),
                    'cpmk' => min(100, round(($prodi->cpmk_count / $target['cpmk']) * 100)),
                    'subcpmk' => min(100, round(($prodi->subcpmk_count / $target['subcpmk']) * 100)),
                ];

                $prodi->progress_pl = $progress['pl'];
                $prodi->progress_cpl = $progress['cpl'];
                $prodi->progress_bk = $progress['bk'];
                $prodi->progress_sks_mk = $progress['sks_mk'];
                $prodi->progress_cpmk = $progress['cpmk'];
                $prodi->progress_subcpmk = $progress['subcpmk'];
                $prodi->avg_progress = round(array_sum($progress) / count($progress));

                if ($prodi->avg_progress == 100) $ProdiSelesai++;
                elseif ($prodi->avg_progress > 0) $ProdiProgress++;
                else $ProdiBelumMulai++;
            }
        }

        return view('tim.dashboard', compact(
            'prodis',
            'prodicount',
            'ProdiSelesai',
            'ProdiProgress',
            'ProdiBelumMulai',
            'tahun_progress',
            'id_tahun',
            'availableYears'
        ));
    }
}
