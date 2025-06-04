@extends('layouts.tim.app')

@section('content')
    <div class="mr-20 ml-20">
        <h2 class="text-2xl font-bold text-gray-700 mb-4 text-center">Daftar Capaian Pembelajaran Lulusan</h2>
        <hr class="border-t-4 border-black my-8">
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

        <div class="flex justify-between mb-4">
            <div class="space-x-2">
                <a href="{{ route('tim.capaianpembelajaranlulusan.create') }}"
                    class= "bg-green-600 text-white font-bold h-10 px-5 rounded-md hover:bg-green-800 inline-flex items-center">
                    Tambah
                </a>
            </div>
            <div class="ml-auto justify-between">
                <input type="text" id="search" placeholder="Search..."
                    class="border border-black px-3 py-2 rounded-md">
            </div>
        </div>

        <div class="bg-white shadow-lg overflow-hidden">
            <table class="w-full border border-black shadow-md rounded-lg overflow-hidden">
                <thead class="bg-green-800 text-white border-b">
                    <tr>
                        <th class="py-3 px-4 min-w-[10px] text-center font-bold uppercase ">No.</th>
                        <th class="py-3 px-6 min-w-[10px] text-center font-bold uppercase">Prodi</th>
                        <th class="py-3 px-6 min-w-[10px] text-center font-bold uppercase">Kode CPL</th>
                        <th class="py-3 px-6 min-w-[10px] text-center font-bold uppercase">Deskripsi CPL</th>
                        <th class="py-3 px-6 min-w-[10px] text-center font-bold uppercase">Status CPL</th>
                        <th class="py-3 px-6 font-bold uppercase min-w-[10px] text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($capaianpembelajaranlulusans as $index => $capaianpembelajaranlulusan)
                        <tr class="{{ $index % 2 == 0 ? 'bg-gray-100' : 'bg-white' }} hover:bg-gray-200 border-b">
                            <td class="py-3 px-6 min-w-[10px] text-center">{{ $index + 1 }}</td>
                            <td class="py-3 px-6 min-w-[10px] text-center">
                                {{ $capaianpembelajaranlulusan->nama_prodi ?? 'Tidak ada prodi' }}</td>
                            <td class="py-3 px-6 min-w-[10px] text-center">{{ $capaianpembelajaranlulusan->kode_cpl }}</td>
                            <td class="py-3 px-6 min-w-[10px] text-justify">{{ $capaianpembelajaranlulusan->deskripsi_cpl }}
                            </td>
                            <td class="py-3 px-6 min-w-[10px] text-center">{{ $capaianpembelajaranlulusan->status_cpl }}
                            </td>
                            <td class="py-3 px-6 min-w-[10px] flex justify-center items-center space-x-2">
                                <a href="{{ route('tim.capaianpembelajaranlulusan.detail', $capaianpembelajaranlulusan->id_cpl) }}"
                                    class="bg-gray-600 font-bold text-white px-5 py-3 rounded-md hover:bg-gray-800">🛈</a>
                                <a href="{{ route('tim.capaianpembelajaranlulusan.edit', $capaianpembelajaranlulusan->id_cpl) }}"
                                    class="bg-blue-600 text-white font-bold px-5 py-3 rounded-md hover:bg-blue-800">✏️</a>
                                <form
                                    action="{{ route('tim.capaianpembelajaranlulusan.destroy', $capaianpembelajaranlulusan->id_cpl) }}"
                                    method="POST">
                                    @csrf @method('DELETE')
                                    <button class="bg-red-600 text-white px-5 py-3 rounded-md hover:bg-red-800"
                                        onclick="return confirm('Hapus CPL ini?')">
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
