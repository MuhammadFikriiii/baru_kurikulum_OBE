<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class Wadir1UserController extends Controller
{
    public function index() {

        $users = User::with('prodi')->get();
        return view('wadir1.users.index', compact('users'));
    }

    public function detail($id)
    {
        $user = User::findOrFail($id);
        return view('wadir1.users.detail', compact('user'));
    }
}
