@extends('layouts.tim.app')

@section('content')

<div class="mr-20 ml-20">
<h2 class="text-4xl font-extrabold text-center mb-4">Edit Capaian Pembelajaran Lulusan</h2>
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

<form action="{{ route('tim.capaianpembelajaranlulusan.update', $capaianpembelajaranlulusan->id_cpl) }}" method="POST">
    
    @csrf
    @method('PUT')

    <label for="id_pl" class="text-xl font-semibold mb-2">Profil Lulusan Terkait:</label>
    <select id="id_pl" name="id_pl" class="border border-black p-3 w-full rounded-lg mt-1 mb-3 focus:outline-none focus:ring-2 focus:ring-[#5460B5] focus:bg-[#f7faff]" required>
        @foreach($profilLulusans as $pl)
    <option value="{{ $pl->id_pl }}"
        @if(old('id_pl', $selectedProfilLulusans[0] ?? '') == $pl->id_pl) selected @endif
        title="{{ $pl->kode_pl }} - {{ $pl->deskripsi_pl }}">
        {{ $pl->kode_pl }} - {{ $pl->deskripsi_pl }}
    </option>
@endforeach

    </select>   

    <label class="text-xl font-semibold" for="kode_cpl">Kode Capaian Profil Lulusan:</label>
    <input type="text" name="kode_cpl" id="kode_cpl" class="border border-black w-full rounded-lg p-3 mt-1 mb-3" value="{{ old('kode_cpl', $capaianpembelajaranlulusan->kode_cpl) }}" required>
    <br>

    <label class="text-xl font-semibold" for="deskripsi_cpl">Deskripsi Capaian Profil Lulusan:</label>
    <textarea type="text" name="deskripsi_cpl" id="deskripsi_cpl" class="border border-black w-full rounded-lg p-3 mb-3 mt-2" required>{{ old('deskripsi_cpl', $capaianpembelajaranlulusan->deskripsi_cpl) }}</textarea>
    <br>

    <label class="text-xl font-semibold" for="status_cpl">Status CPL:</label>
    <select name="status_cpl" id="status_cpl" class="border border-black p-3 mt-1 w-full rounded-lg mb-6" required>
        <option value="Kompetensi Utama Bidang" {{ $capaianpembelajaranlulusan->status_cpl == "Kompetensi Utama Bidang" ? 'selected' : '' }}>Kompetensi Utama Bidang</option>
        <option value="Kompetensi Tambahan" {{ $capaianpembelajaranlulusan->status_cpl == "Kompetensi Tambahan" ? 'selected' : '' }}>Kompetensi Tambahan</option>
    </select>
    <br>
    <button type="submit" class="bg-blue-600 hover:bg-blue-800 px-5 py-2 rounded-lg text-white font-bold">Simpan</button>
    <a href="{{ route('tim.capaianpembelajaranlulusan.index') }}" class="ml-2 bg-gray-600 hover:bg-gray-800 rounded-lg py-2 px-5 text-white font-bold">Kembali</a>
</form>
</div>
@endsection