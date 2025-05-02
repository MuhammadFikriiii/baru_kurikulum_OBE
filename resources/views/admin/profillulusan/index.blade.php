@extends('layouts.app')

@section('content')

<div class="mr-20 ml-20">
    <h2 class="text-2xl font-bold text-gray-700 mb-4 text-center">Daftar Profil Lulusan</h2>
    <hr class="border-t-4 border-black my-8">
    
    @if(session('success'))
    <div id="alert" class="bg-green-500 text-white px-4 py-2 rounded-md mb-4 text-center relative">
        <span class="font-bold">{{ session('success') }}</span>
        <button onclick="document.getElementById('alert').style.display='none'" class="absolute top-1 right-3 text-white font-bold text-lg">&times;</button>
    </div>
    @endif

    @if(session('sukses'))
    <div id="alert" class="bg-red-500 text-white px-4 py-2 rounded-md mb-4 text-center relative">
        <span class="font-bold">{{ session('sukses') }}</span>
        <button onclick="document.getElementById('alert').style.display='none'" class="absolute top-1 right-3 text-white font-bold text-lg">&times;</button>
    </div>
    @endif
    
    <div class="flex justify-between mb-4">
        <div class="space-x-2">
            <a href="{{ route('admin.profillulusan.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                👤 Tambah Profil Lulusan
            </a>
            <a href="{{ url('/export/profil-lulusan') }}" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                📄 Ekspor ke Excel
            </a>
        </div>
        <form method="GET" action="{{ route('admin.profillulusan.index') }}" class="flex items-center">
            <select id="prodi" name="kode_prodi" class="border border-gray-300 px-3 py-2 rounded-md mr-2" onchange="this.form.submit()">
                <option value="all" {{ $kode_prodi == 'all' ? 'selected' : '' }}>All</option>
                @foreach($prodis as $prodi)
                    <option value="{{ $prodi->kode_prodi }}" {{ $kode_prodi == $prodi->kode_prodi ? 'selected' : '' }}>
                        {{ $prodi->nama_prodi }}
                    </option>
                @endforeach
            </select>
        </form>
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
            <input type="text" id="search" placeholder="Search..." class="border border-gray-300 px-3 py-2 rounded-md">
        </div>
    </div>
    
    <div class="bg-white shadow-lg overflow-hidden">
        <table class="w-full table-fixed shadow-md rounded-lg overflow-hidden">
            <thead class="bg-green-800 text-white">
                <tr class="text-center">
                    <th class="px-4 py-2 text-center w-28">No</th>
                    <th class="px-4 py-2 text-center w-16">Kode Profil Lulusan</th>
                    <th class="px-4 py-2 text-center w-24">Prodi</th>
                    <th class="px-4 py-2 text-center w-48">Deskripsi Profil Lulusan</th>
                    <th class="px-4 py-2 text-center w-96">Profesi</th>
                    <th class="px-4 py-2 text-center w-20">Unsur</th>
                    <th class="px-4 py-2 text-center w-20">Keterangan</th>
                    <th class="px-4 py-2 text-center w-32">Sumber</th>
                    <th class="px-4 py-2 text-center w-52">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($profillulusans as $index => $profillulusan)
                    <tr class="align-top {{ $index % 2 == 0 ? 'bg-gray-100' : 'bg-white' }} hover:bg-gray-200 border-b">
                        <td class="px-4 py-2 text-center text-sm w-28 break-words">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 text-center text-sm w-28 break-words">{{ $profillulusan->kode_pl }}</td>
                        <td class="px-4 py-2 text-center text-sm w-24 break-words">{{ $profillulusan->prodi->nama_prodi ?? '-' }}</td>
                        <td class="px-4 py-2 text-sm w-48 break-words whitespace-normal ">{{ $profillulusan->deskripsi_pl }}</td>
                        <td class="px-4 py-2 text-sm w-96 break-words whitespace-pre-line">{{ $profillulusan->profesi_pl }}</td>
                        <td class="px-4 py-2 text-sm w-32 break-words">{{ $profillulusan->unsur_pl }}</td>
                        <td class="px-4 py-2 text-sm w-28 text-center break-words">{{ $profillulusan->keterangan_pl }}</td>
                        <td class="px-4 py-2 text-sm w-44 break-words">{{ $profillulusan->sumber_pl }}</td>
                        <td class="py-3 px-4 flex flex-col sm:flex-row sm:justify-center sm:items-center gap-2">
                            <a href="{{ route('admin.profillulusan.detail', $profillulusan->id_pl) }}" class="bg-green-500 text-white px-3 py-1 rounded-md text-sm font-semibold hover:bg-green-600 text-center">🛈 Detail</a>
                            <a href="{{ route('admin.profillulusan.edit', $profillulusan->id_pl) }}" class="bg-yellow-500 text-white px-3 py-1 rounded-md text-sm font-semibold hover:bg-yellow-600 text-center">✏️ Ubah</a>
                            <form action="{{ route('admin.profillulusan.destroy', $profillulusan->id_pl) }}" method="POST" onsubmit="return confirm('Hapus user ini?')" class="text-center">
                                @csrf @method('DELETE')
                                <button class="bg-red-500 text-white px-3 py-1 rounded-md text-sm hover:bg-red-600">
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