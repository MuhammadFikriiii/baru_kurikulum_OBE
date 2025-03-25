@extends('layouts.app')

@section('content')
<h2>Edit Prodi</h2>
<form action="{{ route('admin.prodi.update', $prodi->kode_prodi) }}" method="POST">
    @csrf
    @method('PUT')

    <select name="kode_jurusan" id="kode_jurusan">
        @foreach ($jurusans as $jurusan)
            <option value="{{ $jurusan->kode_jurusan }}" {{ $prodi->kode_jurusan == $jurusan->kode_jurusan ? 'selected' : '' }}>
                {{ $jurusan->nama_jurusan }}
            </option>
        @endforeach
    </select>    

    <label for="kode_prodi">Kode Prodi:</label>
    <input type="text" name="kode_prodi" id="kode_prodi" value="{{ old('kode_prodi', $prodi->kode_prodi) }}" required>

    <label for="nama_prodi">Nama Prodi:</label>
    <input type="text" name="nama_prodi" id="nama_prodi" value="{{ old('nama_prodi', $prodi->nama_prodi) }}" required>

    <button type="submit">Update</button>
</form>
<a href="{{ route('admin.prodi.index') }}">Kembali</a>
@endsection