@extends('layouts.tim.app')

@section('content')
    <div class="bg-white p-4 md:p-6 lg:p-8 rounded-lg shadow-md mx-2 md:mx-0">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Organisasi MK</h1>
            <hr class="border-t-2 md:border-t-4 border-black my-3 md:my-4 mx-auto">
        </div>
        <!-- Filter Tahun -->
        <select id="tahun" name="id_tahun"
            class="border border-black mb-4 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
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
                    <a href="{{ route('tim.matakuliah.organisasimk') }}"
                        class="text-xs text-blue-600 hover:text-blue-800 underline">
                        Reset filter
                    </a>
                </div>
            </div>
        @endif
        <table class="w-full border border-gray-300 shadow-md rounded-lg">
            <thead class="bg-green-800 text-white">
                <tr>
                    <th class="py-2 px-3 text-center font-bold uppercase">Semester</th>
                    <th class="py-2 px-3 text-center font-bold uppercase">SKS</th>
                    <th class="py-2 px-3 text-center font-bold uppercase">Jumlah MK</th>
                    <th class="py-2 px-3 text-center font-bold uppercase">Mata Kuliah</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalSks = 0;
                    $totalMk = 0;
                @endphp

                @for ($i = 1; $i <= 8; $i++)
                    @php
                        $data = $organisasiMK->get($i, [
                            'semester_mk' => $i,
                            'sks_mk' => 0,
                            'jumlah_mk' => 0,
                            'nama_mk' => [],
                        ]);

                        $totalSks += $data['sks_mk'];
                        $totalMk += $data['jumlah_mk'];
                    @endphp
                    <tr class="{{ $i % 2 == 0 ? 'bg-gray-100' : 'bg-white' }} hover:bg-gray-200 border-b">
                        <td class="py-2 px-3 text-center">Semester {{ $data['semester_mk'] }}</td>
                        <td class="py-2 px-3 text-center">{{ $data['sks_mk'] }}</td>
                        <td class="py-2 px-3 text-center">{{ $data['jumlah_mk'] }}</td>
                        <td class="py-2 px-3">
                            @if (count($data['nama_mk']) > 0)
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($data['nama_mk'] as $kode)
                                        <span class="border border-black px-2 py-1 rounded">
                                            {{ $kode }}
                                        </span>
                                    @endforeach
                                </div>
                            @else
                                {{ null }}
                            @endif
                        </td>
                    </tr>
                @endfor

                <tr class="font-bold bg-black text-white">
                    <td class="py-2 px-3 text-center">Total</td>
                    <td class="py-2 px-3 text-center">{{ $totalSks }}</td>
                    <td class="py-2 px-3 text-center">{{ $totalMk }}</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>

    <script>
        function updateFilter() {
            const tahunSelect = document.getElementById('tahun');
            const idTahun = tahunSelect.value;

            let url = "{{ route('tim.matakuliah.organisasimk') }}";

            if (idTahun) {
                url += '?id_tahun=' + encodeURIComponent(idTahun);
            }

            window.location.href = url;
        }
    </script>
@endsection
