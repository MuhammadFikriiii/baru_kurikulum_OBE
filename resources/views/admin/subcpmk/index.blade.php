@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Sub Cpmk</h1>
        <hr class="border-t-4 border-black my-4 mx-auto mb-4">
    </div>
    
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <div class="flex space-x-2">
            <a href="{{ route('admin.subcpmk.create') }}" 
            class="bg-green-600 hover:bg-green-800 text-white font-bold px-4 py-2 rounded-md inline-flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Tambah
            </a>
        </div>

        <div class="flex items-center justify-between">
            <label for="entries" class="text-gray-600 mr-2">Show</label>
            <select id="entries" class="border border-gray-300 px-3 py-2 rounded-md mr-2">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
            <span class="text-gray-600">entries</span>
        </div>
    
        <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto">
            <form method="GET" action="{{ route('admin.subcpmk.index') }}" class="w-full md:w-64">
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
            <div class="relative  md:w-55">
                <a href="" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 inline-block w-full text-center">
                    📄 Ekspor ke Excel
                </a>
            </div>
          
        </div>


        <div class="relative w-full md:w-64">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
              </svg>
            </div>
            <input type="text" id="search" placeholder="Search..." 
                   class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
          </div>

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

    @if(empty($kode_prodi))
        <div class="text-center p-8 bg-white rounded-lg shadow">
            <p class="text-gray-600 text-lg">Silakan pilih program studi terlebih dahulu untuk melihat data Sub CPMK.</p>
        </div>
    @else
        @if($subcpmks->isEmpty())
            <div class="text-center p-8 bg-white rounded-lg shadow">
                <p class="text-gray-600 text-lg">Tidak ada data Sub CPMK untuk program studi yang dipilih.</p>
            </div>
        @else
          
            <div class="overflow-x-auto">
                <table class="w-full border border-gray-300 shadow-md rounded-lg overflow-hidden">
                    <thead class="bg-green-800 text-white border-b">
                        <tr>
                            <th class="py-3 px-4 text-center w-1/12 font-bold uppercase">No</th>
                            <th class="py-3 px-4 text-center w-1/6 font-bold uppercase">CPMK</th>
                            <th class="py-3 px-4 text-center w-1/6 font-bold uppercase">SUB CPMK</th>
                            <th class="py-3 px-4 text-center w-1/6 font-bold uppercase">Uraian Sub CPMK</th>
                            <th class="py-3 px-4 text-center w-1/6 font-bold uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subcpmks as $index => $subcpmk)
                            <tr class="{{ $index % 2 == 0 ? 'bg-gray-100' : 'bg-white' }} hover:bg-gray-200 border-b">
                                <td class="py-3 px-6 w-16 text-center">{{ $index + 1 }}</td>
                                <td class="bpy-3 px-6 w-16 text-center">{{ $subcpmk->CapaianPembelajaranMataKuliah->deskripsi_cpmk ?? '-'}}</td>
                                <td class="bpy-3 px-6 w-16 text-center">{{ $subcpmk->sub_cpmk }}</td>
                                <td class="bpy-3 px-6 w-16 text-center">{{ $subcpmk->uraian_cpmk }}</td>
                                <td class="py-3 px-6 flex justify-center items-center space-x-2">
                                    <a href="{{ route('admin.subcpmk.detail', $subcpmk->id_sub_cpmk) }}" class="bg-green-500 font-bold text-white px-3 py-1 rounded-md hover:bg-green-600">🛈 Detail</a>
                                    <a href="{{ route('admin.subcpmk.edit',  $subcpmk->id_sub_cpmk) }}" class="bg-yellow-500 text-white font-bold px-3 py-1 rounded-md hover:bg-yellow-600">✏️ Ubah</a>
                                    <form action="{{ route('admin.subcpmk.destroy', $subcpmk->id_sub_cpmk) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600" onclick="return confirm('Hapus Sub Cpmk ini?')">
                                            🗑️ Hapus
                                        </button>
                                    </form>
                                </td> 
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    @endif
</div>
@endsection