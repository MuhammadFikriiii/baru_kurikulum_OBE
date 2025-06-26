@extends('layouts.wadir1.app')

@section('content')
    <div class="mr-20 ml-20">
        <h2 class="text-4xl font-extrabold text-center mb-4">Detail SubCpmk</h2>
        <hr class="w-full border border-black mb-4">

        <label for="deskripsi_cpmk" class="block text-xl font-semibold">Kode SubCpmk</label>
        <input type="text" name="deskripsi_cpmk" id="deskripsi_cpmk"
            value="{{ $subcpmk->CapaianPembelajaranMataKuliah->deskripsi_cpmk }}" readonly
            class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">

        <label for="sub_cpmk" class="block text-xl font-semibold">SubCpmk</label>
        <input type="text" name="sub_cpmk" id="sub_cpmk" value="{{ $subcpmk->sub_cpmk }}" readonly
            class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">

        <label for="uraian_cpmk" class="block text-xl font-semibold">Deskripsi SubCpmk</label>
        <textarea name="uraian_cpmk" id="uraian_cpmk" readonly
            class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">{{ $subcpmk->uraian_cpmk }}</textarea>

        <a href="{{ route('wadir1.subcpmk.index') }}"
            class=" bg-gray-600 inline-flex px-5 py-2 rounded-lg hover:bg-gray-700 mt-4 text-white font-bold">
            Kembali</a>
    </div>
@endsection
