@extends('layouts.app')

@section('content')
    <div class="mr-20 ml-20">
        <h2 class="text-4xl font-extrabold text-center mb-4">Daftar Capaian Pembelajaran Matakuliah</h2>
        <hr class="w-full border border-black mb-4">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <form method="GET" action="{{ route('admin.capaianpembelajaranmatakuliah.index') }}" class="w-full md:w-64">
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
        @if (session('success'))
            <div id="alert" class="bg-green-500 text-white px-4 py-2 rounded-md mb-4 text-center relative">
                <span class="font-bold">{{ session('success') }}</span>
                <button onclick="document.getElementById('alert').style.display='none'"
                    class="absolute top-1 right-3 text-white font-bold text-lg">
                    &times;
                </button>
            </div>
        @endif

        @if (session('sukses'))
            <div id="alert" class="bg-red-500 text-white px-4 py-2 rounded-md mb-4 text-center relative">
                <span class="font-bold">{{ session('sukses') }}</span>
                <button onclick="document.getElementById('alert').style.display='none'"
                    class="absolute top-1 right-3 text-white font-bold text-lg">
                    &times;
                </button>
            </div>
        @endif
        <a href="{{ route('admin.capaianpembelajaranmatakuliah.create') }}"
            class="px-4 py-2 bg-blue-500 text-white rounded-lg mb-4 inline-block">
            Tambah Capaian Pembelajaran Matakuliah
        </a>

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

        <!-- Tabel data Capaian Pembelajaran Mata Kuliah -->
        <table class="w-full border border-gray-300 shadow-md rounded-lg overflow-hidden">
            <thead class="bg-green-800 text-white border-b uppercase">
                <tr>
                    <th class="py-3 px-6 min-w-[10px] text-center">No</th>
                    <th class="py-3 px-6 min-w-[10px] text-center">prodi</th>
                    <th class="py-3 px-6 min-w-[10px] text-center">Kode CPMK</th>
                    <th class="py-3 px-6 min-w-[10px] text-center">Deskripsi CPMK</th>
                    <th class="py-3 px-6 min-w-[10px] text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cpmks as $index => $cpmk)
                    <tr class="{{ $index % 2 == 0 ? 'bg-gray-100' : 'bg-white' }} hover:bg-gray-200 border-b">
                        <td class="py-3 px-6 text-center">{{ $index + 1 }}</td>
                        <td class="py-3 px-6 text-center">{{ $cpmk->nama_prodi ?? 'Tidak ada prodi' }}</td>
                        <td class="py-3 px-6 text-center">{{ $cpmk->kode_cpmk }}</td>
                        <td class="py-3 px-6">{{ $cpmk->deskripsi_cpmk }}</td>
                        <td class="py-2 px-3 flex justify-center items-center space-x-2">
                            <a href="{{ route('admin.capaianpembelajaranmatakuliah.detail', $cpmk->id_cpmk) }}"
                                class="bg-green-500 font-bold text-white px-3 py-1 rounded-md hover:bg-green-600">🛈</a>
                            <a href="{{ route('admin.capaianpembelajaranmatakuliah.edit', $cpmk->id_cpmk) }}"
                                class="bg-yellow-500 text-white font-bold px-3 py-1 rounded-md hover:bg-yellow-600">✏️</a>
                            <form action="{{ route('admin.capaianpembelajaranmatakuliah.destroy', $cpmk->id_cpmk) }}"
                                method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600"
                                    onclick="return confirm('Hapus jurusan ini?')">
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
