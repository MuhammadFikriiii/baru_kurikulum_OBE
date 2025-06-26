@extends('layouts.wadir1.app')

@section('content')
    <div class="bg-white p-4 md:p-6 lg:p-8 rounded-lg shadow-md mx-2 md:mx-0">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Daftar Sub Cpmk</h1>
            <hr class="border-t-4 border-black my-4 mx-auto mb-4">
        </div>

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">

            <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto">
                <select id="prodi" name="kode_prodi"
                    class="w-full md:w-64 border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                    onchange="updateFilter()">
                    <option value="" {{ empty($kode_prodi) ? 'selected' : '' }} disabled>Pilih Prodi</option>
                    @foreach ($prodis as $prodi)
                        <option value="{{ $prodi->kode_prodi }}" {{ $kode_prodi == $prodi->kode_prodi ? 'selected' : '' }}>
                            {{ $prodi->nama_prodi }}
                        </option>
                    @endforeach
                </select>

                <select id="tahun" name="id_tahun"
                    class="w-full md:w-64 border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                    onchange="updateFilter()">
                    <option value="" {{ empty($id_tahun) ? 'selected' : '' }}>Semua Tahun</option>
                    @if ($tahun_tersedia->isNotEmpty())
                        @foreach ($tahun_tersedia as $thn)
                            <option value="{{ $thn->id_tahun }}" {{ $id_tahun == $thn->id_tahun ? 'selected' : '' }}>
                                {{ $thn->nama_kurikulum }} - {{ $thn->tahun }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="relative w-full md:w-64">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <input type="text" id="search" placeholder="Search..."
                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
            </div>
        </div>
    </div>

    <div class="mx-5 md:mx-20 my-10">
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
                    <a href="{{ route('wadir1.subcpmk.index') }}"
                        class="text-xs text-blue-600 hover:text-blue-800 underline">
                        Reset filter
                    </a>
                </div>
            </div>
        @endif

        @if (session('success'))
            <div id="alert" class="bg-green-500 text-white px-4 py-2 rounded-md mb-4 text-center relative">
                <span class="font-bold">{{ session('success') }}</span>
                <button onclick="document.getElementById('alert').style.display='none'"
                    class="absolute top-1 right-3 text-white font-bold text-lg">&times;</button>
            </div>
        @endif

        @if (empty($kode_prodi))
            <div class="text-center p-8 bg-white rounded-lg shadow">
                <p class="text-gray-600 text-lg">Silakan pilih program studi terlebih dahulu untuk melihat data Sub CPMK.
                </p>
            </div>
        @elseif ($subcpmks->isEmpty())
            <div class="text-center p-8 bg-white rounded-lg shadow">
                <p class="text-gray-600 text-lg">Tidak ada data Sub CPMK untuk program studi yang dipilih.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full border border-gray-300 shadow-md rounded-lg overflow-hidden">
                    <thead class="bg-green-800 text-white">
                        <tr>
                            <th class="py-3 px-4 text-center border-r border-gray-200 font-bold uppercase">No</th>
                            <th class="py-3 px-4 text-center border-r border-gray-200 font-bold uppercase">Kode CPMK</th>
                            <th class="py-3 px-4 text-center border-r border-gray-200 font-bold uppercase">Deskripsi CPMK
                            </th>
                            <th class="py-3 px-4 text-center border-r border-gray-200 font-bold uppercase">SUB CPMK</th>
                            <th class="py-3 px-4 text-center border-r border-gray-200 font-bold uppercase">Uraian Sub CPMK
                            </th>
                            <th class="py-3 px-4 text-center font-bold uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subcpmks as $index => $subcpmk)
                            <tr class="{{ $index % 2 == 0 ? 'bg-gray-100' : 'bg-white' }} hover:bg-gray-200">
                                <td class="py-3 px-4 text-center border border-gray-200">{{ $index + 1 }}</td>
                                <td class="py-3 px-4 text-center border border-gray-200">{{ $subcpmk->kode_cpmk }}</td>
                                <td class="py-3 px-4 text-center border border-gray-200">
                                    {{ $subcpmk->deskripsi_cpmk ?? '-' }}</td>
                                <td class="py-3 px-4 text-center border border-gray-200">{{ $subcpmk->sub_cpmk }}</td>
                                <td class="py-3 px-4 text-center border border-gray-200">{{ $subcpmk->uraian_cpmk }}</td>
                                <td class="py-3 px-4 border border-gray-200">
                                    <div class="flex justify-center items-center space-x-2">
                                        <a href="{{ route('wadir1.subcpmk.detail', $subcpmk->id_sub_cpmk) }}"
                                            class="bg-gray-600 hover:bg-gray-700 text-white p-2 rounded-md" title="Detail">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
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

    <script>
        function updateFilter() {
            const prodiSelect = document.getElementById('prodi');
            const tahunSelect = document.getElementById('tahun');

            // Ambil parameter URL sekarang
            const urlParams = new URLSearchParams(window.location.search);

            // Ambil nilai baru dari dropdown
            const kodeProdi = prodiSelect.value;
            const idTahun = tahunSelect.value;

            // Set nilai baru tanpa menghapus yang lain
            if (kodeProdi) {
                urlParams.set('kode_prodi', kodeProdi);
            }

            if (idTahun) {
                urlParams.set('id_tahun', idTahun);
            }

            const newUrl = `{{ route('wadir1.subcpmk.index') }}?${urlParams.toString()}`;
            window.location.href = newUrl;
        }
    </script>
@endsection
