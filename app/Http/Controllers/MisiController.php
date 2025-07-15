<?php

namespace App\Http\Controllers;

use App\Models\Misi;
use App\Models\Visi;
use Illuminate\Http\Request;

class MisiController extends Controller
{
    public function index()
    {
        $misis = Misi::with('visi')->get();
        return view('admin.misi.index', compact('misis'));
    }

    public function create()
    {
        $visis = Visi::all();
        return view('admin.misi.create', compact('visis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'visi_id' => 'required|exists:visis,id',
            'misi' => 'required|string',
        ]);

        Misi::create($request->all());

        return redirect()->route('admin.misi.index')->with('success', 'Misi berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $misi = Misi::findOrFail($id);
        $visis = Visi::all();
        return view('admin.misi.edit', compact('misi', 'visis'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'visi_id' => 'required|exists:visis,id',
            'misi' => 'required|string',
        ]);

        $misi = Misi::findOrFail($id);
        $misi->update($request->all());

        return redirect()->route('admin.misi.index')->with('success', 'Misi berhasil diperbarui.');
    }

    public function detail(string $id)
    {
        $misi = Misi::with('visi')->findOrFail($id);
        return view('admin.misi.detail', compact('misi'));
    }

    public function destroy(string $id)
    {
        $misi = Misi::findOrFail($id);
        $misi->delete();

        return redirect()->route('admin.misi.index')->with('success', 'Misi berhasil dihapus.');
    }
}
