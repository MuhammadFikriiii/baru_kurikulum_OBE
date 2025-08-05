@extends('layouts.tim.app')
@section('content')
<div class="bg-white p-4 md:p-6 lg:p-8 rounded-lg shadow-md mx-2 md:mx-0">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Pemetaan CPL - CPMK - MK Per Semester</h1>
        <hr class="border-t-2 md:border-t-4 border-black my-3 md:my-4 mx-auto">
    </div>

        <!-- Filter Tahun -->
        <select id="tahun" name="id_tahun"
            class="border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
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
        <!-- Filter Info -->
        @if ($id_tahun)
            <div class="mb-4 p-3 bg-blue-50 border border-blue-200 rounded-md">
                <div class="flex flex-wrap gap-2 items-center">
                    <span class="text-sm text-blue-800 font-medium">Filter aktif:</span>
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
                    <a href="{{ route('tim.pemetaancplcpmkmk.pemetaanmkcplcpmk') }}"
                        class="text-xs text-blue-600 hover:text-blue-800 underline">
                        Reset filter
                    </a>
                </div>
            </div>
        @endif
        <div class="overflow-visible border">
            <table class="min-w-full divide-y divide-gray-300 text-sm">
                <thead class="bg-green-800 text-white text-center">
                    <tr>
                        <th class="border px-4 py-2">Kode MK</th>
                        <th class="border px-4 py-2">Nama Mata Kuliah</th>
                        @foreach ($semuaCpl as $cpl)
                            <th class="border px-4 py-2 relative group cursor-pointer">
                                {{ $cpl->kode_cpl }}
                                <div
                                    class="absolute left-1/2 -translate-x-1/2 top-full mt-1 hidden group-hover:block w-64 bg-black text-white text-sm rounded p-2 z-50 text-center shadow-lg">
                                    <div class="bg-gray-600"><strong>{{ $cpl->nama_prodi ?? '-' }}</strong></div>
                                    <div class="mt-3 text-justify">{{ $cpl->deskripsi_cpl ?? '-' }}</div>
                                </div>
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="bg-white text-gray-800">
                    @foreach ($matrix as $kodeMk => $mk)
                        <tr>
                            <td class="border px-4 py-2 align-top text-center">{{ $kodeMk }}</td>
                            <td class="border px-4 py-2 align-top text-center">{{ $mk['nama'] }}</td>
                            @foreach ($semuaCpl as $cpl)
                                <td class="border px-4 py-2 text-center relative">
                                    @if (!empty($mk['cpl'][$cpl->kode_cpl]['cpmks']))
                                        @foreach ($mk['cpl'][$cpl->kode_cpl]['cpmks'] as $kodeCpmk)
                                            <div class="group inline-block relative cursor-pointer px-1">
                                                <span>{{ $kodeCpmk }}</span>
                                                <div
                                                    class="absolute left-1/2 -translate-x-1/2 top-full mt-1 hidden group-hover:block w-64 bg-black text-white text-sm rounded p-2 z-50 text-center shadow-lg">
                                                    <div class="bg-gray-600 font-bold">
                                                        <strong>{{ $mk['cpl'][$cpl->kode_cpl]['cpmk_details'][$kodeCpmk]['nama_prodi'] ?? '-' }}</strong>
                                                    </div>
                                                    <div class="mt-3 text-justify">
                                                        {{ $mk['cpl'][$cpl->kode_cpl]['cpmk_details'][$kodeCpmk]['deskripsi_cpmk'] ?? '-' }}
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                        @endforeach
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <script>
        function updateFilter() {
            const tahunSelect = document.getElementById('tahun');
            const idTahun = tahunSelect.value;

            let url = "{{ route('tim.pemetaancplcpmkmk.pemetaanmkcplcpmk') }}";

            if (idTahun) {
                url += '?id_tahun=' + encodeURIComponent(idTahun);
            }

            window.location.href = url;
        }
    </script>
@endsection
