@extends('layouts.tim.app')

@section('content')

<div class="mr-20 ml-20">
    <h2 class="text-4xl font-extrabold text-center mb-4">Detail Capaian Pembelajaran Lulusan</h2>
    <hr class="w-full border border-black mb-4">

    @if($selectedCapaianProfilLulusans)
        <h3 class="text-xl font-semibold mt-6">CPL Terkait</h3>
            @foreach($selectedCapaianProfilLulusans as $id_cpl)
                @php
                    $cplDetail = $capaianprofillulusans->firstWhere('id_cpl', $id_cpl);
                @endphp
                @if($cplDetail)
                        <textarea type="text" name="kode_bk" id="kode_bk" readonly
                        class="w-full p-3 border border-black rounded-lg bg-gray-100">{{ $cplDetail->kode_cpl }} {{ $cplDetail->deskripsi_cpl }}</textarea>
                        <br>
                @endif
            @endforeach
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

        <a href="{{ route('tim.bahankajian.index') }}" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 rounded-lg text-white font-bold mt-2">Kembali</a>
</div>
@endsection