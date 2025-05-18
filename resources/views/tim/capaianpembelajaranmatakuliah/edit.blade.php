@extends('layouts.tim.app')

@section('content')

<div class="mr-20 ml-20">
    <h2 class="text-4xl font-extrabold text-center mb-4">Edit Capaian Pembelajaran Mata Kuliah</h2>
    <hr class="w-full border border-black mb-4">

    <form action="{{ route('tim.capaianpembelajaranmatakuliah.update', $cpmks->id_cpmk) }}" method="POST">
        @csrf
        @method('PUT')
                <label for="id_cpls" class="text-2xl font-semibold mb-2">CPL Terkait</label>
        <select id="id_cpls" name="id_cpls[]" size="2" class="border border-gray-300 p-3 w-full rounded-lg mt-1 mb-1 focus:outline-none focus:ring-2 focus:ring-[#5460B5] focus:bg-[#f7faff]" multiple required>
            @foreach($cpls as $cpl)
                <option value="{{ $cpl->id_cpl }}" {{ in_array($cpl->id_cpl, old('id_cpls', $selectedcpls)) ? 'selected' : '' }} title="{{ $cpl->kode_cpl }} - {{ $cpl->deskripsi_cpl }}">
                    {{ $cpl->kode_cpl }} - {{ $cpl->deskripsi_cpl }}
                </option>
            @endforeach
        </select>
        <p class="italic text-red-700 mb-2">*Tekan tombol Ctrl dan klik untuk memilih lebih dari satu item.</p>

        <label for="kode_mks" class="text-2xl font-semibold mb-2">MK Terkait</label>
        <select id="kode_mks" name="kode_mks[]" size="2" class="border border-gray-300 p-3 w-full rounded-lg mt-1 mb-1 focus:outline-none focus:ring-2 focus:ring-[#5460B5] focus:bg-[#f7faff]" multiple required>
            @foreach($mataKuliahs as $mk)
                <option value="{{ $mk->kode_mk }}" {{ in_array($mk->kode_mk, old('kode_mks', $selectedMKs)) ? 'selected' : '' }} title="{{ $mk->nama_mk }}">
                    {{ $mk->kode_mk }} - {{ $mk->nama_mk }}
                </option>
            @endforeach
        </select>
        <p class="italic text-red-700 mb-2">*Tekan tombol Ctrl dan klik untuk memilih lebih dari satu item.</p>

        <label for="kode_cpmk" class="text-2xl font-semibold mb-2">Kode CPMK:</label>
        <input type="text" name="kode_cpmk" id="kode_cpmk" value="{{ old('kode_cpmk', $cpmks->kode_cpmk) }}" class="border border-gray-300 p-3 w-full rounded-lg mt-1 mb-3 focus:outline-none focus:ring-2 focus:ring-[#5460B5] focus:bg-[#f7faff]" required>

        <label for="deskripsi_cpmk" class="text-2xl font-semibold mb-2">Deskripsi CPMK:</label>
        <input type="text" name="deskripsi_cpmk" id="deskripsi_cpmk" value="{{ old('deskripsi_cpmk', $cpmks->deskripsi_cpmk) }}" class="border border-gray-300 p-3 w-full rounded-lg mt-1 mb-3 focus:outline-none focus:ring-2 focus:ring-[#5460B5] focus:bg-[#f7faff]" required>

        <button type="submit" class="px-4 py-2 bg-green-400 rounded-lg hover:bg-green-600 mt-4">Simpan</button>
    </form>
</div>

@endsection