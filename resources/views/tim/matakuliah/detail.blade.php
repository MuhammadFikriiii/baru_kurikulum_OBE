@extends('layouts.tim.app')

@section('content')
<div class="mr-20 ml-20">
<h1 class="text-2xl font-bold text-gray-700 mb-4 text-center">Detail Mata Kuliah</h1>
<hr class="w-full border border-black mb-4">
@if ($selectedCPL)
    <div class="mt-4">
        <h3 class="text-xl font-semibold mb-2">CPL Terkait:</h3>
        @foreach($selectedCPL as $id_cpl)
            @php
                $cplDetail = $cplList->firstWhere('id_cpl', $id_cpl);
            @endphp
            @if($cplDetail)
                <textarea 
                    type="text" 
                    readonly 
                    class="w-full p-3 border border-black rounded-lg bg-gray-100 mb-2"
                >{{ $cplDetail->kode_cpl }}: {{ $cplDetail->deskripsi_cpl }}</textarea>
            @endif
        @endforeach
    </div>
@endif

@if ($selectedBK)
    <div class="mt-4">
        <h3 class="text-xl font-semibold mb-1">BK Terkait</h3>
        @foreach($selectedBK as $id_bk)
            @php
                $bkDetail = $bkList->firstWhere('id_bk', $id_bk);
            @endphp
            @if($bkDetail)
                <input 
                    type="text" 
                    readonly 
                    class="w-full p-3 border border-black rounded-lg bg-gray-100 mb-2" value="{{ $bkDetail->kode_bk }}: {{ $bkDetail->nama_bk }}"
                ></input>
            @endif
        @endforeach
    </div>
@endif

<label for="kode_mk" class="text-xl font-bold">Kode MK</label>
<input type="text" name="kode_mk" id="kode_mk" value="{{ $matakuliah->kode_mk }}" readonly
    class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">
<label for="nama_mk" class="text-xl font-bold">Nama MK</label>
<input type="text" name="nama_mk" id="nama_mk" value="{{ $matakuliah->nama_mk }}" readonly
    class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">
<label for="jenis_mk" class="text-xl font-bold">Jenis MK</label>
<input type="jenis_mk" name="jenis_mk" id="jenis_mk" value="{{ $matakuliah->jenis_mk }}" readonly
    class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">
<label for="sks_mk" class="text-xl font-bold">Sks MK</label>
<input type="text" name="sks_mk" id="sks_mk" value="{{ $matakuliah->sks_mk }}" readonly
    class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">
<label for="semester_mk" class="text-xl font-bold">Semester MK</label>
<input type="text" name="semester_mk" id="semester_mk" value="{{ $matakuliah->semester_mk }}" readonly
    class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">
<label for="kompetensi_mk" class="text-xl font-bold">Kompetensi MK</label>
<input type="text" name="kompetensi_mk" id="kompetensi_mk" value="{{ $matakuliah->kompetensi_mk }}" readonly
    class="w-full p-3 border border-black rounded-lg mb-8 bg-gray-100">

<a href="{{ route('tim.matakuliah.index') }}" class="bg-gray-600 hover:bg-gray-700 px-4 py-2 rounded-lg text-white font-bold">Kembali</a>
</div>
@endsection