@extends('layouts.app')

@section('content')
    <div class="bg-white p-4 md:p-6 lg:p-8 rounded-lg shadow-md mx-2 md:mx-0">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Pemetaan BK - MK</h2>
            <hr class="border-t-2 md:border-t-4 border-black my-3 md:my-4 mx-auto">

            @if (session('success'))
                <div id="alert" class="bg-green-500 text-white px-4 py-3 rounded-md mb-6 text-center relative">
                    <span class="font-semibold">{{ session('success') }}</span>
                    <button onclick="document.getElementById('alert').style.display='none'"
                        class="absolute top-2 right-3 text-white font-bold hover:text-gray-200">
                        &times;
                    </button>
                </div>
            @endif

            <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto pt-4">
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
                        <a href="{{ route('admin.pemetaanbkmk.index') }}"
                            class="text-xs text-blue-600 hover:text-blue-800 underline">
                            Reset filter
                        </a>
                    </div>
                </div>
            @endif

            <div class="bg-white rounded-lg shadow overflow-hidden mt-3">
                @if (!request()->has('kode_prodi') || empty($kode_prodi))
                    <div class="p-8 text-center text-gray-600">
                        Silakan pilih prodi terlebih dahulu untuk melihat data pemetaan.
                    </div>
                @elseif($bks->isEmpty())
                    <div class="p-8 text-center text-gray-600">
                        <strong>Data belum tersedia untuk prodi ini.</strong>
                    </div>
                @else
                    <style>
                        input[type="checkbox"]:checked {
                            background-color: #2563eb;
                            border-color: #2563eb;
                        }

                        input[type="checkbox"]:checked::before {
                            content: "✓";
                            color: white;
                            font-size: 1rem;
                            position: absolute;
                            top: 50%;
                            left: 50%;
                            transform: translate(-50%, -55%);
                        }
                    </style>

                    <div class="overflow-x-auto">
                        <table class="w-full border border-gray-200 shadow-sm rounded-lg overflow-visible">
                            <thead class="bg-green-800 text-white">
                                <tr>
                                    <th class="px-6 py-3 text-left font-semibold"></th>
                                    @foreach ($mks as $mk)
                                        <th class="px-4 py-3 relative group text-center whitespace-nowrap">
                                            <span class="cursor-help">{{ $mk->kode_mk }}</span>
                                            <div
                                                class="absolute left-1/2 -translate-x-1/2 top-full mb-4 hidden group-hover:block w-64 bg-black text-white text-sm rounded p-2 z-50 text-center shadow-lg break-words">
                                                <div class="bg-gray-600 rounded-t px-2 py-1 font-bold">
                                                    {{ $mk->nama_prodi }}
                                                </div>
                                                <div class="mt-3 px-2 text-center whitespace-normal">
                                                    {{ $mk->nama_mk }}
                                                </div>
                                            </div>
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($bks as $bk)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap relative group">
                                            <span class="cursor-help font-medium">{{ $bk->kode_bk }}</span>
                                            <div
                                                class="absolute left-0 ml-4 top-full mb-4 hidden group-hover:block w-64 bg-black text-white text-sm rounded p-2 z-50 text-left shadow-lg break-words">
                                                <div class="bg-gray-600 rounded-t px-2 py-1 font-bold text-center">
                                                    {{ $bk->nama_prodi }}
                                                </div>
                                                <div class="mt-3 px-2 text-justify whitespace-normal">
                                                    {{ $bk->nama_bk }}
                                                </div>
                                            </div>
                                        </td>
                                        @foreach ($mks as $mk)
                                            <td class="px-4 py-4 text-center">
                                                <input type="checkbox" disabled
                                                    {{ isset($relasi[$mk->kode_mk]) && in_array($bk->id_bk, $relasi[$mk->kode_mk]->pluck('id_bk')->toArray()) ? 'checked' : '' }}
                                                    class="h-5 w-5 mx-auto appearance-none rounded border-2 border-blue-600 bg-white checked:bg-blue-600 checked:border-blue-600 disabled:opacity-100 disabled:cursor-default relative">
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        function updateFilter() {
            const kodeProdi = document.getElementById('prodi').value;
            const idTahun = document.getElementById('tahun').value;

            const base = "{{ route('admin.pemetaanbkmk.index') }}";
            const params = new URLSearchParams(window.location.search);

            if (kodeProdi) {
                params.set('kode_prodi', kodeProdi);
            }

            if (idTahun) {
                params.set('id_tahun', idTahun);
            }

            window.location.href = `${base}?${params.toString()}`;
        }
    </script>
@endsection
