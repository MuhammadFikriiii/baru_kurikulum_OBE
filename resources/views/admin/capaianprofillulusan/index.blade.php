@extends('layouts.app')

@section('content')
<div class="mx-5 md:mx-20 my-10">
    
    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Capaian Pembelajaran Lulusan</h1>
        <hr class="border-t-4 border-black my-4 mx-auto mb-4">
    </div>

    
    @if(session('success'))
    <div id="alert" class="bg-green-500 text-white px-4 py-2 rounded-md mb-6 text-center relative max-w-4xl mx-auto">
        <span class="font-bold">{{ session('success') }}</span>
        <button onclick="document.getElementById('alert').style.display='none'"
            class="absolute top-1 right-3 text-white font-bold text-lg">
            &times;
        </button>
    </div>
    @endif

    @if(session('sukses'))
    <div id="alert" class="bg-red-500 text-white px-4 py-2 rounded-md mb-6 text-center relative max-w-4xl mx-auto">
        <span class="font-bold">{{ session('sukses') }}</span>
        <button onclick="document.getElementById('alert').style.display='none'"
            class="absolute top-1 right-3 text-white font-bold text-lg">
            &times;
        </button>
    </div>
    @endif

    
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <div class="flex space-x-2">
            <a href="{{ route('admin.capaianprofillulusan.create') }}" 
               class="bg-green-600 hover:bg-green-800 text-white font-bold px-4 py-2 rounded-md inline-flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Tambah
            </a>
        </div>
        
        <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto">
            <form method="GET" action="{{ route('admin.capaianprofillulusan.index') }}" class="w-full md:w-64">
                <select id="prodi" name="kode_prodi" 
                    class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                    onchange="this.form.submit()">
                    <option value="" {{ empty($kode_prodi) ? 'selected' : '' }} disabled>Pilih Prodi</option>
                    @foreach($prodis as $prodi)
                        <option value="{{ $prodi->kode_prodi }}" {{ $kode_prodi == $prodi->kode_prodi ? 'selected' : '' }}>
                            {{ $prodi->nama_prodi }}
                        </option>
                    @endforeach
                </select>
            </form>
            
            <div class="relative w-full md:w-64">
                <input type="text" id="search" placeholder="Search..." 
                    class="w-full border border-gray-300 px-4 py-2 rounded-md pl-10 focus:outline-none focus:ring-2 focus:ring-green-500">
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
        @if(empty($kode_prodi))
        <div class="p-8 text-center text-gray-600">
            Silakan pilih prodi terlebih dahulu.
        </div>
        @elseif($dataKosong)
        <div class="p-8 text-center text-gray-600">
            <strong>Data belum dibuat untuk prodi ini.</strong>
        </div>
        @else
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-green-800 text-white">
                    <tr>
                        <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider">No</th>
                        <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider">Prodi</th>
                        <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider">Kode CPL</th>
                        <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider">Deskripsi CPL</th>
                        <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider">Status CPL</th>
                        <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($capaianprofillulusans as $index => $capaianprofillulusan)
                    <tr class="{{ $index % 2 == 0 ? 'bg-gray-100' : 'bg-white' }} hover:bg-gray-100">
                        <td class="px-4 py-4 text-center text-sm">{{ $index + 1 }}</td>
                        <td class="px-4 py-4 text-center text-sm">{{ $capaianprofillulusan->nama_prodi ?? 'Tidak ada prodi' }}</td>
                        <td class="px-4 py-4 text-center text-sm">{{ $capaianprofillulusan->kode_cpl }}</td>
                        <td class="px-4 py-4 text-sm whitespace-pre-line">{{ $capaianprofillulusan->deskripsi_cpl }}</td>
                        <td class="px-4 py-4 text-center text-sm">{{ $capaianprofillulusan->status_cpl }}</td>
                        <td class="px-4 py-4">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('admin.capaianprofillulusan.detail', $capaianprofillulusan->id_cpl) }}" 
                                    class="bg-gray-600 hover:bg-gray-700 text-white p-2 rounded-md inline-flex items-center justify-center"
                                    title="Detail">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10A8 8 0 11 2 10a8 8 0 0116 0zm-9-3a1 1 0 112 0 1 1 0 01-2 0zm2 5a1 1 0 10-2 0v2a1 1 0 102 0v-2z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                                <a href="{{ route('admin.capaianprofillulusan.edit', $capaianprofillulusan->id_cpl) }}" 
                                   class="bg-blue-600 hover:bg-blue-800 text-white p-2 rounded-md"
                                   title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                    </svg>
                                </a>
                                <form action="{{ route('admin.capaianprofillulusan.destroy', $capaianprofillulusan->id_cpl) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-600 hover:bg-red-800 text-white p-2 rounded-md"
                                            title="Hapus"
                                            onclick="return confirm('Hapus CPL ini?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
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
        @endif
    </div>
</div>
@endsection