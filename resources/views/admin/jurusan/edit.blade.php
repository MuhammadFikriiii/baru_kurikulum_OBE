@extends('layouts.app')

@section('content')
<div class="mr-20 ml-20">
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

    <label for="nama_jurusan" class="text-xl font-semibold">Nama Jurusan:</label>
    <input type="text" class="mt-1 w-full p-3 border border-black rounded-lg mb-3" name="nama_jurusan" id="nama_jurusan" value="{{ old('nama_jurusan', $jurusan->nama_jurusan) }}" required>

    <div>
        <button type="submit" class="bg-blue-600 hover:bg-blue-800 mt-3 text-white font-bold px-5 py-2 rounded-lg">Simpan</button>
        <a href="{{ route('admin.jurusan.index') }}" class="ml-2 inline-flex text-white font-bold bg-gray-600 hover:bg-gray-700 mt-3 px-5 py-2 rounded-lg">Kembali</a>
    </div>
</form>
</div>
@endsection