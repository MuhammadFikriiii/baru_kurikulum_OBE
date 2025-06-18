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

    public function destroy($note)  // Change $id to $note to match route parameter
    {
        $note = Notes::findOrFail($note);
        $note->delete();
        return redirect()->route('wadir1.notes.index')
            ->with('success', 'Catatan berhasil dihapus.');
    }
    
    // Method untuk menampilkan detail
    public function detail($note)
    {
        $note = Notes::with('prodi')->findOrFail($note);
        return view('wadir1.notes.detail', compact('note'));
    }

    // Method untuk menampilkan form edit
    public function edit($note)
    {
        $note = Notes::findOrFail($note);
        $prodis = Prodi::all(); // Sesuaikan dengan model prodi Anda
        return view('wadir1.notes.edit', compact('note', 'prodis'));
    }

    // Method untuk memproses update
    public function update(Request $request, $note)
    {
        $request->validate([
            'kode_prodi' => 'required|exists:prodis,kode_prodi',
            'title' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'note_content' => 'required|string',
        ]);

        $note = Notes::findOrFail($note);
        $note->update($request->all());

        return redirect()->route('wadir1.notes.show', $note->id_note)
            ->with('success', 'Catatan berhasil diperbarui.');
    }
}
