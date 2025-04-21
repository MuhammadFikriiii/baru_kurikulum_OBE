@extends('layouts.app')

@section('content')

<div class="mr-20 ml-20">
    <h2 class="text-4xl font-extrabold text-center mb-4">Daftar Capaian Pembelajaran Matakuliah</h2>
    <hr class="w-full border border-black mb-4">

    <!-- Link untuk menambah data -->
    <a href="{{ route('admin.capaianpembelajaranmatakuliah.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg mb-4 inline-block">
        Tambah Capaian Pembelajaran Matakuliah
    </a>

    <!-- Tabel data Capaian Pembelajaran Mata Kuliah -->
    <table class="w-full table-fixed shadow-md rounded-lg overflow-hidden">
        <thead class="bg-green-800 text-white border-b uppercase">
            <tr>
                <th class="py-3 px-6 text-center">No</th>
                <th class="py-3 px-6 text-center">prodi</th>
                <th class="py-3 px-6 text-center">Kode CPMK</th>
                <th class="py-3 px-6 text-center">Deskripsi CPMK</th>
                <th class="py-3 px-6 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cpmks as $index => $cpmk)
                <tr class="{{ $index % 2 == 0 ? 'bg-gray-100' : 'bg-white' }} hover:bg-gray-200 border-b">
                    <td class="py-3 px-6 text-center">{{ $index + 1 }}</td>
                    <td class="py-3 px-6 text-center">{{ $cpmk->nama_prodi ?? 'Tidak ada prodi' }}</td>
                    <td class="py-3 px-6 text-center">{{ $cpmk->kode_cpmk }}</td>
                    <td class="py-3 px-6 text-center">{{ $cpmk->deskripsi_cpmk }}</td>
                        <td class="py-2 px-3 flex justify-center items-center space-x-2">
                            <a href="#" class="bg-green-500 font-bold text-white px-3 py-1 rounded-md hover:bg-green-600">🛈</a>
                            <a href="#" class="bg-yellow-500 text-white font-bold px-3 py-1 rounded-md hover:bg-yellow-600">✏️</a>
                            <form action="#" method="POST">
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