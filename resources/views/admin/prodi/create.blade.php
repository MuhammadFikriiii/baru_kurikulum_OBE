@extends('layouts.app')

@section('content')
    <h2>Tambah Prodi</h2>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('admin.prodi.store') }}" method="POST">
        @csrf
        <label for="kode_prodi">Kode Prodi:</label>
        <input type="text" name="kode_prodi" id="kode_prodi" required>
        <br>

        <label for="kode_jurusan">Jurusan:</label>
        <select name="kode_jurusan" id="kode_jurusan" required>
            @foreach ($jurusans as $jurusan)
                <option value="{{ $jurusan->kode_jurusan }}">{{ $jurusan->nama_jurusan }}</option>
            @endforeach
        </select>
        <br>

        <label for="nama_prodi">Nama Prodi:</label>
        <input type="text" name="nama_prodi" id="nama_prodi" required>
        <br>

        <button type="submit">Simpan</button>
    </form>
@endsection