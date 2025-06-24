@extends('layouts.app')

@section('title', 'Edit Jurusan')

@section('content')
<div class="mx-20">
    <h2 class="mb-6 text-4xl font-extrabold text-center">Edit Jurusan</h2>
    <hr class="border border-black mb-4">

    <div class="bg-white p-6 rounded-lg shadow-md">

        @if ($errors->any())
            <div style="color: red;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.jurusan.update', $jurusan->id_jurusan) }}" method="POST" class="space-y-6 pt-4">
            @csrf
            @method('PUT')

            <!-- Nama Jurusan -->
            <div>
                <label for="nama_jurusan" class="block text-lg font-semibold mb-2 text-gray-700">Nama Jurusan</label>
                <input type="text" id="nama_jurusan" name="nama_jurusan" value="{{ old('nama_jurusan', $jurusan->nama_jurusan) }}"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]" required>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-end space-x-5 mt-[50px]">
                <a href="{{ route('admin.jurusan.index') }}" 
                   class="px-6 py-2 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg transition duration-200">
                    Kembali
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition duration-200">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
