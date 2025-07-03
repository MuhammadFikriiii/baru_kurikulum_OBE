<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bobot;
use App\Models\CapaianProfilLulusan;
use Illuminate\Support\Facades\DB;

class Wadir1BobotController extends Controller
{
    public function index(Request $request)
    {
        $kode_prodi = $request->get('kode_prodi');
        $id_tahun = $request->get('id_tahun');

        // Data untuk dropdown
        $prodis = DB::table('prodis')->get();
        $tahun_tersedia = DB::table('tahun')->orderByDesc('tahun')->get();

        // Jika belum pilih prodi
        if (!$kode_prodi) {
            return view('wadir1.bobot.index', [
                'bobots' => collect(),
                'kode_prodi' => '',
                'id_tahun' => $id_tahun,
                'prodis' => $prodis,
                'tahun_tersedia' => $tahun_tersedia,
            ]);
        }

        // Query dengan filter prodi dan tahun melalui relasi CPL -> profil_lulusans
        $bobots = Bobot::with(['capaianProfilLulusan.profilLulusans', 'mataKuliah'])
            ->whereHas('capaianProfilLulusan.profilLulusans', function ($query) use ($kode_prodi, $id_tahun) {
                $query->where('kode_prodi', $kode_prodi);
                if ($id_tahun) {
                    $query->where('id_tahun', $id_tahun);
                }
            })
            ->orderBy('id_cpl')
            ->get();

        return view('wadir1.bobot.index', compact(
            'bobots',
            'kode_prodi',
            'id_tahun',
            'prodis',
            'tahun_tersedia'
        ));
    }

    public function detail(string $id_cpl)
    {
        // Ambil CPL
        $cpl = CapaianProfilLulusan::findOrFail($id_cpl);
        $kode_cpl = $cpl->kode_cpl;

        // Ambil data bobot untuk CPL ini, termasuk data MK-nya via relasi
        $bobots = Bobot::with('mataKuliah')->where('id_cpl', $id_cpl)->get();

        // Ambil daftar mata kuliah dari relasi Bobot -> MataKuliah
        $mataKuliahs = $bobots->map(function ($bobot) {
            return (object)[
                'kode_mk' => $bobot->kode_mk,
                'nama_mk' => $bobot->mataKuliah->nama_mk ?? '-',
            ];
        });

        // Array kode_mk => bobot
        $existingBobots = $bobots->pluck('bobot', 'kode_mk')->toArray();

        return view('wadir1.bobot.detail', compact(
            'id_cpl',
            'kode_cpl',
            'mataKuliahs',
            'existingBobots'
        ));
    }
}
