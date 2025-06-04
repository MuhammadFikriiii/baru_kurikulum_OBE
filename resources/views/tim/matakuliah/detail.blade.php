@extends('layouts.tim.app')

@section('content')
    <div class="mr-20 ml-20">
        <h1 class="text-2xl font-semibold text-gray-700 mb-4 text-center">Detail Mata Kuliah</h1>
        <hr class="w-full border border-black mb-4">
        @if ($selectedCPL)
            <div class="mt-4">
                <h3 class="text-xl font-semibold mb-2">CPL Terkait:</h3>
                <div class="w-full bg-gray-100 border border-black rounded-lg px-4 py-3 space-y-2">
                    @foreach ($selectedCPL as $id_cpl)
                        @php
                            $cplDetail = $cplList->firstWhere('id_cpl', $id_cpl);
                        @endphp
                        @if ($cplDetail)
                            <div>{{ $cplDetail->kode_cpl }}: {{ $cplDetail->deskripsi_cpl }}</div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif

        @if ($selectedBK)
            <div class="mt-4">
                <h3 class="text-xl font-semibold mb-1">BK Terkait</h3>
                <div class="w-full bg-gray-100 border border-black rounded-lg px-4 py-3 space-y-2">
                    @foreach ($selectedBK as $id_bk)
                        @php
                            $bkDetail = $bkList->firstWhere('id_bk', $id_bk);
                        @endphp
                        @if ($bkDetail)
                            <div>{{ $bkDetail->kode_bk }}: {{ $bkDetail->nama_bk }}</div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif

        <label for="kode_mk" class="text-xl font-semibold">Kode MK</label>
        <input type="text" name="kode_mk" id="kode_mk" value="{{ $matakuliah->kode_mk }}" readonly
            class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">
        <label for="nama_mk" class="text-xl font-semibold">Nama MK</label>
        <input type="text" name="nama_mk" id="nama_mk" value="{{ $matakuliah->nama_mk }}" readonly
            class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">
        <label for="jenis_mk" class="text-xl font-semibold">Jenis MK</label>
        <input type="jenis_mk" name="jenis_mk" id="jenis_mk" value="{{ $matakuliah->jenis_mk }}" readonly
            class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">
        <label for="sks_mk" class="text-xl font-semibold">Sks MK</label>
        <input type="text" name="sks_mk" id="sks_mk" value="{{ $matakuliah->sks_mk }}" readonly
            class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">
        <label for="semester_mk" class="text-xl font-semibold">Semester MK</label>
        <input type="text" name="semester_mk" id="semester_mk" value="{{ $matakuliah->semester_mk }}" readonly
            class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">
        <label for="kompetensi_mk" class="text-xl font-semibold">Kompetensi MK</label>
        <input type="text" name="kompetensi_mk" id="kompetensi_mk" value="{{ $matakuliah->kompetensi_mk }}" readonly
            class="w-full p-3 border border-black rounded-lg mb-8 bg-gray-100">

        <a href="{{ route('tim.matakuliah.index') }}"
            class="bg-gray-600 hover:bg-gray-700 px-4 py-2 rounded-lg text-white font-semibold">Kembali</a>
    </div>
@endsection
