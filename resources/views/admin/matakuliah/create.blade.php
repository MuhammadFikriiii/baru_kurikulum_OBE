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

        <label for="id_cpls" class="text-2xl font-semibold mb-2">Profil Lulusan Terkait:</label>
    <select id="id_cpls" name="id_cpls[]" class="border border-gray-300 p-3 w-full rounded-lg mt-1 mb-3 focus:outline-none focus:ring-2 focus:ring-[#5460B5] focus:bg-[#f7faff]" multiple required>
    @foreach($capaianProfilLulusans as $cpl)
        <option value="{{ $cpl->id_cpl }}" title="{{ $cpl->kode_cpl }} - {{ $cpl->deskripsi_cpl }}">
    {{ $cpl->kode_cpl }} - {{ $cpl->deskripsi_cpl }}
    </option>
    @endforeach
    </select>
    <p class="text-sm text-gray-500 mb-2">Tekan shift/Tahan Klik mouseuntuk memilih lebih dari satu.</p>
    
        <div class="mt-3">
            <label for="kode_mk" class="text-2xl">Kode Mata Kuliah</label>
            <input type="text" name="kode_mk" id="kode_mk" class="mt-1 w-full p-3 border border-black rounded-lg ">
        </div>
        <div class="mt-3">
            <label for="nama_mk" class="text-2xl">Nama Mata Kuliah</label>
            <input type="text" name="nama_mk" id="nama_mk" class="mt-1 w-full p-3 border border-black rounded-lg ">
        </div>
        <div class="mt-3">
            <label for="jenis_mk" class="text-2xl">Jenis MataKuliah</label>
            <input type="text" name="jenis_mk" id="jenis_mk" class="mt-1 w-full p-3 border border-black rounded-lg ">
        </div>
        <div class="mt-3">
            <label for="sks_mk" class="text-2xl">SKS MataKuliah</label>
            <input type="number" name="sks_mk" id="sks_mk" class="mt-1 w-full p-3 border border-black rounded-lg ">
        </div>
        <div class="mt-3">
            <label for="semester_mk" class="text-2xl">Semester MataKuliah</label>
            <select name="semester_mk" id="semester_mk" class="mt-1 w-full p-3 border border-black rounded-lg ">
                <option value="" disabled selected>Pilih Semester</option>
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
            <label for="kompetensi_mk" class="text-2xl">kompetensi MataKuliah</label>
            <select name="kompetensi_mk" id="kompetensi_mk" class="mt-1 w-full p-3 border border-black rounded-lg mb-3">
                <option value="" selected disabled>Pilih Kompetensi MK</option>
                <option value="pendukung">pendukung</option>
                <option value="utama">utama</option>
            </select>
        </div>
        <div>
            <button type="submit" class="bg-green-400 hover:bg-green-800 mt-3 px-5 py-2 rounded-lg">Simpan</button>
            <a href="{{ route('admin.matakuliah.index') }}" class="bg-blue-400 hover:bg-blue-800 px-5 py-2 rounded-lg">Kembali</a>
        </div>
    </form>

@endsection