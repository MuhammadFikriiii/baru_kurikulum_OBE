@extends('layouts.kaprodi.app')

@section('content')
    <div class="bg-white p-4 md:p-6 lg:p-8 rounded-lg shadow-md mx-2 md:mx-0">
        <h2 class="text-4xl font-extrabold text-center mb-4">Pemetaan CPL - CPMK - MK</h2>
        <hr class="border border-black mb-4">
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
                    <a href="{{ route('kaprodi.pemetaancplcpmkmk.index') }}"
                        class="text-xs text-blue-600 hover:text-blue-800 underline">
                        Reset filter
                    </a>
                </div>
            </div>
        @endif
        <div class="overflow-auto border">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-green-800 text-white uppercase">
                    <tr>
                        <th class="border px-4 py-2">Kode CPL</th>
                        <th class="border px-4 py-2">Deskripsi CPL</th>
                        <th class="border px-4 py-2">Kode CPMK</th>
                        <th class="border px-4 py-2">Deskripsi CPMK</th>
                        <th class="border px-4 py-2">Mata Kuliah</th>
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
                                    <td class="border px-4 py-2" rowspan="{{ $rowspan }}">{{ $kode_cpl }}</td>
                                    <td class="border px-4 py-2" rowspan="{{ $rowspan }}">{{ $cpl['deskripsi'] }}</td>
                                    @php $first = false; @endphp
                                @endif
                                <td class="border px-4 py-2">{{ $kode_cpmk }}</td>
                                <td class="border px-4 py-2">{{ $cpmk['deskripsi'] }}</td>
                                <td class="border px-4 py-2 w-64 text-center">
                                    @foreach (array_unique($cpmk['mk']) as $mk)
                                        <div>{{ $mk }}</div>
                                    @endforeach
                                </td>

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

            let url = "{{ route('kaprodi.pemetaancplcpmkmk.index') }}";

            if (idTahun) {
                url += '?id_tahun=' + encodeURIComponent(idTahun);
            }

            window.location.href = url;
        }
    </script>
@endsection
