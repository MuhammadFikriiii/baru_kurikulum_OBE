<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CapaianProfilLulusan;

class CapaianProfilLulusanController extends Controller
{
    public function index()
    {
        $capaianprofillulusans = CapaianProfilLulusan::all();
        return view("admin.capaianprofillulusan.index", compact("capaianprofillulusans"));
    }
}
