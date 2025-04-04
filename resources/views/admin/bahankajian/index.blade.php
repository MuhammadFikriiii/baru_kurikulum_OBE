@extends('layouts.app')

@section('content')
<div class="mr-20 ml-20">
    <h2 class="text-2xl font-bold text-gray-700 mb-4 text-center">Daftar Bahan Kajian</h2>
   <hr class="border-t-4 border-black my-8">

    <div class="flex justify-between mb-4">
        <div class="space-x-2">
            <a href="{{ route('admin.bahankajian.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                👤 Tambah Capaian Profil Lulusan
            </a>
            <a href="" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                📄 Ekspor ke Excel
            </a>
        </div>
    </div>
    
    <div class="flex items-center justify-between mb-3">
        <label for="entries" class="text-gray-600 mr-2">Show</label>
        <select id="entries" class="border border-gray-300 px-3 py-2 rounded-md mr-2">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
        <span class="text-gray-600">entries</span>
        <div class="ml-auto justify-between">
            <input type="text" id="search" placeholder="Search..." 
                class="border border-gray-300 px-3 py-2 rounded-md">
        </div>
    </div>
    <div class="bg-white shadow-lg overflow-hidden">
        <table class="w-full border border-gray-300 shadow-md rounded-lg overflow-hidden">
            <thead class="bg-green-800 text-white border-b">
                <tr>
                    <th class="py-3 px-4 text-center w-16 font-bold uppercase ">No.</th>
                    <th class="py-3 px-6 text-center w-1/3 font-bold uppercase">Kode BK</th>
                    <th class="py-3 px-6 text-center w-1/3 font-bold uppercase">Nama BK</th>
                    <th class="py-3 px-6 text-center w-1/4 font-bold uppercase">Deskripsi BK</th>
                    <th class="py-3 px-6 text-center w-1/6 font-bold uppercase">Referensi BK</th>
                    <th class="py-3 px-6 text-center w-1/6 font-bold uppercase">Status BK</th>
                    <th class="py-3 px-6 text-center w-1/6 font-bold uppercase">Knowledge Area</th>
                    <th class="py-3 px-6 text-center w-1/6 font-bold uppercase">Max BK</th>
                    <th class="py-3 px-6 text-center w-1/6 font-bold uppercase">Min BK</th>
                    <th class="py-3 px-6 w-1/4 font-bold uppercase text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bahankajians as $index => $bahankajian)
                <tr class="{{ $index % 2 == 0 ? 'bg-gray-100' : 'bg-white' }} hover:bg-gray-200 border-b">
                    <td class="py-3 px-6 w-16 text-center">{{ $index + 1 }}</td>
                    <td class="py-3 px-6 w-1/4 text-center">{{ $bahankajian->kode_bk }}</td>
                    <td class="py-3 px-6 w-1/8 text-center">{{ $bahankajian->nama_bk }}</td>
                    <td class="py-3 px-6 w-1/4 text-center">{{ $bahankajian->deskripsi_bk }}</td>
                    <td class="py-3 px-6 w-1/8 text-center">{{ $bahankajian->referensi_bk }}</td>
                    <td class="py-3 px-6 w-1/8 text-center">{{ $bahankajian->status_bk }}</td>
                    <td class="py-3 px-6 w-1/8 text-center">{{ $bahankajian->knowledge_area }}</td>
                    <td class="py-3 px-6 w-1/8 text-center">{{ $bahankajian->max_bk }}</td>
                    <td class="py-3 px-6 w-1/8 text-center">{{ $bahankajian->min_bk }}</td>
                    <td class="py-3 px-6 flex justify-center items-center space-x-2">
                        <a href="#"class="bg-green-500 font-bold text-white px-3 py-1 rounded-md hover:bg-green-600">🛈 Detail</a>
                        <a href="{{ route('admin.bahankajian.edit', $bahankajian->kode_bk) }}"  class="bg-yellow-500 text-white font-bold px-3 py-1 rounded-md hover:bg-yellow-600">✏️ Ubah</a>
                        <form action="{{ route('admin.bahankajian.destroy', $bahankajian->kode_bk) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600" onclick="return confirm('Hapus user ini?')">
                                🗑️ Hapus
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