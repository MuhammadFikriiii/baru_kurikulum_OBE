<?php

namespace App\Http\Controllers\Wadir;

use App\Http\Controllers\Controller;
use App\Models\Prodi;
use App\Models\WadirNote; // Pastikan ini di-import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Jangan lupa import Auth facade

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
            'created_by' => Auth::id(), 
        ]);

        return redirect()->route('wadir.notes.index')
            ->with('success', 'Catatan berhasil disimpan');
    }

    public function edit(WadirNote $note)
    {
        $prodis = Prodi::all();
        return view('wadir.notes.edit', compact('note', 'prodis'));
    }

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

    public function destroy(WadirNote $note)
    {
        $note->delete();
        return back()->with('success', 'Catatan berhasil dihapus');
    }
}