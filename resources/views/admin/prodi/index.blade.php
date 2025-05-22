@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">

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
            <div>
                <a href="{{ route('admin.prodi.create') }}" 
                   class="bg-green-600 hover:bg-green-800 text-white font-bold px-4 py-2 rounded-md inline-flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Tambah
                </a>
            </div>
            <div class="w-full md:w-auto">
                <div class="relative">
                    <input type="text" id="search" placeholder="Search..." 
                        class="w-full md:w-64 border border-gray-300 px-4 py-2 rounded-md pl-10 focus:outline-none focus:ring-2 focus:ring-green-500">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
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
                                    <a href="{{ route('admin.prodi.detail', $prodi->kode_prodi) }}" 
                                       class="bg-gray-600 hover:bg-gray-700 text-white p-2 rounded-md inline-flex items-center justify-center"
                                       title="Detail">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.prodi.edit', $prodi->kode_prodi) }}" 
                                       class="bg-blue-600 hover:bg-blue-800 text-white p-2 rounded-md inline-flex items-center justify-center"
                                       title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.prodi.destroy', $prodi->kode_prodi) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                                class="bg-red-600 hover:bg-red-800 text-white p-2 rounded-md inline-flex items-center justify-center"
                                                title="Hapus"
                                                onclick="return confirm('Hapus prodi ini?')">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </form>
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