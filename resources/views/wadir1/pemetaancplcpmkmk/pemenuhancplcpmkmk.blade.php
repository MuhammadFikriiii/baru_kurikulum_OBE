@extends('layouts.wadir1.app')
@section('content')

    <div class="bg-white p-4 md:p-6 lg:p-8 rounded-lg shadow-md mx-2 md:mx-0">

        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-800">Pemetaan CPL - CPMK - MK Per Semester</h2>
            <hr class="border-t-4 border-black my-4 mx-auto mb-4">
        </div>

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto">
                <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto">
                    <select id="prodi" name="kode_prodi"
                        class="w-full md:w-64 border border-black px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
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
                        class="w-full md:w-64 border border-black px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
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
                    <a href="{{ route('wadir1.pemetaancplcpmkmk.pemenuhancplcpmkmk') }}"
                        class="text-xs text-blue-600 hover:text-blue-800 underline">
                        Reset filter
                    </a>
                </div>
            </div>
        @endif

        @if (empty($kode_prodi))
            <div class="text-center bg-white rounded-lg shadow">
                <p class="p-8 text-center text-gray-600">Silakan pilih prodi terlebih dahulu.</p>
            </div>
        @else
            @if (empty($matrix))
                <div class="text-center bg-white rounded-lg shadow">
                    <p class="p-8 text-center text-gray-600">Tidak ada data pemetaan untuk program studi yang dipilih.</p>
                </div>
            @else
                <div class="overflow-auto border">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-green-800 text-white">
                            <tr>
                                <th class="border px-4 py-2">CPL</th>
                                <th class="border px-4 py-2">CPMK</th>
                                @for ($i = 1; $i <= 8; $i++)
                                    <th class="border px-4 py-2">Semester {{ $i }}</th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody class="bg-white text-gray-700">
                            @foreach ($matrix as $kode_cpl => $cpl)
                                @php
                                    $cpmks = $cpl['cpmk'];
                                    $rowspan = max(1, count($cpmks));
                                    $first = true;
                                @endphp

                                @if (count($cpmks) === 0)
                                    <tr>
                                        <td class="border px-4 py-2 text-center align-middle">{{ $kode_cpl }}</td>
                                        <td class="border px-4 py-2 text-center align-middle text-gray-400 italic">-</td>
                                        @for ($i = 1; $i <= 8; $i++)
                                            <td class="border px-4 py-2 text-center align-middle">-</td>
                                        @endfor
                                    </tr>
                                @else
                                    @foreach ($cpmks as $kode_cpmk => $cpmk)
                                        <tr class="hover:bg-gray-50">
                                            @if ($first)
                                                <td class="border px-4 py-2 text-center align-middle"
                                                    rowspan="{{ $rowspan }}">{{ $kode_cpl }}</td>
                                                @php $first = false; @endphp
                                            @endif
                                            <td class="border px-4 py-2 text-center align-middle">{{ $kode_cpmk }}</td>
                                            @for ($i = 1; $i <= 8; $i++)
                                                <td class="border px-4 py-2 text-center align-middle">
                                                    <div class="flex flex-col justify-center min-h-[3rem]">
                                                        @if (!empty($cpmk['semester'][$i]))
                                                            <ul class="list-disc list-inside text-center">
                                                                @foreach ($cpmk['semester'][$i] as $item)
                                                                    <li>{!! nl2br(e($item)) !!}</li>
                                                                @endforeach
                                                            </ul>
                                                        @else
                                                            <span class="text-gray-400 italic">-</span>
                                                        @endif
                                                    </div>
                                                </td>
                                            @endfor
                                        </tr>
                                    @endforeach
                                @endif
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
            let url = "{{ route('wadir1.pemetaancplcpmkmk.pemenuhancplcpmkmk') }}";
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
