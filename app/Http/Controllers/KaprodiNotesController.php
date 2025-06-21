<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notes;
use Illuminate\Support\Facades\Auth;

class KaprodiNotesController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user || !$user->kode_prodi) {
            abort(404);
        }

        $kodeProdi = $user->kode_prodi;

        $notes = Notes::where('kode_prodi', $kodeProdi)
            ->with(['user'])
            ->get();

        return view('kaprodi.notes.index', compact('notes'));
    }

    public function create()
    {
        return view('kaprodi.notes.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if (!$user || !$user->kode_prodi) {
            abort(404);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'note_content' => 'required|string',
        ]);

        Notes::create([
            'kode_prodi'   => $user->kode_prodi,
            'title'        => $request->title,
            'note_content' => $request->note_content,
            'user_id'      => $user->id,
        ]);

        return redirect()->route('kaprodi.notes.index')->with('success', 'Catatan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $note = Notes::findOrFail($id);

        if ($note->kode_prodi !== Auth::user()->kode_prodi) {
            abort(403);
        }

        return view('kaprodi.notes.edit', compact('note'));
    }

    public function update(Request $request, $id)
    {
        $note = Notes::findOrFail($id);

        if ($note->kode_prodi !== Auth::user()->kode_prodi) {
            abort(403);
        }

        $request->validate([
            'title' => 'nullable|string|max:255',
            'note_content' => 'required|string',
        ]);

        $note->update([
            'title' => $request->title,
            'note_content' => $request->note_content,
        ]);

        return redirect()->route('kaprodi.notes.index')->with('success', 'Catatan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $note = Notes::findOrFail($id);

        if ($note->kode_prodi !== Auth::user()->kode_prodi) {
            abort(403);
        }

        $note->delete();

        return redirect()->route('kaprodi.notes.index')->with('success', 'Catatan berhasil dihapus.');
    }

    public function detail($id)
    {
        $note = Notes::with('user')->findOrFail($id);

        if ($note->kode_prodi !== Auth::user()->kode_prodi) {
            abort(403);
        }

        return view('kaprodi.notes.detail', compact('note'));
    }
}
