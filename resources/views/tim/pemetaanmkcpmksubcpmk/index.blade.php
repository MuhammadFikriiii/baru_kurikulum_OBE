@extends('layouts.tim.app')
@section('content')
    <div class="bg-white p-4 md:p-6 lg:p-8 rounded-lg shadow-md mx-2 md:mx-0">
        <h2 class="text-4xl font-extrabold text-center mb-4">Pemetaan MK - CPMK - SUBCPMK</h2>
        <hr class="w-full border border-black mb-4">
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
                    <a href="{{ route('tim.pemetaanmkcpmksubcpmk.index') }}"
                        class="text-xs text-blue-600 hover:text-blue-800 underline">
                        Reset filter
                    </a>
                </div>
            </div>
        @endif
        <table class="w-full border border-gray-300 rounded-lg overflow-hidden shadow-md">
            <thead class="bg-green-800">
                <tr class="text-white uppercase text-center">
                    <th class="p-2 py-3 px-4 min-w-[10px] text-center font-bold uppercase">No</th>
                    <th class="p-2 py-3 px-4 min-w-[10px] text-center font-bold uppercase">kode MK</th>
                    <th class="p-2 py-3 px-4 min-w-[10px] text-center font-bold uppercase">nama MK</th>
                    <th class="p-2 py-3 px-4 min-w-[10px] text-center font-bold uppercase">kode CPMK</th>
                    <th class="p-2 py-3 px-4 min-w-[10px] text-center font-bold uppercase">deskripsi CPMK</th>
                    <th class="p-2 py-3 px-4 min-w-[10px] text-center font-bold uppercase">kode Sub CPMK</th>
                    <th class="p-2 py-3 px-4 min-w-[10px] text-center font-bold uppercase">uraian Sub CPMK</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $index => $row)
                    <tr class="{{ $index % 2 == 0 ? 'bg-gray-100' : 'bg-white' }} hover:bg-gray-200 border-b">
                        <td class="p-2 py-3 px-4 min-w-[10px] text-justify uppercase">{{ $index + 1 }}</td>
                        <td class="p-2 py-3 px-4 min-w-[10px] text-justify uppercase">{{ $row->kode_mk }}</td>
                        <td class="p-2 py-3 px-4 min-w-[10px] text-justify uppercase">{{ $row->nama_mk }}</td>
                        <td class="p-2 py-3 px-4 min-w-[10px] text-justify uppercase">{{ $row->kode_cpmk }}</td>
                        <td class="p-2 py-3 px-4 min-w-[10px] text-justify uppercase">{{ $row->deskripsi_cpmk }}</td>
                        <td class="p-2 py-3 px-4 min-w-[10px] text-justify uppercase">{{ $row->sub_cpmk }}</td>
                        <td class="p-2 py-3 px-4 min-w-[10px] text-justify uppercase">{{ $row->uraian_cpmk }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        function updateFilter() {
            const tahunSelect = document.getElementById('tahun');
            const idTahun = tahunSelect.value;

            let url = "{{ route('tim.pemetaanmkcpmksubcpmk.index') }}";

            if (idTahun) {
                url += '?id_tahun=' + encodeURIComponent(idTahun);
            }

            window.location.href = url;
        }
    </script>
@endsection
