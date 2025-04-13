@extends('layouts.wadir1.app')

@section('content')
<div class="mr-20 ml-20">
    <h2 class="text-4xl font-extrabold text-center mb-4">Detail Prodi</h2>
    <hr class="w-full border border-black mb-4">

    <label for="nama_jurusan" class="block text-xl font-semibold">Nama</label>
    <input type="text" nama_jurusan="nama_jurusan" id="kode_jurusan" value="{{ $prodi->jurusan->nama_jurusan }}" readonly
        class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">

    <label for="kode_prodi" class="block text-xl font-semibold">Kode Prodi</label>
    <input type="text" name="kode_prodi" id="kode_prodi" value="{{ $prodi->kode_prodi }}" readonly
        class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">

    <label for="nama_prodi" class="block text-xl font-semibold">Nama Prodi</label>
    <input type="text" nama_prodi="nama_prodi" id="nama_prodi" value="{{ $prodi->nama_prodi }}" readonly
        class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">

    <a href="{{ route('wadir1.prodi.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
        Kembali
    </a>
</div>
@endsection