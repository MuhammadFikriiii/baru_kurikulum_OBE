<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Jurusan;

class KaprodiDashboardController extends Controller
{
    public function dashboard()
    {
        $users = User::count();
        $jurusans = Jurusan::count();

        return view('kaprodi.dashboard', compact('users','jurusans'));
    }
}
