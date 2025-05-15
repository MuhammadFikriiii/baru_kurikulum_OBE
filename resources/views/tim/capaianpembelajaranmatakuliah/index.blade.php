@extends('layouts.tim.app')
@section('content')

<div class="mr-20 ml-20">
    <h2 class="text-4xl font-bold text-center">Daftar CPMK</h2>
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
            <a href="{{ route('tim.capaianpembelajaranmatakuliah.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                👤 Tambah CPMK
            </a>
        </div>
        <div class="flex items-center justify-between mb-3">
        <div class="ml-auto justify-between">
            <input type="text" id="search" placeholder="Search..." 
                class="border border-gray-300 px-3 py-2 rounded-md">
        </div>
    </div>
    </div>  
    <table class="w-full border border-gray-300 shadow-md rounded-lg overflow-hidden">
        <thead class="bg-green-800 text-white border-b">
            <tr>
            <th class="py-2 px-3 text-center min-w-[10px] font-bold uppercase">No</th>
            <th class="py-2 px-3 text-center min-w-[10px] font-bold uppercase">Prodi</th>
            <th class="py-2 px-3 text-center min-w-[10px] font-bold uppercase">kode Cpmk</th>
            <th class="py-2 px-3 text-center min-w-[10px] font-bold uppercase">Deskripsi Cpmk</th>
            <th class="py-2 px-3 text-center min-w-[10px] font-bold uppercase">Aksi</th>
        </tr>
        </thead>
         @foreach($capaianpembelajaranmatakuliahs as $index => $cpmk)
        <tbody class="{{ $index % 2 == 0 ? 'bg-gray-100' : 'bg-white' }} hover:bg-gray-200 border-b">
                <tr class="border-b">
                    <td class="py-2 px-3 text-center">{{ $index + 1 }}</td>
                    <td class="py-2 px-3 text-center">{{ $cpmk->nama_prodi }}</td>
                    <td class="py-2 px-3 text-center">{{ $cpmk->kode_cpmk }}</td>
                    <td class="py-2 px-3">{{ $cpmk->deskripsi_cpmk }}</td>
                    <td class="py-2 px-3 flex justify-center items-center space-x-2">
                        <a href="{{ route('tim.capaianpembelajaranmatakuliah.detail', $cpmk->id_cpmk) }}" class="bg-green-500 font-bold text-white px-3 py-1 rounded-md hover:bg-green-600">🛈</a>
                        <a href="{{ route('tim.capaianpembelajaranmatakuliah.edit',$cpmk->id_cpmk) }}" class="bg-yellow-500 text-white font-bold px-3 py-1 rounded-md hover:bg-yellow-600">✏️</a>
                        <form action="{{ route('tim.capaianpembelajaranmatakuliah.destroy', $cpmk->id_cpmk) }}" method="POST">
                            @csrf @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600" onclick="return confirm('Hapus CPMK ini?')">
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