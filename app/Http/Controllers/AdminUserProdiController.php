<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProdi;

class AdminUserProdiController extends Controller
{
    public function index()
    {
        $userprodis = UserProdi::all();
        return view('admin.userprodi.index', compact('userprodis'));
    }
}
