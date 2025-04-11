<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Jurusan;

use Illuminate\Http\Request;

class Wadir1DashboardController extends Controller
{
    public function dashboard()
    {
        $users = User::count();
        $jurusans = Jurusan::count();

        return view('wadir1.dashboard', compact('users','jurusans'));
    }
}
