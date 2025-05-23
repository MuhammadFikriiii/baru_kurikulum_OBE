@extends('layouts.tim.app')

@section('content')
    <div class="mr-20 ml-20">
        <h2 class="text-4xl font-extrabold text-center mb-4">Detail Penilaian</h2>
        <hr class="w-full border border-black mb-4">

        <label for="cpl" class="block text-xl font-semibold">CPL</label>
        <textarea name="cpl" id="cpl" readonly class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">{{ $penilaian->kode_cpl }} : {{ $penilaian->deskripsi_cpl }}</textarea>
        <br>

        <label for="mata_kuliah" class="block text-xl font-semibold">Mata Kuliah</label>
        <input type="text" name="mata_kuliah" id="mata_kuliah" value="{{ $penilaian->nama_mk }}" readonly
            class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">
        <br>

        <label for="cpmk" class="block text-xl font-semibold">CPMK</label>
        <textarea name="cpmk" id="cpmk" readonly class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">{{ $penilaian->deskripsi_cpmk }}</textarea>
        <br>

        <label for="kuis" class="block text-xl font-semibold">Kuis</label>
        <input type="text" name="kuis" id="kuis" value="{{ $penilaian->kuis }}" readonly
            class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">
        <br>

        <label for="observasi" class="block text-xl font-semibold">Tugas / Observasi</label>
        <input type="text" name="observasi" id="observasi" value="{{ $penilaian->observasi }}" readonly
            class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">
        <br>

        <label for="presentasi" class="block text-xl font-semibold">Presentasi</label>
        <input type="text" name="presentasi" id="presentasi" value="{{ $penilaian->presentasi }}" readonly
            class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">
        <br>

        <label for="uts" class="block text-xl font-semibold">UTS</label>
        <input type="text" name="uts" id="uts" value="{{ $penilaian->uts }}" readonly
            class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">
        <br>

        <label for="uas" class="block text-xl font-semibold">UAS</label>
        <input type="text" name="uas" id="uas" value="{{ $penilaian->uas }}" readonly
            class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">
        <br>

        <label for="project" class="block text-xl font-semibold">Project</label>
        <input type="text" name="project" id="project" value="{{ $penilaian->project }}" readonly
            class="w-full p-3 border border-black rounded-lg mb-10 bg-gray-100">
        <br>

        <a href="{{ route('tim.penilaian.index') }}"
            class="px-4 py-2 bg-gray-600 hover:bg-gray-700 rounded-lg text-white font-bold mt-2">Kembali</a>
    </div>
@endsection