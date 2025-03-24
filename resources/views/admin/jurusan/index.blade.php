@extends('layouts.app')

@section('content')
    <h2>Daftar Jurusan</h2>
    
    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <a href="{{ route('admin.jurusan.create') }}">Tambah Jurusan</a>

    <table border="1">
        <thead>
            <tr>
                <th>Kode Jurusan</th>
                <th>Nama Jurusan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jurusans as $jurusan)
                <tr>
                    <td>{{ $jurusan->kode_jurusan }}</td>
                    <td>{{ $jurusan->nama_jurusan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection