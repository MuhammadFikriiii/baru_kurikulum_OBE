@extends('layouts.app')

@section('content')

<div class="mr-20 ml-20">
    <h2 class="text-4xl font-extrabold text-center mb-4">Detail SubCpmk</h2>
    <hr class="w-full border border-black mb-4">

    <label for="deskripsi_cpmk" class="block text-xl font-semibold">Kode SubCpmk</label>
    <input type="text" name="deskripsi_cpmk" id="deskripsi_cpmk" value="{{ $subcpmk->CapaianPembelajaranMataKuliah->deskripsi_cpmk }}" readonly
        class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">

    <label for="sub_cpmk" class="block text-xl font-semibold">SubCpmk</label>
    <input type="text" name="sub_cpmk" id="sub_cpmk" value="{{ $subcpmk->sub_cpmk }}" readonly
        class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">

    <label for="uraian_cpmk" class="block text-xl font-semibold">Deskripsi SubCpmk</label>
    <textarea name="uraian_cpmk" id="uraian_cpmk" readonly
        class="w-full p-3 border border-black rounded-lg mb-8 bg-gray-100">{{ $subcpmk->uraian_cpmk }}</textarea>

    <a href="{{ route('admin.subcpmk.index') }}" class="bg-blue-400 hover:bg-blue-600 rounded-lg px-4 py-2">Kembali</a>
</div>
@endsection