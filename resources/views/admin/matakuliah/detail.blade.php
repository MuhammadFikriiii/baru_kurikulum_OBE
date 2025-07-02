@extends('layouts.app')

@section('content')

<div class="mx-6 md:mx-20 mt-6 bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-3xl font-extrabold text-center mb-4">Detail Mata Kuliah</h2>
    <hr class="border-t-2 border-gray-300 my-4">

    @if($selectedCplIds)
        <div class="mb-6">
            <h3 class="text-xl font-semibold mb-2">Capaian Profil Lulusan Terkait:</h3>
            <ul class="list-disc pl-5 text-gray-700">
                @foreach($selectedCplIds as $id_cpl)
                    @php
                        $cplDetail = $capaianprofillulusans->firstWhere('id_cpl', $id_cpl);
                    @endphp
                    @if($cplDetail)
                        <li><strong>{{ $cplDetail->kode_cpl }}</strong>: {{ $cplDetail->deskripsi_cpl }}</li>
                    @endif
                @endforeach
            </ul>
        </div>
    @endif

    @if($selectedBksIds)
        <div class="mb-6">
            <h3 class="text-xl font-semibold mb-2">Bahan Kajian Terkait:</h3>
            <ul class="list-disc pl-5 text-gray-700">
                @foreach($selectedBksIds as $id_bk)
                    @php
                        $bkDetail = $bahanKajians->firstWhere('id_bk', $id_bk);
                    @endphp
                    @if($bkDetail)
                        <li><strong>{{ $bkDetail->kode_bk }}</strong>: {{ $bkDetail->nama_bk }}</li>
                    @endif
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="kode_mk" class="block text-xl font-semibold">Kode MK</label>
            <input type="text" id="kode_mk" value="{{ $matakuliah->kode_mk }}" readonly
                class="w-full p-3 border border-black rounded-lg bg-gray-100 mb-4">
        </div>

        <div>
            <label for="nama_mk" class="block text-xl font-semibold">Nama Mata Kuliah</label>
            <input type="text" id="nama_mk" value="{{ $matakuliah->nama_mk }}" readonly
                class="w-full p-3 border border-black rounded-lg bg-gray-100 mb-4">
        </div>

        <div>
            <label for="jenis_mk" class="block text-xl font-semibold">Jenis MK</label>
            <input type="text" id="jenis_mk" value="{{ $matakuliah->jenis_mk }}" readonly
                class="w-full p-3 border border-black rounded-lg bg-gray-100 mb-4">
        </div>

        <div>
            <label for="sks_mk" class="block text-xl font-semibold">SKS MK</label>
            <input type="number" id="sks_mk" value="{{ $matakuliah->sks_mk }}" readonly
                class="w-full p-3 border border-black rounded-lg bg-gray-100 mb-4">
        </div>

        <div>
            <label for="semester_mk" class="block text-xl font-semibold">Semester MK</label>
            <input type="text" id="semester_mk" value="{{ $matakuliah->semester_mk }}" readonly
                class="w-full p-3 border border-black rounded-lg bg-gray-100 mb-4">
        </div>

        <div>
            <label for="kompetensi_mk" class="block text-xl font-semibold">Kompetensi MK</label>
            <input type="text" id="kompetensi_mk" value="{{ $matakuliah->kompetensi_mk }}" readonly
                class="w-full p-3 border border-black rounded-lg bg-gray-100 mb-4">
        </div>
    </div>

    <div class="flex justify-start pt-6">
        <a href="{{ route('admin.matakuliah.index') }}"
           class="px-6 py-2 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg transition duration-200">
            Kembali
        </a>
    </div>
</div>

@endsection
