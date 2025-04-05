<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CapaianProfilLulusan;
use App\Models\MataKuliah;
use Illuminate\Support\Facades\DB;

class AdminPemetaanCplMkController extends Controller
{
    public function index()
    {
        $cpls = CapaianProfilLulusan::all();
        $mks = MataKuliah::all();
        
        // Ambil semua relasi CPL & mk dalam bentuk array
        $relasi = DB::table('cpl_mk')->get()->groupBy('kode_mk');

        return view('admin.pemetaancplmk.index', compact('cpls', 'mks', 'relasi'));
    }

    public function store(Request $request)
    {
        // Mengambil data relasi yang dipilih
        $relasi = $request->input('relasi', []);

        // Hapus semua data relasi sebelumnya (opsional, jika Anda ingin mereset data)
        DB::table('cpl_mk')->delete();

        // Menyimpan data relasi baru
        foreach ($relasi as $kode_mk => $kode_cpls) {
            foreach ($kode_cpls as $kode_cpl) {
                DB::table('cpl_mk')->insert([
                    'kode_mk' => $kode_mk,
                    'kode_cpl' => $kode_cpl,
                ]);
            }
        }

        return redirect()->route('admin.pemetaancplmk.index')->with('success', 'Pemetaan CPL-MK berhasil disimpan.');
    }
}
