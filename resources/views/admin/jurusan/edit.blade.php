@extends('layouts.app')

@section('content')
<h2>Edit Jurusan</h2>
<form action="{{ route('admin.jurusan.update', $jurusan->kode_jurusan) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="kode_jurusan">Kode Jurusan:</label>
    <input type="text" name="kode_jurusan" id="kode_jurusan" value="{{ old('kode_jurusan', $jurusan->kode_jurusan) }}" required>

    <label for="nama_jurusan">Nama Jurusan:</label>
    <input type="text" name="nama_jurusan" id="nama_jurusan" value="{{ old('nama_jurusan', $jurusan->nama_jurusan) }}" required>

    <button type="submit">Update</button>
</form>
<a href="{{ route('admin.jurusan.index') }}">Kembali</a>
@endsection