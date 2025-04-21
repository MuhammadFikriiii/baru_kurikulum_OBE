@extends('layouts.app')

@section('content')

<div class="mr-20 ml-20">
    <h2 class="text-4xl font-extrabold text-center mb-4">Tambah Capaian Pembelajaran Matakuliah</h2>
    <hr class="w-full border border-black mb-4">

    <form action="{{ route('admin.capaianpembelajaranmatakuliah.store') }}" method="POST">
        @csrf

        <label for="kode_cpmk">Kode CPMK</label>
        <input type="text" name="kode_cpmk" id="kode_cpmk" required>

        <label for="deskripsi_cpmk">Deskripsi CPMK</label>
        <input type="text" name="deskripsi_cpmk" id="deskripsi_cpmk" required>

        <button type="submit" class="px-4 py-2 bg-green-400">simpan</button>
    </form>
@endsection