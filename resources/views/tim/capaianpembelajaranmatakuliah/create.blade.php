@extends('layouts.tim.app')
@section('content')
<div class="ml-20 mr-20">
    <h1 class="text-4xl font-extrabold mb-6 text-center">Tambah Capaian Pembelajaran Mata Kuliah</h1>
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
<form action="{{ route('tim.capaianpembelajaranmatakuliah.store') }}" method="POST">
        @csrf
        <label for="id_cpls" class="text-xl font-semibold mb-2">CPL Terkait</label>
        <select id="id_cpls" name="id_cpls[]" size="2" class="border border-gray-300 p-3 w-full rounded-lg mt-1 mb-1 focus:outline-none focus:ring-2 focus:ring-[#5460B5] focus:bg-[#f7faff]" multiple required>
        @foreach($capaianprofillulusan as $cpl)
            <option value="{{ $cpl->id_cpl }}" title="{{ $cpl->kode_cpl }} - {{ $cpl->deskripsi_cpl }}">
        {{ $cpl->kode_cpl }} - {{ $cpl->deskripsi_cpl }}
        </option>
        @endforeach
        </select>
        <p class="italic text-red-700 mb-2">*Tekan tombol Ctrl dan klik untuk memilih lebih dari satu item.</p>

        <label for="kode_mks" class="text-xl font-semibold mb-2">MK Terkait</label>
        <select id="kode_mks" name="kode_mks[]" size="2" class="border border-gray-300 p-3 w-full rounded-lg mt-1 mb-1 focus:outline-none focus:ring-2 focus:ring-[#5460B5] focus:bg-[#f7faff]" multiple required>
        @foreach($mataKuliahs as $mk)
            <option value="{{ $mk->kode_mk }}" title="{{ $mk->nama_mk }}">
        {{ $mk->kode_mk }} - {{ $mk->nama_mk }}
        </option>
        @endforeach
        </select>
        <p class="italic text-red-700 mb-2">*Tekan tombol Ctrl dan klik untuk memilih lebih dari satu item.</p>
        
        <label for="kode_cpmk" class="text-xl font-semibold">Kode CPMK</label>
        <input type="text" name="kode_cpmk" id="kode_cpmk" class="border border-black p-3 w-full rounded-lg mt-1 mb-3" required>

        <label for="deskripsi_cpmk" class="text-xl font-semibold">Deskripsi CPMK</label>
        <input type="text" name="deskripsi_cpmk" id="deskripsi_cpmk" class="border border-black p-3 w-full rounded-lg mt-1 mb-3" required>

        <button type="submit" class="px-5 py-2 bg-blue-600 rounded-lg hover:bg-blue-800 text-white font-bold mt-4">Simpan</button>
        <a href="{{ route('tim.capaianpembelajaranmatakuliah.index') }}" class="ml-2 bg-gray-600 hover:bg-gray-700 text-white font-bold px-5 py-2 rounded-lg">Kembali</a>
    </form>
</div>
@endsection