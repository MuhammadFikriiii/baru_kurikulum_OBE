@extends('layouts.app')

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

<form action="{{ route('admin.capaianprofillulusan.update', $capaianprofillulusan->id_cpl) }}" method="POST">
    
    @csrf
    @method('PUT')

    <label for="id_pls" class="text-2xl font-semibold mb-2">Profil Lulusan Terkait:</label>
    <select id="id_pls" name="id_pls[]" class="border border-gray-300 p-3 w-full rounded-lg mt-1 mb-3 focus:outline-none focus:ring-2 focus:ring-[#5460B5] focus:bg-[#f7faff]" multiple required>
        @foreach($profilLulusans as $pl)
            <option value="{{ $pl->id_pl }}"
                @if(in_array($pl->id_pl, old('id_pls', $selectedPlIds ?? []))) selected @endif
                title="{{ $pl->kode_pl }} - {{ $pl->deskripsi_pl }}">
                {{ $pl->kode_pl }} - {{ $pl->deskripsi_pl }}
            </option>
        @endforeach
    </select>
    <p class="text-sm text-gray-500 mb-2">Tekan shift/Tahan Klik mouse untuk memilih lebih dari satu.</p>    

    <label class="text-2xl" for="kode_cpl">Kode Capaian Profil Lulusan:</label>
    <input type="text" name="kode_cpl" id="kode_cpl" class="border border-black w-full rounded-lg p-3 mt-1 mb-3" value="{{ old('kode_cpl', $capaianprofillulusan->kode_cpl) }}" required>
    <br>

    <label class="text-2xl" for="deskripsi_cpl">Deskripsi Capaian Profil Lulusan:</label>
    <textarea type="text" name="deskripsi_cpl" id="deskripsi_cpl" class="border border-black w-full rounded-lg p-3 mb-3" required>{{ old('deskripsi_cpl', $capaianprofillulusan->deskripsi_cpl) }}</textarea>
    <br>

    <label class="text-2xl" for="status_cpl">Status CPL:</label>
    <select name="status_cpl" id="status_cpl" class="border border-black p-3 mt-1 w-full rounded-lg mb-3" required>
        <option value="Kompetensi Utama Bidang" {{ $capaianprofillulusan->status_cpl == "Kompetensi Utama Bidang" ? 'selected' : '' }}>Kompetensi Utama Bidang</option>
        <option value="Kompetensi Tambahan" {{ $capaianprofillulusan->status_cpl == "Kompetensi Tambahan" ? 'selected' : '' }}>Kompetensi Tambahan</option>
    </select>
    <br>
    <button type="submit" class="bg-green-400 hover:bg-green-800 px-5 py-2 rounded-lg">Simpan</button>
    <a href="{{ route('admin.capaianprofillulusan.index') }}" class="bg-blue-400 hover:bg-blue-800 rounded-lg py-2 px-5">Kembali</a>
</form>
</div>
@endsection