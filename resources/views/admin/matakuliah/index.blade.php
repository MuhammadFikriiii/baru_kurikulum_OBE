@extends('layouts.app')

@section('content')
<div class="bg-white p-4 md:p-6 lg:p-8 rounded-lg shadow-md mx-2 md:mx-0">
    
    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Mata Kuliah</h1>
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
            <a href="{{ route('admin.matakuliah.create') }}" 
               class="bg-green-600 hover:bg-green-800 text-white font-bold px-4 py-2 rounded-md inline-flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Tambah
            </a>
        </div>
        
        <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto">
            <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto">
                    <select id="prodi" name="kode_prodi"
                        class="w-full md:w-64 border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                        onchange="updateFilter()">
                        <option value="" {{ empty($kode_prodi) ? 'selected' : '' }} disabled>Pilih Prodi</option>
                        @foreach ($prodis as $prodi)
                            <option value="{{ $prodi->kode_prodi }}"
                                {{ $kode_prodi == $prodi->kode_prodi ? 'selected' : '' }}>
                                {{ $prodi->nama_prodi }}
                            </option>
                        @endforeach
                    </select>

                    <select id="tahun" name="id_tahun"
                        class="w-full md:w-64 border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                        onchange="updateFilter()">
                        <option value="" {{ empty($id_tahun) ? 'selected' : '' }}>Semua Tahun</option>
                        @if (isset($tahun_tersedia))
                            @foreach ($tahun_tersedia as $thn)
                                <option value="{{ $thn->id_tahun }}" {{ $id_tahun == $thn->id_tahun ? 'selected' : '' }}>
                                    {{ $thn->nama_kurikulum }} - {{ $thn->tahun }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
            
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

     @if ($kode_prodi || $id_tahun)
            <div class="mb-4 p-3 bg-blue-50 border border-blue-200 rounded-md">
                <div class="flex flex-wrap gap-2 items-center">
                    <span class="text-sm text-blue-800 font-medium">Filter aktif:</span>
                    @if ($kode_prodi)
                        <span
                            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            Prodi: {{ $prodis->where('kode_prodi', $kode_prodi)->first()->nama_prodi ?? $kode_prodi }}
                        </span>
                    @endif
                    @if ($id_tahun)
                        @php
                            $selected_tahun = $tahun_tersedia->where('id_tahun', $id_tahun)->first();
                        @endphp
                        <span
                            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            Tahun:
                            {{ $selected_tahun ? $selected_tahun->nama_kurikulum . ' - ' . $selected_tahun->tahun : $id_tahun }}
                        </span>
                    @endif
                    <a href="{{ route('admin.matakuliah.index') }}"
                        class="text-xs text-blue-600 hover:text-blue-800 underline">
                        Reset filter
                    </a>
                </div>
            </div>
        @endif

    <!-- Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        @if(empty($kode_prodi))
        <div class="p-8 text-center text-gray-600">
            Silakan pilih prodi terlebih dahulu.
        </div>
        @elseif($mata_kuliahs->isEmpty())
        <div class="p-8 text-center text-gray-600">
            Data belum dibuat untuk prodi ini.
        </div>
        @else
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-green-800 text-white">
                    <tr>
                        <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider">No</th>
                        <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider">Prodi</th>
                        <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider">Kode MK</th>
                        <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider">Nama MK</th>
                        <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider">Jenis MK</th>
                        <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider">SKS</th>
                        @for ($i = 1; $i <= 8; $i++)
                        <th class="px-2 py-3 text-center text-xs font-medium uppercase tracking-wider">S{{ $i }}</th>
                        @endfor
                        <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider">Kompetensi</th>
                        <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($mata_kuliahs as $index => $mata_kuliah)
                    <tr class="{{ $index % 2 == 0 ? 'bg-gray-50' : 'bg-white' }} hover:bg-gray-100">
                        <td class="px-4 py-4 text-center text-sm">{{ $index + 1 }}</td>
                        <td class="px-4 py-4 text-center text-sm">{{ $mata_kuliah->nama_prodi }}</td>
                        <td class="px-4 py-4 text-center text-sm">{{ $mata_kuliah->kode_mk }}</td>
                        <td class="px-4 py-4 text-center text-sm">{{ $mata_kuliah->nama_mk }}</td>
                        <td class="px-4 py-4 text-center text-sm">{{ $mata_kuliah->jenis_mk }}</td>
                        <td class="px-4 py-4 text-center text-sm">{{ $mata_kuliah->sks_mk }}</td>
                        @for ($i = 1; $i <= 8; $i++)
                            <td class="px-2 py-4 text-center">
                                @if ($mata_kuliah->semester_mk == $i)
                                <span class="inline-flex items-center justify-center w-6 h-6 bg-green-500 text-white rounded-full mx-auto">✓</span>
                                @endif
                            </td>
                        @endfor
                        <td class="px-4 py-4 text-center text-sm">{{ $mata_kuliah->kompetensi_mk }}</td>
                        <td class="px-4 py-4">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('admin.matakuliah.detail', $mata_kuliah->kode_mk) }}" 
                                   class="bg-gray-600 hover:bg-gray-700 text-white p-2 rounded-md"
                                   title="Detail">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                                <a href="{{ route('admin.matakuliah.edit', $mata_kuliah->kode_mk) }}" 
                                   class="bg-blue-600 hover:bg-blue-800 text-white p-2 rounded-md"
                                   title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                    </svg>
                                </a>
                                <form action="{{ route('admin.matakuliah.destroy', $mata_kuliah->kode_mk) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-600 hover:bg-red-800 text-white p-2 rounded-md"
                                            title="Hapus"
                                            onclick="return confirm('Hapus mata kuliah ini?')">
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
<script>
        function updateFilter() {
            const prodiSelect = document.getElementById('prodi');
            const tahunSelect = document.getElementById('tahun');

            const kodeProdi = prodiSelect.value;
            const idTahun = tahunSelect.value;

            // Buat URL dengan parameter yang sesuai
            let url = "{{ route('admin.matakuliah.index') }}";
            let params = [];

            if (kodeProdi) {
                params.push('kode_prodi=' + encodeURIComponent(kodeProdi));
            }

            if (idTahun) {
                params.push('id_tahun=' + encodeURIComponent(idTahun));
            }

            if (params.length > 0) {
                url += '?' + params.join('&');
            }

            // Redirect ke URL dengan parameter yang benar
            window.location.href = url;
        }
    </script>
@endsection