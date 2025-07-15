@extends('layouts.app')

@section('content')
    <div class="mx-20 mt-6">
        <h2 class="font-extrabold text-3xl mb-5 text-center">Detail Jurusan</h2>
        <hr class="border-t-2 md:border-t-4 border-black my-3 md:my-4 mx-auto">

        <div class="bg-white px-6 pb-6 rounded-lg shadow-md">
            <div>
                <label for="nama_jurusan" class="block text-lg font-semibold mb-2">Nama Jurusan</label>
                <input type="text" name="nama_jurusan" id="nama_jurusan" value="{{ $jurusan->nama_jurusan }}" readonly
                    class="w-full p-3 border border-black rounded-lg focus:outline-none">
            </div>

            <div>
                <label for="nama_kajur" class="block text-lg font-semibold mb-2">Nama Kajur</label>
                <input type="text" name="nama_kajur" id="nama_kajur" value="{{ $jurusan->nama_kajur }}" readonly
                    class="w-full p-3 border border-black rounded-lg focus:outline-none">
            </div>

            <div class="flex justify-start pt-6">
                <a href="{{ route('admin.jurusan.index') }}"
                    class="px-6 py-2 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg transition duration-200">
                    Kembali
                </a>
            </div>
        </div>
    </div>
@endsection
