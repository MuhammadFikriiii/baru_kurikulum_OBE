<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CapaianProfilLulusan;
use App\Models\BahanKajian;
use App\Models\MataKuliah;
use Illuminate\Support\Facades\DB;

class AdminPemetaanCplMkBkController extends Controller
{
    public function index()
    {
        $cpl = CapaianProfilLulusan::all(); 
        $bk = BahanKajian::all(); 
        $mataKuliah = MataKuliah::all();

        $pemetaan = DB::table('cpl_mk_bk')
            ->get()
            ->groupBy(function ($item) {
                return $item->kode_cpl . '-' . $item->kode_bk;
            });

        return view('admin.pemetaancplmkbk.index', compact('cpl', 'bk', 'mataKuliah', 'pemetaan'));
    }


    public function store(Request $request)
    {
        $data = $request->input('pemetaan');

        DB::table('cpl_mk_bk')->delete();

        foreach ($data as $kode_cpl => $bks) {
            foreach ($bks as $kode_bk => $kode_mk) {
                if (!empty($kode_mk)) {
                    DB::table('cpl_mk_bk')->updateOrInsert(
                        [
                            'kode_cpl' => $kode_cpl,
                            'kode_bk' => $kode_bk,
                        ],
                        [
                            'kode_mk' => $kode_mk,
                        ]
                    );
                }
            }
        }

        return redirect()->route('admin.pemetaancplmkbk.index')->with('success', 'Pemetaan berhasil disimpan.');
    }

}
