@extends('layouts.tim.app')

@section('content')
    <div class="mr-20 ml-20">
        <h2 class="text-4xl font-extrabold text-center mb-4">Detail Sub CPMK</h2>
        <hr class="w-full border border-black mb-4">

        <label for="kode_cpmk" class="block text-xl font-semibold">Kode CPMK</label>
        <input type="text" name="kode_cpmk" id="kode_cpmk" value="{{ $subcpmk->kode_cpmk }}" readonly
            class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">

        <label for="deskripsi_cpmk" class="block text-xl font-semibold">Deskripsi CPMK</label>
        <textarea name="deskripsi_cpmk" id="deskripsi_cpmk" readonly
            class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">{{ $subcpmk->deskripsi_cpmk }}</textarea>

        <label for="sub_cpmk" class="block text-xl font-semibold">Sub CPMK</label>
        <input type="text" name="sub_cpmk" id="sub_cpmk" value="{{ $subcpmk->sub_cpmk }}" readonly
            class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">

        <label for="uraian_cpmk" class="block text-xl font-semibold">Uraian Sub CPMK</label>
        <textarea name="uraian_cpmk" id="uraian_cpmk" readonly
            class="w-full p-3 border border-black rounded-lg mb-10 bg-gray-100">{{ $subcpmk->uraian_cpmk }}</textarea>

        <a href="{{ route('tim.subcpmk.index') }}"
            class="px-4 py-2 bg-gray-600 hover:bg-gray-700 rounded-lg text-white font-bold mt-2">Kembali</a>
    </div>
@endsection