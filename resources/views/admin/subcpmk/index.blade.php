@extends('layouts.app')

@section('content')
<div class="ml-20 mr-20">
    <h1 class="text-2xl font-bold text-gray-700 mb-4 text-center">Daftar Sub Cpmk</h1>
    <hr class="border-t-4 border-black my-8">
    
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <form method="GET" action="{{ route('admin.subcpmk.index') }}" class="w-full md:w-64">
            <select name="kode_prodi" id="kode_prodi"
                class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                onchange="this.form.submit()">
                <option value="">Pilih Prodi</option>
                @foreach ($prodis as $prodi)
                    <option value="{{ $prodi->kode_prodi }}" {{ $kode_prodi == $prodi->kode_prodi ? 'selected' : '' }}>
                        {{ $prodi->nama_prodi }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

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
                <a href="{{ route('admin.subcpmk.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                    👤 Tambah Sub CPMK
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
    
        <table class="w-full border border-gray-300 shadow-md rounded-lg overflow-hidden">
            <thead class="bg-green-800 text-white border-b">
                <tr>
                    <th class="py-3 px-4 text-center w-1/12 font-bold uppercase">No</th>
                    <th class="py-3 px-4 text-center w-1/6 font-bold uppercase">CPMK</th>
                    <th class="py-3 px-4 text-center w-1/6 font-bold uppercase">SUB CPMK</th>
                    <th class="py-3 px-4 text-center w-1/6 font-bold uppercase">Uraian Sub CPMK</th>
                    <th class="py-3 px-4 text-center w-1/6 font-bold uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subcpmks as $index => $subcpmk)
                    <tr class="{{ $index % 2 == 0 ? 'bg-gray-100' : 'bg-white' }} hover:bg-gray-200 border-b">
                        <td class="py-3 px-6 w-16 text-center">{{ $index + 1 }}</td>
                        <td class="bpy-3 px-6 w-16 text-center">{{ $subcpmk->CapaianPembelajaranMataKuliah->deskripsi_cpmk ?? '-'}}</td>
                        <td class="bpy-3 px-6 w-16 text-center">{{ $subcpmk->sub_cpmk }}</td>
                        <td class="bpy-3 px-6 w-16 text-center">{{ $subcpmk->uraian_cpmk }}</td>
                        <td class="py-3 px-6 flex justify-center items-center space-x-2">
                            <a href="{{ route('admin.subcpmk.detail', $subcpmk->id_sub_cpmk) }}" class="bg-green-500 font-bold text-white px-3 py-1 rounded-md hover:bg-green-600">🛈 Detail</a>
                            <a href="{{ route('admin.subcpmk.edit',  $subcpmk->id_sub_cpmk) }}" class="bg-yellow-500 text-white font-bold px-3 py-1 rounded-md hover:bg-yellow-600">✏️ Ubah</a>
                            <form action="{{ route('admin.subcpmk.destroy', $subcpmk->id_sub_cpmk) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600" onclick="return confirm('Hapus Sub Cpmk ini?')">
                                    🗑️ Hapus
                                </button>
                            </form>
                        </td> 
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection