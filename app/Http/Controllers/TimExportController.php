<?php

namespace App\Http\Controllers;

use App\Exports\MultipleSheetExcel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class TimExportController extends Controller
{
    public function export(Request $request)
    {
        $user = Auth::user();
        $kodeProdi = in_array($user->role, ['admin', 'wadir1'])
            ? $request->kode_prodi
            : $user->kode_prodi;


        if (!$kodeProdi) {
            return back()->with('error', 'Kode prodi harus dipilih.');
        }

        return Excel::download(new MultipleSheetExcel($kodeProdi), 'profil_dan_cpl_' . $kodeProdi . '.xlsx');
    }
}
