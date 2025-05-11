<?php

namespace App\Http\Controllers;

use App\Exports\MultipleSheetExcel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class TimExportController extends Controller
{
    public function export()
    {
        $kodeProdi = Auth::user()->kode_prodi;
        return Excel::download(new MultipleSheetExcel($kodeProdi), 'profil_dan_cpl.xlsx');
    }
}