@extends('layouts.app')

@section('content')
<h1>Daftar Jurusan</h1>
<a href="{{ route('jurusan.create') }}">Tambah Jurusan</a>

<table border="1">
    <tr>
        <th>Kode</th>
        <th>Nama Jurusan</th>
        <th>Aksi</th>
    </tr>
    @foreach ($jurusans as $jurusan)
    <tr>
        <td>{{ $jurusan->kode_jurusan }}</td>
        <td>{{ $jurusan->nama_jurusan }}</td>
        <td>
            <a href="{{ route('jurusan.edit', $jurusan) }}">Edit</a>
            <form action="{{ route('jurusan.destroy', $jurusan) }}" method="POST" style="display:inline;">
                @csrf @method('DELETE')
                <button type="submit">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection