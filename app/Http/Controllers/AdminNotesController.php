<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notes;

class AdminNotesController extends Controller
{
    public function index()
    {
        $notes = Notes::with(['prodi', 'user'])->get();
        return view('admin.notes.index', compact('notes'));
    }

    public function detail($note)
    {
        $note = Notes::with('prodi')->findOrFail($note);
        return view('admin.notes.detail', compact('note'));
    }
}
