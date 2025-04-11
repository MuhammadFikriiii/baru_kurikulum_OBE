@extends('layouts.app')

@section('content')
<div class="mr-20 ml-20">
    <h2 class="text-4xl font-extrabold text-center mb-4">Detail Jurusan</h2>
    <hr class="w-full border border-black mb-4">

    <label for="jurusan" class="block text-xl font-semibold">Nama</label>
    <input type="text" jurusan="jurusan" id="jurusan" value="{{ $jurusan->kode_jurusan }}" readonly
        class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">

    <label for="nama_jurusan" class="block text-xl font-semibold">Nama Jurusan</label>
    <input type="text" name="nama_jurusan" id="nama_jurusan" value="{{ $jurusan->nama_jurusan }}" readonly
        class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">

    <a href="{{ route('admin.jurusan.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
        Kembali
    </a>
</div>
@endsection