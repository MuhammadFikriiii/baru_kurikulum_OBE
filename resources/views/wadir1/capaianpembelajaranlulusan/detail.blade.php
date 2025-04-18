@extends('layouts.wadir1.app')

@section('content')

<div class="mr-20 ml-20">
    <h2 class="text-4xl font-extrabold text-center mb-4">Detail Capaian Pembelajaran Lulusan</h2>
    <hr class="w-full border border-black mb-4">

    @if($selectedProfilLulusans)
        <div class="mt-4">
            <h3 class="text-xl font-semibold mb-2">Detail Profil Lulusan Terkait:</h3>
            <ul class="list-disc pl-5 text-gray-700">
                @foreach($selectedProfilLulusans as $id_pl)
                    @php
                        $plDetail = $profilLulusans->firstWhere('id_pl', $id_pl);
                    @endphp
                    @if($plDetail)
                        <li>
                            <strong>{{ $plDetail->kode_pl }}</strong>: {{ $plDetail->deskripsi_pl }}
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    @endif
    <br>

    <label for="kode_cpl" class="block text-xl font-semibold">Kode CPL</label>
    <input type="text" name="kode_cpl" id="kode_cpl" value="{{ $id_cpl->kode_cpl }}" readonly
        class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">

    <label for="deskripsi_cpl" class="block text-xl font-semibold">Deskripsi CPL</label>
    <textarea type="text" name="deskripsi_cpl" id="deskripsi_cpl" readonly
            class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">{{ $id_cpl->deskripsi_cpl }}</textarea>

    <label for="status_cpl" class="block text-xl font-semibold">Status CPL</label>
    <input type="text" name="status_cpl" id="status_cpl" value="{{ $id_cpl->status_cpl }}" readonly
        class="w-full p-3 border border-black rounded-lg mb-10 bg-gray-100">

        <a href="{{ route('wadir1.capaianpembelajaranlulusan.index') }}" class="bg-blue-600 hover:bg-blue-800 px-4 py-2 rounded-lg text-white font-bold">Kembali</a>
</div>

@endsection