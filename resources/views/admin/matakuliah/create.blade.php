@extends('layouts.app')

@section('content')
<div class=" ml-20  mr-20 container w-full">
    <h2 class="font-extrabold text-4xl mb-6 text-center">Tambah MataKuliah</h2>
    <hr class="w-full border border-black mb-4">

    @if ($errors->any())
     <div style="color: red;">
       <ul>
            @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
            @endforeach
        </ul>
     </div>
    @endif

    <form action="{{ route ('admin.matakuliah.store') }}" method="POST">
        @csrf
        <div class="mt-3">
            <label for="kode_mk" class="text-2xl">Kode Mata Kuliah</label>
            <input type="text" name="kode_mk" id="kode_mk" class="mt-1 w-full p-3 border border-black rounded-lg focus:ring-blue-500 focus:border-blue-500">
        </div>
        <div class="mt-3">
            <label for="nama_mk" class="text-2xl">Nama Mata Kuliah</label>
            <input type="text" name="nama_mk" id="nama_mk" class="mt-1 w-full p-3 border border-black rounded-lg focus:ring-blue-500 focus:border-blue-500">
        </div>
        <div class="mt-3">
            <label for="jenis_mk" class="text-2xl">Jenis MataKuliah</label>
            <input type="text" name="jenis_mk" id="jenis_mk" class="mt-1 w-full p-3 border border-black rounded-lg focus:ring-blue-500 focus:border-blue-500">
        </div>
        <div class="mt-3">
            <label for="sks_mk" class="text-2xl">SKS MataKuliah</label>
            <input type="number" name="sks_mk" id="sks_mk" class="mt-1 w-full p-3 border border-black rounded-lg focus:ring-blue-500 focus:border-blue-500">
        </div>
        <div class="mt-3">
            <label for="semester_mk" class="text-2xl">Semester MataKuliah</label>
            <select name="semester_mk" id="semester_mk" class="mt-1 w-full p-3 border border-black rounded-lg focus:ring-blue-500 focus:border-blue-500">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
            </select>
        </div>
        <div class="mt-3">
            <label for="kompetensi_mk">kompetensi MataKuliahk</label>
            <select name="kompetensi_mk" id="kompetensi_mk" class="mt-1 w-full p-3 border border-black rounded-lg focus:ring-blue-500 focus:border-blue-500">
                <option value="pendukung">pendukung</option>
                <option value="utama">utama</option>
            </select>
        </div>
        <div>
            <button type="submit" class="btn btn-primary bg-green-400 hover:bg-green-800 mt-3 px-5 py-2 rounded-lg">Simpan</button>
        </div>
    </form>

@endsection