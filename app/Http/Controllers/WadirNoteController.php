<?php

namespace App\Http\Controllers\Wadir;

use App\Http\Controllers\Controller;
use App\Models\Prodi;
use App\Models\WadirNote;
use Illuminate\Http\Request;

class WadirNoteController extends Controller
{
    public function index()
    {
        $notes = WadirNote::with(['prodi', 'author'])
            ->latest()
            ->paginate(10);

        return view('wadir.notes.index', compact('notes'));
    }

    public function create()
    {
        $prodis = Prodi::all();
        return view('wadir.notes.create', compact('prodis'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'prodi_id' => 'required|exists:prodis,id',
            'note' => 'required|string|min:10',
        ]);

        WadirNote::create([
          'prodi_id' => $request->prodi_id,
          'note' => $request->note,
          'created_by' => auth()->check() ? auth()->user()->id : null,
      ]);

        return redirect()->route('wadir.notes.index')
            ->with('success', 'Catatan berhasil disimpan');
    }

    // Edit - Form untuk mengedit catatan
    public function edit(WadirNote $note)
    {
        $prodis = Prodi::all();
        return view('wadir.notes.edit', compact('note', 'prodis'));
    }

    // Update - Memperbarui catatan
    public function update(Request $request, WadirNote $note)
    {
        $request->validate([
            'prodi_id' => 'required|exists:prodis,id',
            'note' => 'required|string|min:10',
        ]);

        $note->update([
            'prodi_id' => $request->prodi_id,
            'note' => $request->note,
        ]);

        return redirect()->route('wadir.notes.index')
            ->with('success', 'Catatan berhasil diperbarui');
    }

    // Destroy - Menghapus catatan
    public function destroy(WadirNote $note)
    {
        $note->delete();
        return back()->with('success', 'Catatan berhasil dihapus');
    }
}