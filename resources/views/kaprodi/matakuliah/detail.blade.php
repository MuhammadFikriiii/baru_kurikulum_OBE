@extends('layouts.kaprodi.app')

@section('content')

    <div class="mx-20 mt-6">
        <h2 class="text-3xl font-extrabold text-center mb-4">Detail Mata Kuliah</h2>
        <hr class="border-t-2 md:border-t-4 border-black my-3 md:my-4 mx-auto">

        @if ($selectedCPL)
                <h3 class="text-xl font-semibold mb-2">CPL Terkait:</h3>
                <div class="w-full p-3 border border-black rounded-lg list-disc space-y-1 bg-white shadow-sm">
                @foreach ($selectedCPL as $id_cpl)
                    @php
                        $cplDetail = $cplList->firstWhere('id_cpl', $id_cpl);
                    @endphp
                    @if ($cplDetail)
                       </strong>{{ $cplDetail->kode_cpl }}</strong>: {{ $cplDetail->deskripsi_cpl }}
                    @endif
                @endforeach
                </div>
        @endif

        @if ($selectedBK)
            <div class="mt-4">
                <h3 class="text-xl font-semibold mb-1">BK Terkait</h3>
                @foreach ($selectedBK as $id_bk)
                    @php
                        $bkDetail = $bkList->firstWhere('id_bk', $id_bk);
                    @endphp
                    @if ($bkDetail)
                        <input type="text" readonly class="w-full p-3 border border-black rounded-lg bg-gray-100 mb-2"
                            value="{{ $bkDetail->kode_bk }}: {{ $bkDetail->nama_bk }}"></input>
                    @endif
                @endforeach
            </div>
        @endif

        {{-- Detail Mata Kuliah --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-5">
            <div>
                <label for="kode_mk" class="block text-base font-semibold mb-1">Kode MK</label>
                <input type="text" id="kode_mk" value="{{ $matakuliah->kode_mk }}" readonly
                    class="w-full p-3 border border-black rounded-lg">
            </div>

            <div>
                <label for="nama_mk" class="block text-base font-semibold mb-1">Nama Mata Kuliah</label>
                <input type="text" id="nama_mk" value="{{ $matakuliah->nama_mk }}" readonly
                    class="w-full p-3 border border-black rounded-lg">
            </div>

            <div>
                <label for="jenis_mk" class="block text-base font-semibold mb-1">Jenis MK</label>
                <input type="text" id="jenis_mk" value="{{ $matakuliah->jenis_mk }}" readonly
                    class="w-full p-3 border border-black rounded-lg">
            </div>

            <div>
                <label for="sks_mk" class="block text-base font-semibold mb-1">SKS MK</label>
                <input type="number" id="sks_mk" value="{{ $matakuliah->sks_mk }}" readonly
                    class="w-full p-3 border border-black rounded-lg">
            </div>

            <div>
                <label for="semester_mk" class="block text-base font-semibold mb-1">Semester MK</label>
                <input type="text" id="semester_mk" value="{{ $matakuliah->semester_mk }}" readonly
                    class="w-full p-3 border border-black rounded-lg">
            </div>

            <div>
                <label for="kompetensi_mk" class="block text-base font-semibold mb-1">Kompetensi MK</label>
                <input type="text" id="kompetensi_mk" value="{{ $matakuliah->kompetensi_mk }}" readonly
                    class="w-full p-3 border border-black rounded-lg">
            </div>
        </div>

        {{-- Tombol Kembali --}}
        <div class="flex justify-start pt-6">
            <a href="{{ route('kaprodi.matakuliah.index') }}"
                class="px-6 py-2 bg-gray-700 hover:bg-gray-800 text-white font-semibold rounded-lg transition duration-200">
                Kembali
            </a>
        </div>
    </div>

@endsection
