@extends('layouts.app')

@section('content')

<div class="ml-20 mr-20">
    <h1 class="font-extrabold text-4xl mb-6 text-center">Edit Penilaian</h1>
    <hr class="border border-black mb-4 p-4">
    
    @if ($errors->any())
        <div class="text-red-600 mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.penilaian.edit', $penilaian->id_penilaian) }}" method="POST">
        @csrf
        @method('PUT')
        
        <label for="id_cpl" class="text-xl">Pilih CPL</label>
        <select name="id_cpl" id="id_cpl" required
         class="w-full mt-1 p-3 border border-black rounded-lg mb-4 focus:ring-blue-500 focus:border-blue-500">
            <option value="" disabled>Pilih CPL</option>
            @foreach ($cpls as $cpl)
                <option value="{{ $cpl->id_cpl }}" {{ $penilaian->id_cpl == $cpl->id_cpl ? 'selected' : '' }}>
                    {{ $cpl->deskripsi_cpl }}
                </option>
            @endforeach
        </select>

        <label for="id_mk" class="text-xl">Pilih MK</label>
        <select name="kode_mk" id="kode_mk"
        class="w-full mt-1 p-3 border border-black rounded-lg mb-4">
            <option value="" disabled>Pilih MK</option>
            @foreach ($mks as $mk)
                <option value="{{ $mk->kode_mk }}" {{ $penilaian->kode_mk == $mk->kode_mk ? 'selected' : '' }}>
                    {{ $mk->nama_mk }}
                </option>
            @endforeach
        </select>

        <label for="id_cpmk" class="text-xl">Pilih CPMK</label>
        <select name="id_cpmk" id="id_cpmk"
            class="w-full mt-1 p-3 border border-black rounded-lg mb-4">
            <option value="" disabled>Pilih CPMK</option>
            @foreach ($cpmks as $cpmk)
                <option value="{{ $cpmk->id_cpmk }}" {{ $penilaian->id_cpmk == $cpmk->id_cpmk ? 'selected' : '' }}>
                    {{ $cpmk->deskripsi_cpmk }}
                </option>
            @endforeach
        </select>

        <label for="kuis" class="text-xl">Masukkan Nilai Kuis</label>
        <input type="number" name="kuis" id="kuis" value="{{ $penilaian->kuis }}" required
            class="w-full mt-1 p-3 border border-black rounded-lg mb-4">

        <label for="observasi" class="text-xl">Masukkan Nilai Tugas</label>
        <input type="number" name="observasi" id="observasi" value="{{ $penilaian->observasi }}" required
            class="w-full mt-1 p-3 border border-black rounded-lg mb-4">

        <label for="presentasi" class="text-xl">Masukkan Nilai Presentasi</label>
        <input type="number" name="presentasi" id="presentasi" value="{{ $penilaian->presentasi }}" required
            class="w-full mt-1 p-3 border border-black rounded-lg mb-4">

        <label for="uts" class="text-xl">Masukkan Nilai UTS</label>
        <input type="number" name="uts" id="uts" value="{{ $penilaian->uts }}" required
            class="w-full mt-1 p-3 border border-black rounded-lg mb-4">

        <label for="uas" class="text-xl">Masukkan Nilai UAS</label>
        <input type="number" name="uas" id="uas" value="{{ $penilaian->uas }}" required
            class="w-full mt-1 p-3 border border-black rounded-lg mb-4">

        <label for="project" class="text-xl">Masukkan Nilai Project</label>
        <input type="number" name="project" id="project" value="{{ $penilaian->project }}" required
            class="w-full mt-1 p-3 border border-black rounded-lg mb-4">

        <div class="flex justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                Update
            </button>
            <a href="{{ route('admin.penilaian.index') }}" 
               class="bg-gray-500 hover:bg-gray-700 text-white px-6 py-2 rounded-lg">
                Kembali
            </a>
        </div>
    </form>
</div>
@endsection