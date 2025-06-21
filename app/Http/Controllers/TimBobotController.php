<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\{Bobot, CapaianProfilLulusan, MataKuliah};

class TimBobotController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user || !$user->kode_prodi) {
            abort(404);
        }

        $kodeProdi = $user->kode_prodi;

        $query = DB::table('bobots')
            ->join('capaian_profil_lulusans as cpl', 'bobots.id_cpl', '=', 'cpl.id_cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->join('prodis', 'pl.kode_prodi', '=', 'prodis.kode_prodi')
            ->where('prodis.kode_prodi', $kodeProdi)
            ->select(
                'bobots.id_bobot',
                'bobots.id_cpl',
                'bobots.kode_mk',
                'bobots.bobot',
                'cpl.kode_cpl',
                'cpl.deskripsi_cpl',
                'prodis.nama_prodi'
            )
            ->orderBy('bobots.id_cpl');

        $bobots = $query->get();

        return view('tim.bobot.index', compact('bobots'));
    }

    public function getmkbycpl(Request $request)
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

    public function create()
    {
        $user = Auth::user();

        if (!$user || !$user->kode_prodi) {
            abort(403);
        }

        $capaianProfilLulusans = DB::table('capaian_profil_lulusans as cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->where('pl.kode_prodi', $user->kode_prodi)
            ->select('cpl.id_cpl', 'cpl.kode_cpl', 'cpl.deskripsi_cpl')
            ->distinct()
            ->get();

        $mataKuliahs = DB::table('mata_kuliahs as mk')
            ->join('cpl_mk', 'mk.kode_mk', '=', 'cpl_mk.kode_mk')
            ->join('capaian_profil_lulusans as cpl', 'cpl.id_cpl', '=', 'cpl_mk.id_cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->where('pl.kode_prodi', $user->kode_prodi)
            ->select('mk.kode_mk', 'mk.nama_mk')
            ->distinct()
            ->get();

        return view('tim.bobot.create', compact('capaianProfilLulusans', 'mataKuliahs'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if (!$user || !$user->kode_prodi) {
            abort(403);
        }

        $request->validate([
            'id_cpl' => 'required|exists:capaian_profil_lulusans,id_cpl',
            'kode_mk' => 'required|array|min:1',
            'kode_mk.*' => 'exists:mata_kuliahs,kode_mk',
            'bobot' => 'required|array',
            'bobot.*' => 'integer|min:0|max:100',
        ]);

        $valid = DB::table('capaian_profil_lulusans as cpl')
            ->join('cpl_pl', 'cpl.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans as pl', 'cpl_pl.id_pl', '=', 'pl.id_pl')
            ->where('cpl.id_cpl', $request->id_cpl)
            ->where('pl.kode_prodi', $user->kode_prodi)
            ->exists();

        if (!$valid) {
            abort(403, 'CPL ini tidak milik prodi Anda.');
        }

        foreach ($request->kode_mk as $kode_mk) {
            Bobot::create([
                'id_cpl' => $request->id_cpl,
                'kode_mk' => $kode_mk,
                'bobot' => $request->bobot[$kode_mk] ?? 0,
            ]);
        }

        return redirect()->route('tim.bobot.index')->with('success', 'Bobot berhasil ditambahkan.');
    }

    public function detail(string $id_cpl)
    {
        $user = Auth::user();

        if (!$user || !$user->kode_prodi) {
            abort(404);
        }

        $kodeProdi = $user->kode_prodi;

        $mk_terkait = DB::table('cpl_mk')
            ->join('mata_kuliahs', 'cpl_mk.kode_mk', '=', 'mata_kuliahs.kode_mk')
            ->join('cpl_pl', 'cpl_mk.id_cpl', '=', 'cpl_pl.id_cpl')
            ->join('profil_lulusans', 'cpl_pl.id_pl', '=', 'profil_lulusans.id_pl')
            ->join('prodis', 'profil_lulusans.kode_prodi', '=', 'prodis.kode_prodi')
            ->where('prodis.kode_prodi', $kodeProdi)
            ->where('cpl_mk.id_cpl', $id_cpl)
            ->select('mata_kuliahs.kode_mk', 'mata_kuliahs.nama_mk')
            ->get();

        $bobots = Bobot::where('id_cpl', $id_cpl)->get();
        $existingBobots = $bobots->pluck('bobot', 'kode_mk')->toArray();

        return view('tim.bobot.detail', [
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
        $user = Auth::user();

        if (!$user || !$user->kode_prodi) {
            abort(404);
        }

        $kodeProdi = $user->kode_prodi;

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

        return view('tim.bobot.edit', [
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
        $user = Auth::user();

        if (!$user || !$user->kode_prodi) {
            abort(404);
        }

        $kodeProdi = $user->kode_prodi;

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

        return redirect()->route('tim.bobot.index')->with('success', 'Bobot berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_cpl)
    {
        Bobot::where('id_cpl', $id_cpl)->delete();

        return redirect()->route('tim.bobot.index')->with('success', 'Semua bobot untuk CPL ini berhasil dihapus.');
    }
}
