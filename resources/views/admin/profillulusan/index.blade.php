@extends('layouts.app')

@section('content')
<div class="mr-20 ml-20">
    <h2 class="text-2xl font-bold text-gray-700 mb-4 text-center">Daftar Profil Lulusan</h2>
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
                <a href="{{ route('admin.profillulusan.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                    👤 Tambah Profil Lulusan
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
                    <th class="border px-4 py-2">Kode Profil Lulusan</th>
                    <th class="border px-4 py-2">Prodi</th>
                    <th class="border px-4 py-2">Deskripsi Profill Lulusan</th>
                    <th class="border px-4 py-2">Profesi</th>
                    <th class="border px-4 py-2">Unsur</th>
                    <th class="border px-4 py-2">Keterangan</th>
                    <th class="border px-4 py-2">Sumber</th>
                    <th class="border px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($profillulusans as $profillulusan)
                    <tr>
                        <td class="border px-4 py-2">{{ $profillulusan->kode_pl }}</td>
                        <td class="border px-4 py-2">{{ $profillulusan->prodi->nama_prodi }}</td>
                        <td class="border px-4 py-2">{{ $profillulusan->deskripsi_pl }}</td>
                        <td class="border px-4 py-2">{{ $profillulusan->profesi_pl }}</td>
                        <td class="border px-4 py-2">{{ $profillulusan->unsur_pl }}</td>
                        <td class="border px-4 py-2">{{ $profillulusan->keterangan_pl }}</td>
                        <td class="border px-4 py-2">{{ $profillulusan->sumber_pl }}</td>
                        <td><a href="{{ route('admin.profillulusan.edit', $profillulusan->kode_pl) }}">Edit</a>
                            <form action="{{ route('admin.profillulusan.destroy', $profillulusan->kode_pl) }}" method="POST" style="display:inline;">
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
</div>
@endsection