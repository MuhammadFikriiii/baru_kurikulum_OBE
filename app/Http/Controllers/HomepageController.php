<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodi;
use App\Models\User;

class HomepageController extends Controller
{
    public function homepage()
{
    $prodis = Prodi::with('jurusan')->get();

    $tim_users = User::where('role', 'tim')->get();

    return view('auth.homepage', compact('prodis', 'tim_users'));
}
}
