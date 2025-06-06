@extends('layouts.app')

@section('content')
<div class=" mx-20">
    <h2 class="font-extrabold text-4xl mb-6 text-center">Tambah Jurusan</h2>
    <hr class="w-full border border-black mb-4">

@if ($errors->any())
    <div style="color: red;">
       <ul>
            @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form action="{{ route('admin.jurusan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
        <label for="nama_jurusan" class="text-xl font-semibold">Nama Jurusan:</label>
        <input type="text" class="mt-1 w-full p-3 border border-black rounded-lg focus:ring-blue-500 focus:border-blue-500" name="nama_jurusan" id="nama_jurusan" required>
       </div>
       <div>
        <button type="submit" class="bg-blue-600 hover:bg-blue-800 mt-3 px-5 py-2 rounded-lg text-white font-bold">Simpan</button>
        <a href="{{ route('admin.jurusan.index') }}" class="ml-2 bg-gray-600 hover:bg-gray-700 text-white font-bold mt-3 px-5 py-2 rounded-lg">Kembali</a>
       </div>
    </form>
</div>
@endsection