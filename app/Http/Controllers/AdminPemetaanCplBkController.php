<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CapaianProfilLulusan;
use App\Models\BahanKajian;
use Illuminate\Support\Facades\DB;

class AdminPemetaanCplBkController extends Controller
{
    public function index()
    {
        $cpls = CapaianProfilLulusan::all();
        $bks = BahanKajian::all();
        
        // Ambil semua relasi CPL & bk dalam bentuk array
        $relasi = DB::table('cpl_bk')->get()->groupBy('id_bk');

        return view('admin.pemetaancplbk.index', compact('cpls', 'bks', 'relasi'));
    }

    public function store(Request $request)
    {
        // Mengambil data relasi yang dipilih
        $relasi = $request->input('relasi', []);

        // Hapus semua data relasi sebelumnya (opsional, jika Anda ingin mereset data)
        DB::table('cpl_bk')->delete();

        // Menyimpan data relasi baru
        foreach ($relasi as $id_bk => $id_cpls) {
            foreach ($id_cpls as $id_cpl) {
                DB::table('cpl_bk')->insert([
                    'id_bk' => $id_bk,
                    'id_cpl' => $id_cpl,
                ]);
            }
        }

        return redirect()->route('admin.pemetaancplbk.index')->with('success', 'Pemetaan CPL-BK berhasil disimpan.');
    }
}
