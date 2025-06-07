@extends('layouts.app')

@section('content')
<div class="mr-20 ml-20">
    <h2 class="text-4xl font-extrabold text-center mb-4">Detail Jurusan</h2>
    <hr class="w-full border border-black mb-4">

    <label for="nama_jurusan" class="block text-lg font-semibold mb-2 text-gray-700">Nama Jurusan</label>
    <input type="text" name="nama_jurusan" id="nama_jurusan" value="{{ $jurusan->nama_jurusan }}" readonly
        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">

        <div class="flex justify-end space-x-5 mt-[50px]">
            <a href="{{ route('admin.jurusan.index') }}" 
            class="px-6 py-2 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg transition duration-200">
            Kembali
        </a>
</div>
@endsection