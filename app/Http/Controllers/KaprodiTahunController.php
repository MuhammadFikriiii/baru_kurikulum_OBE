<?php

namespace App\Http\Controllers;
use App\Models\Tahun;

use Illuminate\Http\Request;

class KaprodiTahunController extends Controller
{
    public function index()
    {
        $tahuns = Tahun::orderBy('tahun', 'desc')->paginate(10);

        return view('kaprodi.tahun.index', compact('tahuns'));
    }
}
