@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Dashboard Penyusunan Kurikulum OBE</h1>
        <p class="text-gray-600 mt-2">Progress implementasi kurikulum berbasis Outcome-Based Education per Program Studi</p>
        <hr class="border-t-4 border-black my-8">
    </div>

    <!-- Filter dan Pencarian -->
    <!-- Filter dan Pencarian -->
<div class="mb-6">
    <div class="flex flex-col md:flex-row justify-between items-center w-full space-y-2 md:space-y-0 md:space-x-4">
        
        <!-- Search Input -->
        <div class="relative w-full md:w-auto">
            <input type="text" id="search-prodi-dashboard" placeholder="Search..." 
                class="border border-gray-300 pl-10 pr-3 py-2 rounded-md w-full md:w-64">
            <span class="absolute left-3 top-2.5 text-gray-400">
                <i class="fas fa-search"></i>
            </span>
        </div>

        <!-- Export Form (Hanya Admin) -->
        @if(Auth::user()->role === 'admin' && isset($prodis))
            <form action="{{ route(Auth::user()->role === 'admin' ? 'admin.export.excel' : 'tim.export.excel') }}" method="GET" class="flex items-center gap-4">

                <select name="kode_prodi" required class="border border-gray-300 rounded-md py-2">
                    <option value="" class="text-center">Pilih Prodi</option>
                    @foreach($prodis as $prodi)
                        <option value="{{ $prodi->kode_prodi }}">{{ $prodi->nama_prodi }}</option>
                    @endforeach
                </select>
                <button type="submit" class="bg-green-600 text-white px-5 py-2 rounded-md hover:bg-green-700">
                    📄 Export PL + CPL
                </button>
            </form>
        @endif

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

    <!-- Progress Bar Per Prodi -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Progress Penyusunan Kurikulum OBE</h2>

        <!-- Prodi item -->
        <div class="space-y-6">
            @foreach($prodis as $prodi)
                <div class="border-b pb-5 prodi-card">
                    <div class="flex justify-between items-center mb-2">
                        <div>
                            <h3 class="font-semibold text-gray-800">{{ $prodi->nama_prodi }}</h3>
                        </div>
                        <div class="bg-green-100 text-green-700 text-sm font-medium px-3 py-1 rounded-full">
                            {{ $prodi->avg_progress }}% Selesai
                        </div>
                    </div>

                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div class="bg-green-500 h-2.5 rounded-full" style="width: {{ $prodi->avg_progress }}%"></div>
                    </div>

                    <div class="flex justify-between mt-2 text-xs text-gray-500">
                        <div class="flex space-x-6">
                            <span class="flex items-center">
                                <span class="w-2 h-2 bg-green-500 rounded-full mr-1"></span>
                                PL ({{ $prodi->progress_pl }}%)
                            </span>
                            <span class="flex items-center">
                                <span class="w-2 h-2 bg-green-500 rounded-full mr-1"></span>
                                CPL ({{ $prodi->progress_cpl }}%)
                            </span>
                            <span class="flex items-center">
                                <span class="w-2 h-2 bg-green-500 rounded-full mr-1"></span>
                                BK ({{ $prodi->progress_bk }}%)
                            </span>
                            <span class="flex items-center">
                                <span class="w-2 h-2 bg-green-500 rounded-full mr-1"></span>
                                MK ({{ $prodi->progress_mk }}%)
                            </span>
                            <span class="flex items-center">
                                <span class="w-2 h-2 bg-green-500 rounded-full mr-1"></span>
                                CPMK ({{ $prodi->progress_cpmk }}%)
                            </span>
                            <span class="flex items-center">
                                <span class="w-2 h-2 bg-green-500 rounded-full mr-1"></span>
                                SUB_CPMK ({{ $prodi->progress_subcpmk }}%)
                            </span>
                        </div>
                        <a href="#" class="text-blue-500 hover:text-blue-700">Detail</a>
                    </div>
                </div>
            @endforeach
        </div>        
    </div>
</div>
@endsection
