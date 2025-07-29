<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class HomepageController extends Controller
{
    public function homepage()
{
    $prodis = Prodi::with('jurusan')->get();

    $tim_users = User::where('role', 'tim')->get();

    $visis = DB::table('visis')->first();

    $misis = DB::table('misis')->where('visi_id', $visis->id)->get();

    return view('auth.homepage', compact('prodis', 'tim_users', 'visis', 'misis'));
}
}
