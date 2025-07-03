@extends('layouts.wadir1.app')

@section('title', 'Dashboard')

@section('content')

    <div class="container mx-auto px-4">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Dashboard Penyusunan Kurikulum OBE</h1>
            <p class="text-gray-600 mt-2">Progress implementasi kurikulum berbasis Outcome-Based Education per Program Studi
            </p>
            <hr class="border-t-4 border-black my-5">
        </div>

        <!-- Filter Export & Tahun -->
        <div class="flex flex-col md:flex-row justify-between gap-4 mb-6">
            <form id="exportForm" action="{{ route('wadir1.export.excel') }}" method="GET"
                class="flex flex-col sm:flex-row gap-2 sm:gap-4 items-stretch">
                <select name="kode_prodi" required
                    class="min-w-[200px] border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                    <option value="" disabled selected>Pilih Prodi</option>
                    @foreach ($prodis as $prodi)
                        <option value="{{ $prodi->kode_prodi }}">{{ $prodi->nama_prodi }}</option>
                    @endforeach
                </select>

                <select name="id_tahun" required
                    class="min-w-[170px] border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                    <option value="" disabled selected>Pilih Tahun</option>
                    @foreach ($availableYears as $th)
                        <option value="{{ $th->id_tahun }}" {{ $id_tahun == $th->id_tahun ? 'selected' : '' }}>
                            {{ $th->tahun }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="bg-green-600 text-white px-5 font-bold py-2 rounded-md hover:bg-green-800">
                    <i class="fas fa-file-excel mr-2"></i>Excel
                </button>
            </form>

            <!-- Search -->
            <div class="relative w-full sm:w-64">
                <input type="text" id="search-prodi-dashboard" placeholder="Search..."
                    class="w-full border border-gray-300 px-4 py-2 rounded-md pl-10 focus:outline-none focus:ring-2 focus:ring-green-500">
                <span class="absolute left-3 top-2.5 text-gray-400">
                    <i class="fas fa-search"></i>
                </span>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded-lg shadow p-5 border-l-4 border-blue-500">
                <div class="flex justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Total Program Studi</p>
                        <h2 class="text-2xl font-bold text-gray-800">{{ $prodicount }}</h2>
                    </div>
                    <div class="bg-blue-100 p-2 rounded-full">
                        <i class="fas fa-graduation-cap text-blue-500"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-5 border-l-4 border-green-500">
                <div class="flex justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Sudah Selesai</p>
                        <h2 class="text-2xl font-bold text-gray-800">{{ $ProdiSelesai }}</h2>
                    </div>
                    <div class="bg-green-100 p-2 rounded-full">
                        <i class="fas fa-check-circle text-green-500"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-5 border-l-4 border-yellow-500">
                <div class="flex justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Proses Implementasi</p>
                        <h2 class="text-2xl font-bold text-gray-800">{{ $ProdiProgress }}</h2>
                    </div>
                    <div class="bg-yellow-100 p-2 rounded-full">
                        <i class="fas fa-cog text-yellow-500"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-5 border-l-4 border-red-500">
                <div class="flex justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Belum Dimulai</p>
                        <h2 class="text-2xl font-bold text-gray-800">{{ $ProdiBelumMulai }}</h2>
                    </div>
                    <div class="bg-red-100 p-2 rounded-full">
                        <i class="fas fa-exclamation-circle text-red-500"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Tahun Progress -->
        <form method="GET" action="{{ route('wadir1.dashboard') }}" class="flex items-center mb-6">
            <label for="tahun_progress" class="mr-2 text-gray-600 text-sm">Tahun Progress:</label>
            <select name="tahun_progress" id="tahun_progress" required
                class="border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                onchange="this.form.submit()">
                <option value="" disabled selected>Pilih Tahun</option>
                @foreach ($availableYears as $th)
                    <option value="{{ $th->id_tahun }}"
                        {{ request('tahun_progress') == $th->id_tahun ? 'selected' : '' }}>
                        {{ $th->tahun }}
                    </option>
                @endforeach
            </select>
        </form>

        <!-- Grafik Progress -->
        @if (request()->filled('tahun_progress'))
            <div class="bg-white rounded-lg shadow-lg p-4 mb-8">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Progress Penyusunan Kurikulum OBE</h2>
                <div class="space-y-6">
                    {{-- Penjelasan minimal --}}
                    <p class="text-sm text-gray-600 italic mb-4">
                        Minimal: PL 3, CPL 9, BK 8, MK 108 SKS, CPMK 18, Sub CPMK 36
                    </p>
                    @foreach ($prodis as $prodi)
                        <div class="border-b pb-5 prodi-card">
                            <div class="flex justify-between items-center mb-2">
                                <h3 class="font-semibold text-gray-800">{{ $prodi->nama_prodi }}</h3>
                                <div class="bg-green-100 text-green-700 text-sm font-medium px-3 py-1 rounded-full">
                                    {{ $prodi->avg_progress }}% Selesai
                                </div>
                            </div>

                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="bg-green-500 h-2.5 rounded-full" style="width: {{ $prodi->avg_progress }}%">
                                </div>
                            </div>

                            <div class="flex justify-between mt-2 text-xs text-gray-500">
                                <div class="flex flex-wrap gap-4">
                                    <span class="flex items-center"><span
                                            class="w-2 h-2 bg-green-500 rounded-full mr-1"></span>PL
                                        ({{ $prodi->progress_pl }}%)
                                    </span>
                                    <span class="flex items-center"><span
                                            class="w-2 h-2 bg-green-500 rounded-full mr-1"></span>CPL
                                        ({{ $prodi->progress_cpl }}%)</span>
                                    <span class="flex items-center"><span
                                            class="w-2 h-2 bg-green-500 rounded-full mr-1"></span>BK
                                        ({{ $prodi->progress_bk }}%)</span>
                                    <span class="flex items-center"><span
                                            class="w-2 h-2 bg-green-500 rounded-full mr-1"></span>MK
                                        ({{ $prodi->progress_mk }}%)</span>
                                    <span class="flex items-center"><span
                                            class="w-2 h-2 bg-green-500 rounded-full mr-1"></span>CPMK
                                        ({{ $prodi->progress_cpmk }}%)</span>
                                    <span class="flex items-center"><span
                                            class="w-2 h-2 bg-green-500 rounded-full mr-1"></span>SUB_CPMK
                                        ({{ $prodi->progress_subcpmk }}%)</span>
                                </div>
                                <a href="#" class="text-blue-500 hover:text-blue-700">Detail</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="bg-white p-8 text-center text-gray-600 rounded-lg shadow mb-8">
                <strong>Silakan pilih tahun progress terlebih dahulu untuk menampilkan data.</strong>
            </div>
        @endif
    </div>

@endsection
