<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jurusan;

class Wadir1JurusanController extends Controller
{
    public function index()
    {
        $jurusans = Jurusan::all();
        return view('wadir1.jurusan.index', compact('jurusans'));
    }

    public function detail(Jurusan $jurusan)
    {
        return view('wadir1.jurusan.detail', compact('jurusan'));
    }
}
