@extends('layouts.app')

@section('content')
    <div class="mx-5 md:mx-20 my-10">

        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Organisasi Mata Kuliah</h1>
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

        <div class="flex flex-col md:flex-row mb-3 w-full md:w-auto">
            <div class="flex space-x-2">
                <!-- Add any additional buttons here if needed -->
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
                    <a href="{{ route('admin.matakuliah.organisasimk') }}"
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
            @elseif(isset($dataKosong) && $dataKosong)
                <div class="p-8 text-center text-gray-600">
                    Data belum dibuat untuk prodi ini.
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-green-800 text-white">
                            <tr>
                                <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider">Semester</th>
                                <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider">SKS</th>
                                <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider">Jumlah MK
                                </th>
                                <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider">Mata Kuliah
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @php
                                $totalSks = 0;
                                $totalMk = 0;
                            @endphp

                            @for ($i = 1; $i <= 8; $i++)
                                @php
                                    $data = isset($organisasiMK)
                                        ? $organisasiMK->get($i, [
                                            'semester_mk' => $i,
                                            'sks_mk' => 0,
                                            'jumlah_mk' => 0,
                                            'nama_mk' => [],
                                        ])
                                        : [
                                            'semester_mk' => $i,
                                            'sks_mk' => 0,
                                            'jumlah_mk' => 0,
                                            'nama_mk' => [],
                                        ];

                                    $totalSks += $data['sks_mk'];
                                    $totalMk += $data['jumlah_mk'];
                                @endphp
                                <tr class="{{ $i % 2 == 0 ? 'bg-gray-50' : 'bg-white' }} hover:bg-gray-100">
                                    <td class="px-4 py-4 text-center text-sm font-medium">Semester
                                        {{ $data['semester_mk'] }}</td>
                                    <td class="px-4 py-4 text-center text-sm">{{ $data['sks_mk'] }}</td>
                                    <td class="px-4 py-4 text-center text-sm">{{ $data['jumlah_mk'] }}</td>
                                    <td class="px-4 py-4">
                                        @if (count($data['nama_mk']) > 0)
                                            <div class="flex flex-wrap gap-2">
                                                @foreach ($data['nama_mk'] as $nama_mk)
                                                    <span
                                                        class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-gray-100 text-gray-800 border border-gray-300">
                                                        {{ $nama_mk }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @else
                                            <span class="text-gray-400 text-center block">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @endfor

                            <tr class="bg-green-800 text-white font-bold">
                                <td class="px-4 py-4 text-center text-sm font-bold">Total</td>
                                <td class="px-4 py-4 text-center text-sm font-bold">{{ $totalSks }}</td>
                                <td class="px-4 py-4 text-center text-sm font-bold">{{ $totalMk }}</td>
                                <td class="px-4 py-4"></td>
                            </tr>
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
            let url = "{{ route('admin.matakuliah.organisasimk') }}";
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
