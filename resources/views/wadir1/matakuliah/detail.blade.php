@extends('layouts.wadir1.app')

@section('content')

<div>
    <h2 class="text-2xl font-bold text-center">Detail Matakuliah</h2>
    <hr class="border-t-2 border-gray-300 my-4">

    @if($selectedCplIds)
        <div class="mt-4">
            <h3 class="text-xl font-semibold mb-2">Capaian Profil Lulusan Terkait:</h3>
            <ul class="list-disc pl-5 text-gray-700">
                @foreach($selectedCplIds as $id_cpl)
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

    @if($selectedBksIds)
        <div class="mt-4">
            <h3 class="text-xl font-semibold mb-2">Bahan Kajian Terkait:</h3>
            <ul class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">
                @foreach($selectedBksIds as $id_bk)
                    @php
                        $bkDetail = $bahanKajians->firstWhere('id_bk', $id_bk);
                    @endphp
                    @if($bkDetail)
                        <li>
                            <strong>{{ $bkDetail->kode_bk }}</strong>: {{ $bkDetail->nama_bk }}
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    @endif

    <label for="kode_mk" class="block text-xl font-semibold">Kode MK</label> 
    <input type="text" name="kode_mk" id="kode_mk" value="{{ $matakuliah->kode_mk }}" readonly
        class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">
        <br>

    <label for="nama_mk" class="block text-xl font-semibold">Nama MataKuliah</label>
        <input type="text" name="nama_mk" id="nama_mk" value="{{ $matakuliah->nama_mk }}" readonly
        class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">
        <br>

    <label for="jenis_mk" class="block text-xl font-semibold">Jenis MK</label>
        <input type="text" name="jenis_mk" id="jenis_mk" value="{{ $matakuliah->jenis_mk }}" readonly
        class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">
        <br>

    <label for="sks_mk" class="block text-xl font-semibold">SKS MK</label>
        <input type="number" name="sks_mk" id="sks_mk" value="{{ $matakuliah->sks_mk }}" readonly
        class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">
        <br>

    <label for="semester_mk" class="block text-xl font-semibold">Semester MK</label>
        <input type="text" name="semester_mk" id="semester_mk" value="{{ $matakuliah->semester_mk }}" readonly
        class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">
        <br>

    <label for="kompetensi_mk" class="block text-xl font-semibold">kompetensi MK</label>
        <input type="text" name="kompetensi_mk" id="kompetensi_mk" value="{{ $matakuliah->kompetensi_mk }}" readonly
        class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">
        <br>

    <a href="{{ route('wadir1.matakuliah.index') }}" class="bg-blue-600 hover:bg-blue-800 rounded-lg px-4 py-2">Kembali</a>
</div>

@endsection