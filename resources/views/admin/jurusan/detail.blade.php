@extends('layouts.app')

@section('content')
<div class="mr-20 ml-20">
    <h2 class="text-4xl font-extrabold text-center mb-4">Detail Jurusan</h2>
    <hr class="w-full border border-black mb-4">

    <label for="nama_jurusan" class="text-xl font-semibold">Nama Jurusan</label>
    <input type="text" name="nama_jurusan" id="nama_jurusan" value="{{ $jurusan->nama_jurusan }}" readonly
        class="w-full p-3 border border-black rounded-lg mb-6 bg-gray-100">

    <a href="{{ route('admin.jurusan.index') }}" class="bg-gray-600 text-white font-bold px-5 py-2 rounded hover:bg-gray-700">
        Kembali
    </a>
</div>
@endsection