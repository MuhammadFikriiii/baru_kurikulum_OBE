<?php

namespace App\Http\Controllers;

use App\Models\WadirNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Prodi;

class WadirNoteController extends Controller
{
    public function index()
    {
        $notes = WadirNote::with('author', 'prodi')
            ->latest()
            ->paginate(10);

        return view('wadir1.notes.index', compact('notes'));
    }

    public function show(WadirNote $note)
    {
        return view('wadir1.notes.show', compact('note'));
    }

    public function create()
    {
        $prodis = Prodi::all();
        return view('wadir1.notes.create',compact('prodis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'note_content' => 'required|string|min:10',
            'title' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
        ]);

        WadirNote::create([
            'note_content' => $request->note_content,
            'title' => $request->title,
            'category' => $request->category,
            'author_id' => Auth::id(),
        ]);

        return redirect()->route('wadir1.notes.index')
            ->with('success', 'Catatan berhasil disimpan');
    }

    public function edit(WadirNote $note)
    {
        return view('wadir1.notes.edit', compact('note'));
    }

    public function update(Request $request, WadirNote $note)
    {
        $request->validate([
            'note_content' => 'required|string|min:10',
            'title' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
        ]);

        $note->update([
            'note_content' => $request->note_content,
            'title' => $request->title,
            'category' => $request->category,
        ]);

        return redirect()->route('wadir1.notes.index')
            ->with('success', 'Catatan berhasil diperbarui');
    }

    public function destroy(WadirNote $note)
    {
        $note->delete();
        return back()->with('success', 'Catatan berhasil dihapus');
    }
}