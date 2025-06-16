<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notes;
use App\Models\Prodi;
use Illuminate\Support\Facades\Auth;

class Wadir1NotesController extends Controller
{
    public function index()
    {
        $notes = Notes::with(['prodi', 'user'])->get();

        return view('wadir1.notes.index', compact('notes'));
    }

    public function create()
    {
        $prodis = Prodi::all();
        return view('wadir1.notes.create', compact('prodis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_prodi' => 'required|exists:prodis,kode_prodi',
            'note_content' => 'required|string',
        ]);

        Notes::create([
            'kode_prodi'   => $request->kode_prodi,
            'note_content' => $request->note_content,
            'user_id'      => Auth::id(),
        ]);

        return redirect()->route('wadir1.notes.index')->with('success', 'Catatan berhasil ditambahkan.');
    }
}
