<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $users = User::all(); // Ambil semua data pengguna
        return view('admin.dashboard', compact('users'));
    }
}
