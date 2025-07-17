@extends('layouts.app')

@section('content')
    <div class="mr-20 ml-20">
        <h2 class="text-4xl font-extrabold text-center mb-4">Detail SubCpmk</h2>
        <hr class="w-full border border-black mb-4">

        <label for="kode_cpmk" class="block text-xl font-semibold">Deskripsi Cpmk</label>
        <input type="text" name="kode_cpmk" id="kode_cpmk" value="{{ $subcpmk->CapaianPembelajaranMataKuliah->kode_cpmk }}"
            readonly class="w-full p-3 border border-black rounded-lg mb-4">

        <label for="deskripsi_cpmk" class="block text-xl font-semibold">Deskripsi Cpmk</label>
        <input type="text" name="deskripsi_cpmk" id="deskripsi_cpmk"
            value="{{ $subcpmk->CapaianPembelajaranMataKuliah->deskripsi_cpmk }}" readonly
            class="w-full p-3 border border-black rounded-lg mb-4">

        <label for="sub_cpmk" class="block text-xl font-semibold">Sub Cpmk</label>
        <input type="text" name="sub_cpmk" id="sub_cpmk" value="{{ $subcpmk->sub_cpmk }}" readonly
            class="w-full p-3 border border-black rounded-lg mb-4">

        <label for="uraian_cpmk" class="block text-xl font-semibold">Deskripsi Sub Cpmk</label>
        <textarea name="uraian_cpmk" id="uraian_cpmk" readonly class="w-full p-3 border border-black rounded-lg mb-4">{{ $subcpmk->uraian_cpmk }}</textarea>

        <a href="{{ route('admin.subcpmk.index') }}"
            class=" bg-gray-600 inline-flex px-5 py-2 rounded-lg hover:bg-gray-700 mt-4 text-white font-bold">
            Kembali</a>
    </div>
@endsection
