@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-semibold mb-4">Daftar Program Studi</h2>
    
    @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded-md mb-4">
            {{ session('success') }}
        </div>
    @endif
    
    <a href="{{ route('admin.prodi.create') }}">Tambah Prodi</a>
    
    <div class="">
        <table class="">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border px-4 py-2">Kode Prodi</th>
                    <th class="border px-4 py-2">Nama Prodi</th>
                    <th class="border px-4 py-2">Jurusan</th>
                    <th class="border px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($prodis as $prodi)
                    <tr>
                        <td class="border px-4 py-2">{{ $prodi->kode_prodi }}</td>
                        <td class="border px-4 py-2">{{ $prodi->nama_prodi }}</td>
                        <td class="border px-4 py-2">{{ $prodi->jurusan->nama_jurusan }}</td>
                        <td><a href="{{ route('admin.prodi.edit', $prodi->kode_prodi) }}">Edit</a>
                            <form action="{{ route('admin.prodi.destroy', $prodi->kode_prodi) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection