@extends('layouts.app')

@section('content')
<div class="mr-20 ml-20">
    <h2 class="text-4xl font-extrabold text-center mb-4">Detail Profil Lulusan</h2>
    <hr class="w-full border border-black mb-4">

    <label for="kode_pl" class="block text-xl font-semibold">Nama</label>
    <input type="text" kode_pl="kode_pl" id="kode_pl" value="{{ $id_pl->kode_pl }}" readonly
        class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">

    <label for="nama_prodi" class="block text-xl font-semibold">Nama Prodi</label>
    <input type="text" name="nama_prodi" id="nama_prodi" value="{{ $id_pl->prodi->nama_prodi }}" readonly
        class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">

    <label for="deskripsi_pl" class="block text-xl font-semibold">Deskripsi PL</label>
    <textarea name="deskripsi_pl" id="deskripsi_pl" readonly
        class="w-full p-3 border border-black rounded-lg mb-8 bg-gray-100">{{ $id_pl->deskripsi_pl }}</textarea>

    <label for="profesi_pl" class="block text-xl font-semibold">Profesi PL</label>
    <textarea name="profesi_pl" id="profesi_pl" readonly
        class="w-full p-3 border border-black rounded-lg mb-8 bg-gray-100">{{ $id_pl->profesi_pl }}</textarea>

    <label for="unsur_pl" class="block text-xl font-semibold">Unsur PL</label>
    <input type="text" name="unsur_pl" id="unsur_pl" value="{{ $id_pl->unsur_pl }}" readonly
        class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">

    <label for="keterangan_pl" class="block text-xl font-semibold">Keterangan PL</label>
    <input type="text" name="keterangan_pl" id="keterangan_pl" value="{{ $id_pl->keterangan_pl }}" readonly
        class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">

    <label for="sumber_pl" class="block text-xl font-semibold">Sumber PL</label>
    <input type="text" name="sumber_pl" id="sumber_pl" value="{{ $id_pl->sumber_pl }}" readonly
        class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">

    <a href="{{ route('admin.profillulusan.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
        Kembali
    </a>
</div>
@endsection