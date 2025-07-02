@extends('layouts.app')

@section('content')

<div class="mx-20 mt-6">
    <h2 class="text-3xl font-extrabold text-center mb-4">Detail Mata Kuliah</h2>
    <hr class="border-t-2 md:border-t-4 border-black my-3 md:my-4 mx-auto">

    {{-- CPL Terkait --}}
    @if($selectedCplIds)
        <div class="mb-8">
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Capaian Profil Lulusan Terkait</h3>
            <ul class="list-disc pl-6 text-gray-700 space-y-1">
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

    {{-- Bahan Kajian Terkait --}}
    @if($selectedBksIds)
        <div class="mb-8">
            <h3 class="text-xl font-semibold text-gray-800 mb-2">Bahan Kajian Terkait</h3>
            <ul class="list-disc pl-6 text-gray-700 space-y-1">
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

    {{-- Detail Mata Kuliah --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-white p-6 rounded-lg shadow-md">
        <div>
            <label for="kode_mk" class="block text-base font-semibold mb-1">Kode MK</label>
            <input type="text" id="kode_mk" value="{{ $matakuliah->kode_mk }}" readonly
                class="w-full p-3 border border-black rounded-lg bg-gray-100">
        </div>

        <div>
            <label for="nama_mk" class="block text-base font-semibold mb-1">Nama Mata Kuliah</label>
            <input type="text" id="nama_mk" value="{{ $matakuliah->nama_mk }}" readonly
                class="w-full p-3 border border-black rounded-lg bg-gray-100">
        </div>

        <div>
            <label for="jenis_mk" class="block text-base font-semibold mb-1">Jenis MK</label>
            <input type="text" id="jenis_mk" value="{{ $matakuliah->jenis_mk }}" readonly
                class="w-full p-3 border border-black rounded-lg bg-gray-100">
        </div>

        <div>
            <label for="sks_mk" class="block text-base font-semibold mb-1">SKS MK</label>
            <input type="number" id="sks_mk" value="{{ $matakuliah->sks_mk }}" readonly
                class="w-full p-3 border border-black rounded-lg bg-gray-100">
        </div>

        <div>
            <label for="semester_mk" class="block text-base font-semibold mb-1">Semester MK</label>
            <input type="text" id="semester_mk" value="{{ $matakuliah->semester_mk }}" readonly
                class="w-full p-3 border border-black rounded-lg bg-gray-100">
        </div>

        <div>
            <label for="kompetensi_mk" class="block text-base font-semibold mb-1">Kompetensi MK</label>
            <input type="text" id="kompetensi_mk" value="{{ $matakuliah->kompetensi_mk }}" readonly
                class="w-full p-3 border border-black rounded-lg bg-gray-100">
        </div>
    </div>

    {{-- Tombol Kembali --}}
    <div class="flex justify-start pt-6">
        <a href="{{ route('admin.matakuliah.index') }}"
           class="px-6 py-2 bg-gray-700 hover:bg-gray-800 text-white font-semibold rounded-lg transition duration-200">
            Kembali
        </a>
    </div>
</div>

@endsection
