@extends('layouts.app')

@section('content')
    <h2>Tambah Jurusan</h2>

    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('admin.jurusan.store') }}" method="POST">
        @csrf
        <label for="kode_jurusan">Kode Jurusan:</label>
        <input type="text" name="kode_jurusan" id="kode_jurusan" required>
        
        <label for="nama_jurusan">Nama Jurusan:</label>
        <input type="text" name="nama_jurusan" id="nama_jurusan" required>

        <button type="submit">Simpan</button>
    </form>

    <a href="{{ route('admin.jurusan.index') }}">Kembali</a>
@endsection