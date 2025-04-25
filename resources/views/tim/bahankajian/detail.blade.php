@extends('layouts.tim.app')

@section('content')

<div class="mr-20 ml-20">
    <h2 class="text-4xl font-extrabold text-center mb-4">Detail Capaian Pembelajaran Lulusan</h2>
    <hr class="w-full border border-black mb-4">

    @if($selectedCapaianProfilLulusans)
    <div class="mt-4 mb-4">
        <h3 class="text-xl font-semibold mb-2">Profil Lulusan yang sebelumnya terkait Terkait:</h3>
        <ul class="list-disc pl-5 text-gray-700" disabled>
            @foreach($selectedCapaianProfilLulusans as $id_cpl)
                @php
                    $cplDetail = $capaianprofillulusans->firstWhere('id_cpl', $id_cpl);
                @endphp
                @if($cplDetail)
                    <li>
                        <strong>{{ $cplDetail->kode_cpl }}</strong>: {{ $cplDetail->deskripsi_cpl }}
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
    @endif
    <br>

    <label for="kode_bk" class="block text-xl font-semibold">Kode BK</label> 
    <input type="text" name="kode_bk" id="kode_bk" value="{{ $id_bk->kode_bk }}" readonly
        class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">
        <br>

    <label for="nama_bk" class="block text-xl font-semibold">Nama BK</label> 
    <input type="text" name="nama_bk" id="nama_bk" value="{{ $id_bk->nama_bk }}" readonly
        class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">
        <br>

    <label for="deskripsi_bk" class="block text-xl font-semibold">Deskripsi BK</label> 
    <input type="text" name="deskripsi_bk" id="deskripsi_bk" value="{{ $id_bk->deskripsi_bk }}" readonly
        class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">
        <br>

    <label for="referensi_bk" class="block text-xl font-semibold">Referensi BK</label> 
    <input type="text" name="referensi_bk" id="referensi_bk" value="{{ $id_bk->referensi_bk }}" readonly
        class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">
        <br>

    <label for="status_bk" class="block text-xl font-semibold">Referensi BK</label> 
    <input type="text" name="status_bk" id="status_bk" value="{{ $id_bk->status_bk }}" readonly
        class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">
        <br>

    <label for="knowledge_area" class="block text-xl font-semibold">Referensi BK</label> 
    <input type="text" name="knowledge_area" id="knowledge_area" value="{{ $id_bk->knowledge_area }}" readonly
        class="w-full p-3 border border-black rounded-lg mb-10 bg-gray-100">
        <br>

        <a href="{{ route('tim.bahankajian.index') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-800 rounded-lg text-white font-bold mt-4">Kembali</a>
</div>
@endsection