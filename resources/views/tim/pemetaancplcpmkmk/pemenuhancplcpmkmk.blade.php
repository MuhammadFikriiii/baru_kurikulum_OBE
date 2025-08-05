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
                    <a href="{{ route('tim.pemetaancplcpmkmk.pemenuhancplcpmkmk') }}"
                        class="text-xs text-blue-600 hover:text-blue-800 underline">
                        Reset filter
                    </a>
                </div>
            </div>
        @endif
        <div class="border overflow-visible">
            <table class="w-full border border-gray-300 shadow-md rounded-lg overflow-visible">
                <thead class="bg-green-800 text-white uppercase">
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
                            $rowspan = count($cpl['cpmk']);
                            $first = true;
                        @endphp
                        @foreach ($cpl['cpmk'] as $kode_cpmk => $cpmk)
                            <tr>
                                @if ($first)
                                    <td class="border px-4 py-2 relative group" rowspan="{{ $rowspan }}">
                                        <span class="hover:cursor-help">{{ $kode_cpl }}</span>

                                        <!-- Tooltip cpl -->
                                        <div
                                            class="absolute left-1/2 -translate-x-1/2 top-full mb-4 hidden group-hover:block w-64 bg-black text-white text-sm rounded p-2 z-50 text-center shadow-lg">
                                            <div class="bg-gray-600"><strong>{{ $cpl['prodi'] ?? '-' }}</strong></div>
                                            <div class="mt-3 text-justify">{{ $cpl['deskripsi'] ?? '-' }}</div>
                                        </div>
                                    </td>
                                    @php $first = false; @endphp
                                @endif

                                <td class="border px-4 py-2 relative group">
                                    <span class="hover:cursor-help">{{ $kode_cpmk }}</span>

                                    <!-- Tooltip CPMK -->
                                    <div
                                        class="absolute left-1/2 -translate-x-1/2 top-full mt-2 hidden group-hover:block w-64 bg-black text-white text-sm rounded p-2 z-50 text-center shadow-lg">
                                        <div class="bg-gray-600"><strong>{{ $cpmk['prodi'] ?? '-' }}</strong></div>
                                        <div class="mt-1 text-justify">{{ $cpmk['deskripsi'] ?? '-' }}</div>
                                    </div>
                                </td>

                                @for ($i = 1; $i <= 8; $i++)
                                    <td class="border px-4 py-2 text-center">
                                        @if (!empty($cpmk['semester'][$i]))
                                            {!! implode('<br>', $cpmk['semester'][$i]) !!}
                                        @endif
                                    </td>
                                @endfor
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function updateFilter() {
            const tahunSelect = document.getElementById('tahun');
            const idTahun = tahunSelect.value;

            let url = "{{ route('tim.pemetaancplcpmkmk.pemenuhancplcpmkmk') }}";

            if (idTahun) {
                url += '?id_tahun=' + encodeURIComponent(idTahun);
            }

            window.location.href = url;
        }
    </script>
@endsection
