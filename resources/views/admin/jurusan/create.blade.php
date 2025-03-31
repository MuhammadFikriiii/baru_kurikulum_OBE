@extends('layouts.app')

@section('content')
<div class=" ml-20  mr-20 container w-full">
    <h2 class="font-extrabold text-4xl mb-6 text-center">Tambah Jurusan</h2>
    <hr class="w-full border border-black mb-4">

    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('admin.jurusan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
        <label for="kode_jurusan" class="text-2xl">Kode Jurusan:</label>
        <input type="text" class="mt-1 w-full p-3 border border-black rounded-lg focus:ring-blue-500 focus:border-blue-500" name="kode_jurusan" id="kode_jurusan" required>
        </div>
        <div class="mb-3">
        <label for="nama_jurusan" class="text-2xl">Nama Jurusan:</label>
        <input type="text" class="mt-1 w-full p-3 border border-black rounded-lg focus:ring-blue-500 focus:border-blue-500" name="nama_jurusan" id="nama_jurusan" required>
       </div>
       <div>
        <button type="submit" class="btn btn-primary bg-green-400 hover:bg-green-800 mt-3 px-5 py-2 rounded-lg">Simpan</button>
        <a href="{{ route('admin.jurusan.index') }}" class="bg-blue-400 hover:bg-blue-800 mt-3 px-5 py-2 rounded-lg">Kembali</a>
       </div>
    </form>
</div>
@endsection