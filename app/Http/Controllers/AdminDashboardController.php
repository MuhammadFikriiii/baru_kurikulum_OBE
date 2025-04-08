<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Jurusan;
use App\Models\Prodi;

class AdminDashboardController extends Controller
{
    public function dashboard()
    {
        $users = User::count();
        $jurusans = Jurusan::count();

        return view('admin.dashboard', compact('users','jurusans'));
    }


}
