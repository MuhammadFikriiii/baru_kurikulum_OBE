@extends('layouts.app')

@section('content')
    <div class="bg-white p-4 md:p-6 lg:p-8 rounded-lg shadow-md mx-2 md:mx-0">

        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Daftar Bahan Kajian</h1>
            <hr class="border-t-2 md:border-t-4 border-black my-3 md:my-4 mx-auto">
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
            <div class="flex space-x-2">
                <a href="{{ route('admin.bahankajian.create') }}"
                    class="bg-green-600 hover:bg-green-800 text-white font-bold px-4 py-2 rounded-md inline-flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
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
                    <a href="{{ route('admin.bahankajian.index') }}"
                        class="text-xs text-blue-600 hover:text-blue-800 underline">
                        Reset filter
                    </a>
                </div>
            </div>
        @endif

        <!-- Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            @if (empty($kode_prodi))
                <div class="p-8 text-center text-gray-600">
                    Silakan pilih prodi terlebih dahulu.
                </div>
            @elseif($dataKosong)
                <div class="p-8 text-center text-gray-600">
                    <strong>Data belum dibuat untuk prodi ini.</strong>
                </div>
            @else
                <div class="w-full overflow-x-auto shadow-lg rounded-lg border border-gray-300">
                    <table class="min-w-full table-fixed">
                        <thead class="bg-green-800 text-white">
                            <tr>
                                <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider border border-gray-300">No</th>
                                <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider border border-gray-300">Prodi</th>
                                <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider border border-gray-300">Kode BK</th>
                                <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider border border-gray-300">Nama BK</th>
                                <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider border border-gray-300">Deskripsi BK
                                </th>
                                <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider border border-gray-300">Referensi BK
                                </th>
                                <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider border border-gray-300">Status BK
                                </th>
                                <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider border border-gray-300">Knowledge
                                    Area</th>
                                <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider border border-gray-300">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($bahankajians as $index => $bahankajian)
                                <tr class="{{ $index % 2 == 0 ? 'bg-gray-100' : 'bg-white' }} hover:bg-gray-100">
                                    <td class="px-4 py-4 text-center text-sm border border-gray-300">{{ $index + 1 }}</td>
                                    <td class="px-4 py-4 text-center text-sm border border-gray-300">{{ $bahankajian->nama_prodi }}</td>
                                    <td class="px-4 py-4 text-center text-sm border border-gray-300">{{ $bahankajian->kode_bk }}</td>
                                    <td class="px-4 py-4 text-center text-sm border border-gray-300">{{ $bahankajian->nama_bk }}</td>
                                    <td class="px-4 py-4 text-sm border border-gray-300">{{ $bahankajian->deskripsi_bk }}</td>
                                    <td class="px-4 py-4 text-center text-sm border border-gray-300">{{ $bahankajian->referensi_bk }}</td>
                                    <td class="px-4 py-4 text-center text-sm border border-gray-300">{{ $bahankajian->status_bk }}</td>
                                    <td class="px-4 py-4 text-center text-sm border border-gray-300">{{ $bahankajian->knowledge_area }}</td>
                                    <td class="px-4 py-4 border border-gray-300">                              
                                        <div class="flex justify-center space-x-2">
                                            <a href="{{ route('admin.bahankajian.detail', $bahankajian->id_bk) }}"
                                                class="bg-gray-600 hover:bg-gray-700 text-white p-2 rounded-md inline-flex items-center justify-center"
                                                title="Detail">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                                    fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M18 10A8 8 0 11 2 10a8 8 0 0116 0zm-9-3a1 1 0 112 0 1 1 0 01-2 0zm2 5a1 1 0 10-2 0v2a1 1 0 102 0v-2z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </a>
                                            <a href="{{ route('admin.bahankajian.edit', $bahankajian->id_bk) }}"
                                                class="bg-blue-600 hover:bg-blue-800 text-white p-2 rounded-md inline-flex items-center justify-center"
                                                title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                                    fill="currentColor">
                                                    <path
                                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                </svg>
                                            </a>
                                            <form
                                                action="{{ route('admin.bahankajian.destroy', $bahankajian->id_bk) }}"
                                                method="POST">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    class="bg-red-600 hover:bg-red-800 text-white p-2 rounded-md inline-flex items-center justify-center"
                                                    title="Hapus" onclick="return confirm('Hapus data ini?')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                            clip-rule="evenodd" />
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
            let url = "{{ route('admin.bahankajian.index') }}";
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
