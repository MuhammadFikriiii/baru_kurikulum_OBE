@extends('layouts.wadir1.app')

@section('content')
    <div class="container mx-auto px-4">

        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Daftar Profil Lulusan</h1>
            <hr class="border-t-4 border-black my-4 mx-auto mb-4">
        </div>

        @if (session('success'))
            <div id="alert"
                class="bg-green-500 text-white px-4 py-2 rounded-md mb-6 text-center relative max-w-4xl mx-auto">
                <span class="font-bold">{{ session('success') }}</span>
                <button onclick="document.getElementById('alert').style.display='none'"
                    class="absolute top-1 right-3 text-white font-bold text-lg">
                    &times;
                </button>
            </div>
        @endif

        @if (session('sukses'))
            <div id="alert"
                class="bg-red-500 text-white px-4 py-2 rounded-md mb-6 text-center relative max-w-4xl mx-auto">
                <span class="font-bold">{{ session('sukses') }}</span>
                <button onclick="document.getElementById('alert').style.display='none'"
                    class="absolute top-1 right-3 text-white font-bold text-lg">
                    &times;
                </button>
            </div>
        @endif


        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto">
                <form method="GET" action="{{ route('wadir1.profillulusan.index') }}" class="w-full md:w-64">
                    <select id="prodi" name="kode_prodi"
                        class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                        onchange="this.form.submit()">
                        <option value="" {{ empty($kode_prodi) ? 'selected' : '' }} disabled>Pilih Prodi</option>
                        @foreach ($prodis as $prodi)
                            <option value="{{ $prodi->kode_prodi }}"
                                {{ $kode_prodi == $prodi->kode_prodi ? 'selected' : '' }}>
                                {{ $prodi->nama_prodi }}
                            </option>
                        @endforeach
                    </select>
                </form>

                <div class="relative w-full md:w-64">
                    <input type="text" id="search" placeholder="Search..."
                        class="w-full border border-gray-300 px-4 py-2 rounded-md pl-10 focus:outline-none focus:ring-2 focus:ring-green-500">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            @if (empty($kode_prodi))
                <div class="p-8 text-center text-gray-600">
                    Silakan pilih prodi terlebih dahulu.
                </div>
            @elseif($profillulusans->isEmpty())
                <div class="p-8 text-center text-gray-600">
                    Data belum dibuat untuk prodi ini.
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full table-fixed shadow-lg rounded-lg overflow-hidden">
                        <thead class="bg-green-800 text-white">
                            <tr class="text-center">
                                <th class="py-3 px-4 w-10 text-center">No.</th>
                                <th class="px-4 py-2 text-center w-16">Kode PL</th>
                                <th class="px-4 py-2 text-center w-24">Prodi</th>
                                <th class="px-4 py-2 text-center w-64">Deskripsi</th>
                                <th class="px-4 py-2 text-center max-w-96">Profesi</th>
                                <th class="px-4 py-2 text-center w-32">Unsur</th>
                                <th class="px-4 py-2 text-center w-28">Keterangan</th>
                                <th class="px-4 py-2 text-center w-40">Sumber</th>
                                <th class="px-4 py-2 text-center w-64">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($profillulusans as $index => $profillulusan)
                                <tr
                                    class="align-top {{ $index % 2 == 0 ? 'bg-gray-200' : 'bg-white' }} hover:bg-gray-200 border-b">
                                    <td class="px-4 py-2 w-28 text-center">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2 w-28 text-center">{{ $profillulusan->kode_pl }}</td>
                                    <td class="px-4 py-2 w-24 text-center">{{ $profillulusan->prodi->nama_prodi ?? '-' }}
                                    </td>
                                    <td class="px-4 py-2 w-70 whitespace-pre-line text-justify">
                                        {{ $profillulusan->deskripsi_pl }}</td>
                                    <td class="px-4 py-2 max-w-96 whitespace-pre-line">{{ $profillulusan->profesi_pl }}
                                    </td>
                                    <td class="px-4 py-2 w-36 text-justify">{{ $profillulusan->unsur_pl }}</td>
                                    <td class="px-4 py-2 w-28 text-center">{{ $profillulusan->keterangan_pl }}</td>
                                    <td class="px-4 py-2 w-40 text-justify">{{ $profillulusan->sumber_pl }}</td>
                                    <td class="px-4 py-4">
                                        <div class="flex justify-center space-x-2">
                                            <a href="{{ route('wadir1.profillulusan.detail', $profillulusan->id_pl) }}"
                                                class="bg-gray-600 hover:bg-gray-700 text-white p-2 rounded-md"
                                                title="Detail">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                    fill="currentColor">
                                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                    <path fill-rule="evenodd"
                                                        d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection