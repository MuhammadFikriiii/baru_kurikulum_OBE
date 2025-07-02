@extends('layouts.wadir1.app')

@section('content')
<div class="bg-white p-4 md:p-6 lg:p-8 rounded-lg shadow-md mx-2 md:mx-0">

    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold text-gray-700">Daftar Program Studi</h1>
        <hr class="border-t-4 border-black my-4 mx-auto mb-4">
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
        
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
             <!-- Search -->
             <div class="sm:min-w-[250px] w-full sm:w-auto">
                <div class="flex items-center border border-gray-300 rounded-md focus-within:ring-2 focus-within:ring-green-500 bg-white">
                    <span class="pl-3 text-gray-400">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" id="search" placeholder="Search..."
                        class="px-3 py-2 w-full focus:outline-none bg-transparent" />
                </div>
            </div>
        </div>
    
         <!-- Table -->
         <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-green-800 text-white">
                        <tr>
                            <th class="px-6 py-3 text-center text-sm font-medium uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-center text-sm font-medium uppercase tracking-wider">Jurusan</th>
                            <th class="px-6 py-3 text-center text-sm font-medium uppercase tracking-wider">Kode Prodi</th>
                            <th class="px-6 py-3 text-center text-sm font-medium uppercase tracking-wider">Nama Prodi</th>
                            <th class="px-6 py-3 text-center text-sm font-medium uppercase tracking-wider">Jenjang</th>
                            <th class="px-6 py-3 text-center text-sm font-medium uppercase tracking-wider">Akreditasi</th>
                            <th class="px-6 py-3 text-center text-sm font-medium uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($prodis as $index => $prodi)
                        <tr class="{{ $index % 2 == 0 ? 'bg-gray-50' : 'bg-white' }} hover:bg-gray-100">
                            <td class="px-6 py-4 text-center text-sm">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 text-center text-sm">{{ $prodi->jurusan->nama_jurusan ?? '-' }}</td>
                            <td class="px-6 py-4 text-center text-sm">{{ $prodi->kode_prodi }}</td>
                            <td class="px-6 py-4 text-center text-sm">{{ $prodi->nama_prodi }}</td>
                            <td class="px-6 py-4 text-center text-sm">{{ $prodi->jenjang_pendidikan ?? '-' }}</td>
                            <td class="px-6 py-4 text-center text-sm">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    {{ $prodi->peringkat_akreditasi == 'A' ? 'bg-green-100 text-green-800' : 
                                       ($prodi->peringkat_akreditasi == 'B' ? 'bg-blue-100 text-blue-800' : 
                                       ($prodi->peringkat_akreditasi == 'C' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800')) }}">
                                    {{ $prodi->peringkat_akreditasi ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('wadir1.prodi.detail', $prodi->kode_prodi) }}" 
                                       class="bg-gray-600 hover:bg-gray-700 text-white p-2 rounded-md inline-flex items-center justify-center"
                                       title="Detail">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection