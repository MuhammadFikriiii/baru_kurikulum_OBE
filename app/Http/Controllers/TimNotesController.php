<?php

namespace App\Http\Controllers;

use App\Models\Notes;
use Illuminate\Support\Facades\Auth;

class TimNotesController extends Controller
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

        return view('tim.notes.index', compact('notes'));
    }

    public function detail($id)
    {
        $note = Notes::with('user')->findOrFail($id);

        if ($note->kode_prodi !== Auth::user()->kode_prodi) {
            abort(403);
        }

        return view('tim.notes.detail', compact('note'));
    }
}
