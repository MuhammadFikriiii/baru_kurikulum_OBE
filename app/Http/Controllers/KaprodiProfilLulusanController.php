<?php

namespace App\Http\Controllers;

use App\Models\ProfilLulusan;
use Illuminate\Support\Facades\Auth;    
use Illuminate\Http\Request;

class KaprodiProfilLulusanController extends Controller
{
    public function index()
    {
        $user = Auth::guard('userprodi')->user();

        if (!$user || !$user->kode_prodi) {
            abort(404);
        }
        $kodeProdi = $user->kode_prodi;

        $profillulusans = ProfilLulusan::where('kode_prodi', $kodeProdi)->with('prodi')->get();
        return view('kaprodi.profillulusan.index', compact('profillulusans'));
    }

}
