@extends('layouts.app')

@section('content')
    <div class="mx-5 md:mx-20 my-10">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Pemenuhan CPL</h1>
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
                    <a href="{{ route('admin.pemenuhancpl.index') }}"
                        class="text-xs text-blue-600 hover:text-blue-800 underline">
                        Reset filter
                    </a>
                </div>
            </div>
        @endif

        @if (request()->has('kode_prodi'))
            <div class="bg-white rounded-lg shadow overflow-hidden">
                @if (empty($petaCPL) || count($petaCPL) === 0)
                    <div class="p-8 text-center text-gray-600">
                        <strong>Data belum tersedia untuk prodi ini.</strong>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-300">
                            <thead class="bg-green-800 text-white">
                                <tr>
                                    <th class="px-4 py-3">CPL</th>
                                    @for ($i = 1; $i <= 8; $i++)
                                        <th class="px-4 py-3">Semester {{ $i }}</th>
                                    @endfor
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($petaCPL as $item)
                                    <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }} hover:bg-gray-100">
                                        <td class="text-center px-4 py-4 border border-b">{{ $item['label'] }}</td>
                                        @for ($i = 1; $i <= 8; $i++)
                                            <td class="text-center px-4 py-4 border border-b">
                                                @if (!empty($item['semester']['Semester ' . $i]))
                                                    {!! implode('<br>', $item['semester']['Semester ' . $i]) !!}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        @endfor
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        @else
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-8 text-center text-gray-600">
                    Silakan pilih prodi terlebih dahulu untuk melihat data.
                </div>
            </div>
        @endif
    </div>
    <script>
        function updateFilter() {
            const prodiSelect = document.getElementById('prodi');
            const tahunSelect = document.getElementById('tahun');

            const kodeProdi = prodiSelect.value;
            const idTahun = tahunSelect.value;

            // Buat URL dengan parameter yang sesuai
            let url = "{{ route('admin.pemenuhancpl.index') }}";
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
