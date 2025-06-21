<?php

namespace App\Http\Controllers;

use App\Models\CapaianProfilLulusan;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use App\Models\Bobot;
use Illuminate\Support\Facades\DB;

class AdminBobotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bobots = Bobot::with(['capaianProfilLulusan', 'mataKuliah'])
            ->orderBy('id_cpl')
            ->get();

        return view('admin.bobot.index', compact('bobots'));
    }

    public function getmkbycpl()
    {
        $id_cpls = $request->id_cpls ?? [];

        $mks = DB::table('cpl_mk')
            ->join('mata_kuliahs as mk', 'cpl_mk.kode_mk', '=', 'mk.kode_mk')
            ->whereIn('cpl_mk.id_cpl', $id_cpls)
            ->select('mk.kode_mk', 'mk.nama_mk')
            ->distinct()
            ->orderBy('mk.kode_mk')
            ->get();

        return response()->json($mks);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $capaianProfilLulusans = CapaianProfilLulusan::all();
        $mataKuliahs = MataKuliah::all();
        return view('admin.bobot.create', compact('capaianProfilLulusans', 'mataKuliahs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_cpl' => 'required|exists:capaian_profil_lulusans,id_cpl',
            'kode_mk' => 'required|array|min:1',
            'kode_mk.*' => 'exists:mata_kuliahs,kode_mk',
            'bobot' => 'required|array',
            'bobot.*' => 'integer|min:0|max:100',
        ]);

        foreach ($request->kode_mk as $kode_mk) {
            Bobot::create([
                'id_cpl' => $request->id_cpl,
                'kode_mk' => $kode_mk,
                'bobot' => $request->bobot[$kode_mk] ?? 0,
            ]);
        }

        return redirect()->route('admin.bobot.index')->with('success', 'Bobot berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function detail(string $id_cpl)
    {
        $mk_terkait = DB::table('cpl_mk')
            ->join('mata_kuliahs', 'cpl_mk.kode_mk', '=', 'mata_kuliahs.kode_mk')
            ->where('cpl_mk.id_cpl', $id_cpl)
            ->select('mata_kuliahs.kode_mk', 'mata_kuliahs.nama_mk')
            ->get();

        $bobots = Bobot::where('id_cpl', $id_cpl)->get();
        $existingBobots = $bobots->pluck('bobot', 'kode_mk')->toArray();

        return view('admin.bobot.detail', [
            'id_cpl' => $id_cpl,
            'mataKuliahs' => $mk_terkait,
            'existingBobots' => $existingBobots
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_cpl)
    {
        // Ambil semua MK yang terkait dengan CPL ini dari pivot
        $mk_terkait = DB::table('cpl_mk')
            ->join('mata_kuliahs', 'cpl_mk.kode_mk', '=', 'mata_kuliahs.kode_mk')
            ->where('cpl_mk.id_cpl', $id_cpl)
            ->select('mata_kuliahs.kode_mk', 'mata_kuliahs.nama_mk')
            ->get();

        // Ambil semua bobot yang sudah disimpan untuk CPL ini
        $bobots = Bobot::where('id_cpl', $id_cpl)->get();

        // Konversi ke array [kode_mk => bobot]
        $existingBobots = $bobots->pluck('bobot', 'kode_mk')->toArray();

        return view('admin.bobot.edit', [
            'id_cpl' => $id_cpl,
            'mataKuliahs' => $mk_terkait,
            'existingBobots' => $existingBobots
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_cpl)
    {
        $request->validate([
            'kode_mk' => 'required|array',
            'kode_mk.*' => 'exists:mata_kuliahs,kode_mk',
            'bobot' => 'required|array',
            'bobot.*' => 'integer|min:0|max:100',
        ]);

        foreach ($request->kode_mk as $kode_mk) {
            DB::table('bobots')->updateOrInsert(
                ['id_cpl' => $id_cpl, 'kode_mk' => $kode_mk],
                ['bobot' => $request->bobot[$kode_mk] ?? 0]
            );
        }

        return redirect()->route('admin.bobot.index')->with('success', 'Bobot berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_cpl)
    {
        Bobot::where('id_cpl', $id_cpl)->delete();

        return redirect()->route('admin.bobot.index')->with('success', 'Semua bobot untuk CPL ini berhasil dihapus.');
    }
}
