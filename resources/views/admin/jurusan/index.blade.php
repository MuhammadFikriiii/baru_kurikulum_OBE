@extends('layouts.app')

@section('content')
<div class="mr-20 ml-20">
    <h1 class="text-2xl font-bold text-gray-700 mb-4 text-center">Daftar Jurusan</h1>

    <hr class="border-t-4 border-black my-8">
        @if(session('success'))
        <div id="alert" class="bg-green-500 text-white px-4 py-2 rounded-md mb-4 text-center relative">
            <span class="font-bold">{{ session('success') }}</span>
            <button onclick="document.getElementById('alert').style.display='none'"
                class="absolute top-1 right-3 text-white font-bold text-lg">
                &times;
            </button>
        </div>
        @endif

        @if(session('sukses'))
        <div id="alert" class="bg-red-500 text-white px-4 py-2 rounded-md mb-4 text-center relative">
            <span class="font-bold">{{ session('sukses') }}</span>
            <button onclick="document.getElementById('alert').style.display='none'"
                class="absolute top-1 right-3 text-white font-bold text-lg">
                &times;
            </button>
        </div>
        @endif

        <div class="flex justify-between mb-4">
            <div class="space-x-2">
                <a href="{{ route('admin.jurusan.create') }}" class="bg-green-600 inline-flex text-white px-5 py-2 rounded-md hover:bg-green-800 font-bold">
                    Tambah
                </a>
            </div>
            <div class="ml-auto justify-between">
                <input type="text" id="search" placeholder="Search..." 
                    class="border border-black px-3 py-2 rounded-md">
            </div>
        </div>

    <table class="w-full border border-gray-300 shadow-md rounded-lg overflow-hidden">
        <thead class="bg-green-800 text-white border-b">
            <tr>
                <th class="py-3 px-6 text-center min-w-[10px] font-bold uppercase">No</th>
                <th class="py-3 px-6 text-center min-w-[10px] font-bold uppercase">Nama Jurusan</th>
                <th class="py-3 px-6 text-center min-w-[10px] font-bold uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jurusans as $index => $jurusan)
                <tr class="{{ $index % 2 == 0 ? 'bg-gray-100' : 'bg-white' }} hover:bg-gray-200 border-b">
                    <td class="py-3 px-6 min-w-[10px] text-center">{{ $index + 1 }}</td>
                    <td class="py-3 px-6 min-w-[10px] text-center">{{ $jurusan->nama_jurusan }}</td>
                    <td class="py-3 px-6 min-w-[10px] flex justify-center items-center space-x-2">
                        <a href="{{ route('admin.jurusan.detail', $jurusan->id_jurusan) }}" class="bg-gray-600 font-bold text-white px-5 py-2 rounded-md hover:bg-gray-700">🛈</a>
                        <a href="{{ route('admin.jurusan.edit', $jurusan->id_jurusan) }}" class="bg-blue-600 text-white font-bold px-5 py-2 rounded-md hover:bg-blue-800">✏️</a>
                        <form action="{{ route('admin.jurusan.destroy', $jurusan->id_jurusan) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="bg-red-600 text-white px-5 py-2 rounded-md hover:bg-red-800" onclick="return confirm('Hapus jurusan ini?')">
                                🗑️
                            </button>
                        </form>
                    </td>                    
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection