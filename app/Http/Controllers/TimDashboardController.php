<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Jurusan;

class TimDashboardController extends Controller
{
    public function dashboard()
    {
        $users = User::count();
        $jurusans = Jurusan::count();

        return view('tim.dashboard', compact('users','jurusans'));
    }
}
