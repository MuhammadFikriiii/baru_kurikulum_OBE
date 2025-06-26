<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tahun;

class Wadir1TahunController extends Controller
{
    public function index()
    {
        $tahuns = Tahun::orderBy('tahun', 'desc')->paginate(10);

        return view('wadir1.tahun.index', compact('tahuns'));
    }
}
