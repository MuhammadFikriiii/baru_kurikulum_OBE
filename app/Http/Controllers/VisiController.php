<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visi;

class VisiController extends Controller
{
    public function index()
    {
        $Visis = Visi::all();
        return view('admin.visi.index', compact('Visis'));
    }

    public function create()
    {
        return view('admin.visi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'visi' => 'required|string',
        ]);

        Visi::create($request->all());

        return redirect()->route('admin.visi.index')->with('success', 'Visi berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $visi = Visi::findOrFail($id);
        return view('admin.visi.edit', compact('visi'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'visi' => 'required|string',
        ]);

        $visi = Visi::findOrFail($id);
        $visi->update($request->all());

        return redirect()->route('admin.visi.index')->with('success', 'Visi berhasil diperbarui.');
    }

    public function detail(string $id)
    {
        $visi = Visi::findOrFail($id);
        return view('admin.visi.detail', compact('visi'));
    }

    public function destroy(string $id)
    {
        $visi = Visi::findOrFail($id);
        $visi->delete();

        return redirect()->route('admin.visi.index')->with('success', 'Visi berhasil dihapus.');
    }
}
