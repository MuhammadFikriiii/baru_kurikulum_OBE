@extends('layouts.tim.app')

@section('content')
<div class="bg-white p-4 md:p-6 lg:p-8 rounded-lg shadow-md mx-2 md:mx-0">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Pemetaan CPL - BK</h1>
        <hr class="border-t-2 md:border-t-4 border-black my-3 md:my-4 mx-auto">
    </div>

        @if (session('success'))
            <div id="alert" class="bg-green-500 text-white px-4 py-2 rounded-md mb-4 text-center relative">
                <span class="font-bold">{{ session('success') }}</span>
                <button onclick="document.getElementById('alert').style.display='none'"
                    class="absolute top-1 right-3 text-white font-bold text-lg">
                    &times;
                </button>
            </div>
        @endif

        <style>
            input[type="checkbox"]:checked::before {
                content: "✔";
                color: white;
                font-size: 1rem;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -55%);
            }
        </style>

        <!-- Filter Tahun -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-3 gap-4">
        <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto">
        <select id="tahun" name="id_tahun"
            class="border border-black px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
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
                    <a href="{{ route('tim.pemetaancplbk.index') }}"
                        class="text-xs text-blue-600 hover:text-blue-800 underline">
                        Reset filter
                    </a>
                </div>
            </div>
        @endif

        <div class="bg-white rounded-lg shadow overflow-visible mt-6">
            @if (!empty($cpls) && $cpls->isNotEmpty())
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

        <div class="">
            <table class="w-full border border-gray-300 shadow-md rounded-lg overflow-visible">
                <thead class="bg-green-800 text-white">
                    <tr>
                        <th class="px-4 py-2 text-left"></th> <!-- Header kiri kosong untuk BK kolom -->
                        @foreach ($cpls as $cpl)
                            <th class="px-4 py-2 relative group">
                                <span class="cursor-help">{{ $cpl->kode_cpl }}</span>
                                <div
                                    class="absolute left-1/2 -translate-x-1/2 top-full mb-4 hidden group-hover:block w-64 bg-black text-white text-sm rounded p-2 z-50 text-center shadow-lg">
                                    <div class="bg-gray-600 rounded-t px-2 py-1 font-bold">
                                        {{ $prodiByCpl[$cpl->id_cpl] ?? '' }}
                                    </div>
                                    <div class="mt-3 px-2 text-justify">
                                        {{ $cpl->deskripsi_cpl }}
                                    </div>
                                </div>
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bks as $index => $bk)
                        <tr class="{{ $index % 2 == 0 ? 'bg-gray-100' : 'bg-white' }} hover:bg-gray-200 border">
                            <td class="px-4 py-2 relative group font-semibold">
                                <span class="cursor-help">{{ $bk->kode_bk }}</span>
                                <div
                                    class="absolute left-1/2 -translate-x-1/2 top-full mb-4 hidden group-hover:block w-64 bg-black text-white text-sm rounded p-2 z-50 text-center shadow-lg">
                                    <div class="bg-gray-600 rounded-t px-2 py-1 font-bold">
                                        {{ $prodi->nama_prodi }}
                                    </div>
                                    <div class="mt-3 px-2 text-center">
                                        {{ $bk->nama_bk }}
                                    </div>
                                </div>
                            </td>
                            @foreach ($cpls as $cpl)
                                <td class="px-4 py-2 text-center">
                                    <input type="checkbox" disabled
                                        {{ isset($relasi[$bk->id_bk]) && in_array($cpl->id_cpl, $relasi[$bk->id_bk]->pluck('id_cpl')->toArray()) ? 'checked' : '' }}
                                        class="h-5 w-5 mx-auto appearance-none rounded border-2 border-blue-600 bg-white checked:bg-white-600 checked:border-blue-600 disabled:opacity-100 disabled:cursor-default relative">
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
    <div class="p-8 text-center text-gray-600">
       Data belum dibuat
    </div>
@endif
        <p class="mt-3 italic text-red-500">*arahkan cursor pada kode BK atau kode CPL untuk melihat deskripsi*</p>
       </div>
</div>

    <script>
        function updateFilter() {
            const tahunSelect = document.getElementById('tahun');
            const idTahun = tahunSelect.value;

            let url = "{{ route('tim.pemetaancplbk.index') }}";

            if (idTahun) {
                url += '?id_tahun=' + encodeURIComponent(idTahun);
            }

            window.location.href = url;
        }
    </script>
@endsection
