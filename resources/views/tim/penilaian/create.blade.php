@extends('layouts.tim.app')
@section('content')
<div class="ml-20 mr-20">
    <h1 class="font-extrabold text-4xl mb-6 text-center">Tambah Penilaian</h1>
    <hr class="borrder border-black mb-4 p-4">
     @if ($errors->any())
        <div class="text-red-600 mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('tim.penilaian.store') }}" method="POST">
        @csrf
        <label for="id_cpl" class="text-xl">Pilih CPL</label>
        <select name="id_cpl" id="id_cpl" required
         class="w-full mt-1 p-3 border border-black rounded-lg mb-4 focus:ring-blue-500 focus:border-blue-500">
            <option value="" selected disabled>Pilih CPL</option>
            @foreach ($cpls as $cpl)
                <option value="{{ $cpl->id_cpl }}">{{ $cpl->deskripsi_cpl }}</option>
            @endforeach
        </select>

        <label for="id_mk" class="text-xl">Pilih MK</label>
        <select name="kode_mk" id="kode_mk"
        class="w-full mt-1 p-3 border border-black rounded-lg mb-4">
        <option value="" selected disabled>Pilih MK</option>
        @foreach ($mks as $mk)
            <option value="{{ $mk->kode_mk }}">{{ $mk->nama_mk }}</option>
        @endforeach
    </select>

    <label for="id_cpmk" class="text-xl">Pilih CPMK</label>
    <select name="id_cpmk" id="id_cpmk"
        class="w-full mt-1 p-3 border border-black rounded-lg mb-4">
        <option value="" selected disabled>Pilih CPMK</option>
        @foreach ($cpmks as $cpmk)
            <option value="{{ $cpmk->id_cpmk }}">{{ $cpmk->deskripsi_cpmk }}</option>
        @endforeach
    </select>

    <label for="kuis" class="text-xl">Masukkan Nilai Kuis</label>
    <input type="number" name="kuis" id="kuis" required
        class="w-full mt-1 p-3 border border-black rounded-lg mb-4">

    <label for="observasi" class="text-xl">Masukkan Nilai Tugas</label>
    <input type="number" name="observasi" id="observasi" required
        class="w-full mt-1 p-3 border border-black rounded-lg mb-4">

    <label for="presentasi" class="text-xl">Masukkan Nilai Presentasi</label>
    <input type="number" name="presentasi" id="presentasi" required
        class="w-full mt-1 p-3 border border-black rounded-lg mb-4">

    <label for="uts" class="text-xl">Masukkan Nilai UTS</label>
    <input type="number" name="uts" id="uts" required
        class="w-full mt-1 p-3 border border-black rounded-lg mb-4">

    <label for="uas" class="text-xl">Masukkan Nilai UAS</label>
    <input type="number" name="uas" id="uas" required
        class="w-full mt-1 p-3 border border-black rounded-lg mb-4">

    <label for="project" class="text-xl">Masukkan Nilai Project</label>
    <input type="number" name="project" id="project" required
        class="w-full mt-1 p-3 border border-black rounded-lg mb-4">

    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white px-6 py-2 rounded-lg">
                Simpan
            </button>
    </form>

@endsection