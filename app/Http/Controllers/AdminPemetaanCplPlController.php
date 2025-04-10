<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CapaianProfilLulusan;
use App\Models\ProfilLulusan;
use Illuminate\Support\Facades\DB;

class AdminPemetaanCplPlController extends Controller
{
    public function index()
    {
        $cpls = CapaianProfilLulusan::all(); // Ambil semua CPL dari database
        $pls = ProfilLulusan::all(); // Ambil semua PL dari database
        
        // Ambil semua relasi CPL & PL dalam bentuk array
        $relasi = DB::table('cpl_pl')->get()->groupBy('id_pl');

        return view('admin.pemetaancplpl.index', compact('cpls', 'pls', 'relasi'));
    }

    public function store(Request $request)
    {
        // Mengambil data relasi yang dipilih
        $relasi = $request->input('relasi', []);

        // Hapus semua data relasi sebelumnya (opsional, jika Anda ingin mereset data)
        DB::table('cpl_pl')->delete();

        // Menyimpan data relasi baru
        foreach ($relasi as $id_pl => $kode_cpls) {
            foreach ($kode_cpls as $kode_cpl) {
                DB::table('cpl_pl')->insert([
                    'id_pl' => $id_pl,
                    'kode_cpl' => $kode_cpl,
                ]);
            }
        }

        return redirect()->route('admin.pemetaancplpl.index')->with('success', 'Pemetaan CPL-PL berhasil disimpan.');
    }
}
