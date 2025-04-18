<?php

namespace App\Http\Controllers;

use App\Models\ProfilLulusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Wadir1ProfilLulusanController extends Controller
{
    public function index()
    {
        $profillulusans = ProfilLulusan::with('prodi')->get();
        return view('wadir1.profillulusan.index', compact('profillulusans'));
    }

}
