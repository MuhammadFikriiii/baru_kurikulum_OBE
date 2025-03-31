@extends('layouts.app')

@section('content')
<div class="mr-20 ml-20">
<h2 class="font-extrabold text-4xl mb-6 text-center">Edit Prodi</h2>
<hr class="border border-black mb-4">
<form action="{{ route('admin.prodi.update', $prodi->kode_prodi) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
    <label for="kode_jurusan" class="text-2xl">Jurusan:</label>
    <select name="kode_jurusan" id="kode_jurusan" class="mt-1 w-full p-3 border border-black rounded-lg">
        @foreach ($jurusans as $jurusan)
            <option value="{{ $jurusan->kode_jurusan }}" {{ $prodi->kode_jurusan == $jurusan->kode_jurusan ? 'selected' : '' }}>
                {{ $jurusan->nama_jurusan }}
            </option>
        @endforeach
    </select>
    </div> 

    <div class="mb-3">
    <label for="kode_prodi" class="text-2xl">Kode Prodi:</label>
    <input type="text" class="mt-1 w-full p-3 border border-black rounded-lg" name="kode_prodi" id="kode_prodi" value="{{ old('kode_prodi', $prodi->kode_prodi) }}" required>
    </div>

    <div class="mb-3">
    <label for="nama_prodi" class="text-2xl">Nama Prodi:</label>
    <input type="text" class="mt-1 w-full p-3 border border-black rounded-lg" name="nama_prodi" id="nama_prodi" value="{{ old('nama_prodi', $prodi->nama_prodi) }}" required>
    </div>

    <div>
        <button type="submit" class="btn btn-primary bg-green-400 hover:bg-green-800 mt-3 px-5 py-2 rounded-lg">Update</button>
        <a href="{{ route('admin.prodi.index') }}" class="bg-blue-400 hover:bg-blue-800 mt-3 px-5 py-2 rounded-lg">Kembali</a>
    </div>
@endsection