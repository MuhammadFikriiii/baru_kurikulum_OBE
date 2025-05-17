@extends('layouts.tim.app')

@section('content')
<div class="mr-20 ml-20">
    <h2 class="text-2xl font-bold text-gray-700 mb-4 text-center">Daftar Bahan Kajian</h2>
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
            <a href="{{ route('tim.bahankajian.create') }}" class="bg-green-600 h-10 font-bold text-white px-5 inline-flex items-center py-2 rounded-md hover:bg-green-800">
                Tambah
            </a>
        </div>
        <div class="ml-auto justify-between">
            <input type="text" id="search" placeholder="Search..." 
                class="border border-black px-3 py-2 rounded-md">
        </div>
    </div>

    <div class="bg-white shadow-lg overflow-hidden">
        <table class="w-full border border-gray-300 shadow-md rounded-lg overflow-hidden">
            <thead class="bg-green-800 text-white border-b">
                <tr>
                    <th class="py-3 px-4 text-center min-w-[10px] font-bold uppercase ">No.</th>
                    <th class="py-3 px-6 text-center min-w-[10px] font-bold uppercase">Prodi</th>
                    <th class="py-3 px-6 text-center min-w-[10px] font-bold uppercase">Kode BK</th>
                    <th class="py-3 px-6 text-center min-w-[10px] font-bold uppercase">Nama BK</th>
                    <th class="py-3 px-6 text-center min-w-[10px] font-bold uppercase">Deskripsi BK</th>
                    <th class="py-3 px-6 text-center min-w-[10px] font-bold uppercase">Referensi BK</th>
                    <th class="py-3 px-6 text-center min-w-[10px] font-bold uppercase">Status BK</th>
                    <th class="py-3 px-6 text-center min-w-[10px] font-bold uppercase">Knowledge Area</th>
                    <th class="py-3 px-6 font-bold uppercase text-center min-w-[10px]">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bahankajians as $index => $bahankajian)
                <tr class="{{ $index % 2 == 0 ? 'bg-gray-100' : 'bg-white' }} hover:bg-gray-200 border-b">
                    <td class="py-3 px-6 text-center min-w-[10px]">{{ $index + 1 }}</td>
                    <td class="py-3 px-6 text-center min-w-[10px]">{{ $bahankajian->nama_prodi }}</td>
                    <td class="py-3 px-6 text-center min-w-[10px]">{{ $bahankajian->kode_bk }}</td>
                    <td class="py-3 px-6 text-center min-w-[10px]">{{ $bahankajian->nama_bk }}</td>
                    <td class="py-3 px-6 text-center min-w-[10px]">{{ $bahankajian->deskripsi_bk }}</td>
                    <td class="py-3 px-6 text-center min-w-[10px]">{{ $bahankajian->referensi_bk }}</td>
                    <td class="py-3 px-6 text-center min-w-[10px]">{{ $bahankajian->status_bk }}</td>
                    <td class="py-3 px-6 text-center min-w-[10px]">{{ $bahankajian->knowledge_area }}</td>
                    <td class="py-3 px-6 flex justify-center min-w-[10px] items-center space-x-2">
                        <a href="{{ route('tim.bahankajian.detail', $bahankajian->id_bk) }}"class="bg-gray-600 font-bold text-white px-5 py-2 rounded-md hover:bg-gray-700">🛈</a>
                        <a href="{{ route('tim.bahankajian.edit', $bahankajian->id_bk) }}"  class="bg-blue-600 text-white font-bold px-5 py-2 rounded-md hover:bg-blue-800">✏️</a>
                        <form action="{{ route('tim.bahankajian.destroy', $bahankajian->id_bk) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="bg-red-500 text-white px-5 py-2 rounded-md hover:bg-red-600" onclick="return confirm('Hapus BK ini?')">
                                🗑️
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection