<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisiMisi;

class AdminVisiMisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $VisiMisis = VisiMisi::all();
        return view('admin.visi_misi.index', compact('VisiMisis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.visi_misi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'visi' => 'required|string',
            'misi' => 'required|string',
        ]);

        VisiMisi::create($request->all());

        return redirect()->route('admin.visi_misi.index')->with('success', 'Visi dan Misi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function detail(string $id)
    {
        $visiMisi = VisiMisi::findOrFail($id);
        return view('admin.visi_misi.detail', compact('visiMisi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $visiMisi = VisiMisi::findOrFail($id);
        return view('admin.visi_misi.edit', compact('visiMisi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VisiMisi $VisiMisi)
    {
        $request->validate([
            'visi' => 'required|string',
            'misi' => 'required|string',
        ]);

        $VisiMisi->update($request->all());

        return redirect()->route('admin.visi_misi.index')->with('success', 'Visi dan Misi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $visiMisi = VisiMisi::findOrFail($id);
        $visiMisi->delete();

        return redirect()->route('admin.visi_misi.index')->with('success', 'Visi dan Misi berhasil dihapus.');
    }
}
