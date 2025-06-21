<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bobot;
use Illuminate\Support\Facades\DB;
use App\Models\CapaianProfilLulusan;

class Wadir1BobotController extends Controller
{
    public function index()
    {
        $bobots = Bobot::with(['capaianProfilLulusan', 'mataKuliah'])
            ->orderBy('id_cpl')
            ->get();

        return view('wadir1.bobot.index', compact('bobots'));
    }

    public function detail(string $id_cpl)
    {
        // Ambil kode_cpl langsung dari model CapaianProfilLulusan
        $cpl = CapaianProfilLulusan::where('id_cpl', $id_cpl)->firstOrFail();
        $kode_cpl = $cpl->kode_cpl;

        // Ambil mata kuliah terkait dari pivot
        $mk_terkait = DB::table('cpl_mk')
            ->join('mata_kuliahs', 'cpl_mk.kode_mk', '=', 'mata_kuliahs.kode_mk')
            ->where('cpl_mk.id_cpl', $id_cpl)
            ->select('mata_kuliahs.kode_mk', 'mata_kuliahs.nama_mk')
            ->get();

        // Ambil semua bobot untuk CPL ini
        $bobots = Bobot::where('id_cpl', $id_cpl)->get();
        $existingBobots = $bobots->pluck('bobot', 'kode_mk')->toArray();

        // Kirim ke view
        return view('wadir1.bobot.detail', [
            'id_cpl' => $id_cpl,
            'kode_cpl' => $kode_cpl,
            'mataKuliahs' => $mk_terkait,
            'existingBobots' => $existingBobots
        ]);
    }
}
