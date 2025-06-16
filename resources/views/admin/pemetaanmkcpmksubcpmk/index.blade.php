@extends('layouts.app')
@section('content')
    <div class="mx-5 md:mx-20 my-10">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-800">Pemetaan MK - CPMK - SUBCPMK</h2>
            <hr class="border-t-4 border-black my-4 mx-auto mb-4">
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
                    <a href="{{ route('admin.pemetaanmkcpmksubcpmk.index') }}"
                        class="text-xs text-blue-600 hover:text-blue-800 underline">
                        Reset filter
                    </a>
                </div>
        @endif

        @if (empty($kode_prodi))
            <div class="text-center bg-white rounded-lg shadow">
                <p class="p-8 text-center text-gray-600">Silakan pilih prodi terlebih dahulu.</p>
            </div>
        @else
            @if ($query->isEmpty())
                <div class="text-center bg-white rounded-lg shadow">
                    <p class="p-8 text-center text-gray-600">Tidak ada data pemetaan untuk program studi yang dipilih.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-300 rounded-lg overflow-hidden shadow-md">
                        <thead class="bg-green-800">
                            <tr class="text-white uppercase text-center">
                                <th class="p-3 border-r border-gray-200 font-bold">No</th>
                                <th class="p-3 border-r border-gray-200 font-bold">Kode MK</th>
                                <th class="p-3 border-r border-gray-200 font-bold">Nama MK</th>
                                <th class="p-3 border-r border-gray-200 font-bold">Kode CPMK</th>
                                <th class="p-3 border-r border-gray-200 font-bold">Nama CPMK</th>
                                <th class="p-3 border-r border-gray-200 font-bold">Kode Sub CPMK</th>
                                <th class="p-3 font-bold">Nama Sub CPMK</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($query as $index => $row)
                                <tr class="{{ $index % 2 == 0 ? 'bg-gray-100' : 'bg-white' }} hover:bg-gray-200">
                                    <td class="p-3 border border-gray-200 text-center">{{ $index + 1 }}</td>
                                    <td class="p-3 border border-gray-200 text-center">{{ $row->kode_mk }}</td>
                                    <td class="p-3 border border-gray-200 whitespace-normal break-words">
                                        <div class="flex items-center h-full">
                                            {{ $row->nama_mk }}
                                        </div>
                                    </td>
                                    <td class="p-3 border border-gray-200 text-center">{{ $row->kode_cpmk }}</td>
                                    <td class="p-3 border border-gray-200">{{ $row->deskripsi_cpmk }}</td>
                                    <td class="p-3 border border-gray-200 text-center">{{ $row->sub_cpmk }}</td>
                                    <td class="p-3 border border-gray-200">{{ $row->uraian_cpmk }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        @endif
    </div>
    <script>
        function updateFilter() {
            const prodiSelect = document.getElementById('prodi');
            const tahunSelect = document.getElementById('tahun');

            const kodeProdi = prodiSelect.value;
            const idTahun = tahunSelect.value;

            // Buat URL dengan parameter yang sesuai
            let url = "{{ route('admin.pemetaanmkcpmksubcpmk.index') }}";
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
