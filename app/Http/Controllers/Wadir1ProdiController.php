<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodi;

class Wadir1ProdiController extends Controller
{
    public function index()
    {
        $prodis = Prodi::all();
        return view('wadir1.prodi.index', compact('prodis'));
    }

    public function detail(Prodi $prodi)
    {
        return view('wadir1.prodi.detail', compact('prodi'));
    }
}
