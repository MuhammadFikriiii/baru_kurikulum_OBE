@extends('layouts.app')

@section('content')
<div class="mx-20">
<h2 class="font-extrabold text-4xl mb-6 text-center">Edit Jurusan</h2>
<hr class="border border-black mb-4">
@if ($errors->any())
    <div style="color: red;">
       <ul>
            @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('admin.jurusan.update', $jurusan->id_jurusan) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="nama_jurusan" class="block text-lg font-semibold mb-2 text-gray-700">Nama Jurusan:</label>
    <input type="text" 
    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" name="nama_jurusan" id="nama_jurusan" value="{{ old('nama_jurusan', $jurusan->nama_jurusan) }}" required>

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
@endsection