@extends('layouts.app')

@section('content')

<div class="mr-20 ml-20">
    <h1 class="text-2xl font-bold text-gray-700 mb-4 text-center">Daftar Mata Kuliah</h1>
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
        <a href="{{ route('admin.matakuliah.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
            👤 Tambah MataKuliah
        </a>
        <a href="" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
            📄 Ekspor ke Excel
        </a>
    </div>
    <form method="GET" action="{{ route('admin.matakuliah.index') }}">
        <select name="kode_prodi" onchange="this.form.submit()" class="border border-gray-300 px-3 py-2 rounded-md mr-2">
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
        <input type="text" id="search" placeholder="Search..." 
            class="border border-gray-300 px-3 py-2 rounded-md">
    </div>
</div>

<table class="w-full border border-gray-300 shadow-md rounded-lg overflow-hidden">
    <thead class="bg-green-800 text-white border-b">
            <tr>
                <th class="py-2 px-3 text-center min-w-[10px] font-bold uppercase truncate">No</th>
                <th class="py-2 px-3 text-center min-w-[10px] font-bold uppercase">Prodi</th>
                <th class="py-2 px-3 text-center min-w-[10px] font-bold uppercase">Kode MK</th>
                <th class="py-2 px-3 text-center min-w-[10px] font-bold uppercase">Nama MK</th>
                <th class="py-2 px-3 text-center min-w-[10px] font-bold uppercase">Jenis MK</th>
                <th class="py-2 px-3text-center min-w-[10px] font-bold uppercase">Sks MK</th>
                @for ($i = 1; $i <= 8; $i++)
                <th class="py-2 px-3 min-w-[10px]">Semester {{ $i }}</th>
                @endfor
                <th class="py-2 px-3 text-center min-w-[10px] font-bold uppercase">kompetensi MK</th>
                <th class="py-2 px-3 text-center min-w-[20px] font-bold uppercase">Aksi</th>
            </tr>
    </thead>
    <tbody>
        @foreach ($mata_kuliahs as $index => $mata_kuliah)
        <tr class="{{ $index % 2 == 0 ? 'bg-gray-100' : 'bg-white' }} hover:bg-gray-200 border-b">
            <td class="py-2 px-3 text-center">{{ $index + 1 }}</td>
            <td class="py-3 px-6 text-center">{{ $mata_kuliah->nama_prodi }}</td>
            <td class="py-2 px-3 text-center">{{ $mata_kuliah->kode_mk }}</td>
            <td class="py-2 px-3 text-center">{{ $mata_kuliah->nama_mk }}</td>
            <td class="py-2 px-3 text-center">{{ $mata_kuliah->jenis_mk }}</td>
            <td class="py-2 px-3 text-center">{{ $mata_kuliah->sks_mk }}</td>
            @for ($i = 1; $i <= 8; $i++)
                    <td class="py-2 px-4 items-center text-center min-w-[10px]">
                        @if ($mata_kuliah->semester_mk == $i)
                            ✔️
                        @endif
                    </td>
                @endfor
            <td class="py-2 px-3 text-center">{{ $mata_kuliah->kompetensi_mk }}</td>
            <td class="py-2 px-3 flex justify-center items-center space-x-2">
                <a href="{{ route('admin.matakuliah.detail', $mata_kuliah->kode_mk) }}" class="bg-green-500 font-bold text-white px-3 py-1 rounded-md hover:bg-green-600">🛈</a>
                <a href="{{ route('admin.matakuliah.edit',$mata_kuliah->kode_mk) }}" class="bg-yellow-500 text-white font-bold px-3 py-1 rounded-md hover:bg-yellow-600">✏️</a>
                <form action="{{ route('admin.matakuliah.destroy',$mata_kuliah->kode_mk) }}" method="POST">
                    @csrf @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600" onclick="return confirm('Hapus jurusan ini?')">
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