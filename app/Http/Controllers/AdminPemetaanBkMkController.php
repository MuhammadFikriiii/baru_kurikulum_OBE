<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\BahanKajian;
use App\Models\MataKuliah;

class AdminPemetaanBkMkController extends Controller
{
    public function index()
    {
        $bks = BahanKajian::all();
        $mks = MataKuliah::all();
        
        // Ambil semua relasi bk & mk dalam bentuk array
        $relasi = DB::table('bk_mk')->get()->groupBy('kode_mk');

        return view('admin.pemetaanbkmk.index', compact('bks', 'mks', 'relasi'));
    }

    public function store(Request $request)
    {
        // Mengambil data relasi yang dipilih
        $relasi = $request->input('relasi', []);

        // Hapus semua data relasi sebelumnya (opsional, jika Anda ingin mereset data)
        DB::table('bk_mk')->delete();

        // Menyimpan data relasi baru
        foreach ($relasi as $kode_bk => $kode_mks) {
            foreach ($kode_mks as $kode_mk) {
                DB::table('bk_mk')->insert([
                    'kode_bk' => $kode_bk,
                    'kode_mk' => $kode_mk,
                ]);
            }
        }        

        return redirect()->route('admin.pemetaanbkmk.index')->with('success', 'Pemetaan CPL-MK berhasil disimpan.');
    }
}
