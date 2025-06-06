@extends('layouts.app')

@section('content')
    <div class="mx-5 md:mx-20 my-10">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Pemetaan CPL - PL</h1>
            <hr class="border-t-4 border-black my-4 mx-auto mb-4">
        </div>

        @if (session('success'))
            <div id="alert"
                class="bg-green-500 text-white px-4 py-2 rounded-md mb-6 text-center relative max-w-4xl mx-auto">
                <span class="font-bold">{{ session('success') }}</span>
                <button onclick="document.getElementById('alert').style.display='none'"
                    class="absolute top-1 right-3 text-white font-bold text-lg">
                    &times;
                </button>
            </div>
        @endif

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-3 gap-4">
            <form method="GET" action="{{ route('admin.pemetaancplpl.index') }}" class="w-full md:w-64">
                <select id="prodi" name="kode_prodi"
                    class="w-full border border-gray-300 px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                    onchange="this.form.submit()">
                    <option value="" {{ empty($kode_prodi) ? 'selected' : '' }} disabled>Pilih Prodi</option>
                    @foreach ($prodis as $prodi)
                        <option value="{{ $prodi->kode_prodi }}" {{ $kode_prodi == $prodi->kode_prodi ? 'selected' : '' }}>
                            {{ $prodi->nama_prodi }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-lg shadow overflow-visible">
            @if (empty($kode_prodi))
                <div class="p-8 text-center text-gray-600">
                    Silakan pilih prodi terlebih dahulu.
                </div>
            @elseif($pls->isEmpty())
                <div class="p-8 text-center text-gray-600">
                    <strong>Data belum dibuat untuk prodi ini.</strong>
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

                <div class="">
                <table class="w-full border border-gray-300 shadow-md rounded-lg overflow-visible">
                <thead class="bg-green-800 text-white">
                    <tr>
                        <th class="px-4 py-2 text-left"></th>
                        @foreach ($pls as $pl)
                            <th class="px-2 py-2 relative group">
                                <span class="cursor-help">{{ $pl->kode_pl }}</span>
                                <div
                                    class="absolute left-1/2 -translate-x-1/2 top-full mb-4 hidden group-hover:block w-64 bg-black text-white text-sm rounded p-2 z-50 text-center shadow-lg">
                                    <div class="bg-gray-600 rounded-t px-2 py-1 font-bold">
                                        {{ $pl->prodi->nama_prodi }}
                                    </div>
                                    <div class="mt-3 px-2 text-justify">
                                        {{ $pl->deskripsi_pl }}
                                    </div>
                                </div>
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cpls as $index => $cpl)
                        <tr class="{{ $index % 2 == 0 ? 'bg-gray-100' : 'bg-white' }} hover:bg-gray-200 border">
                            <td class="px-4 py-2 relative group">
                                <span class="cursor-help">{{ $cpl->kode_cpl }}</span>
                                <div
                                    class="absolute left-1/2 -translate-x-1/2 top-full mb-4 hidden group-hover:block w-64 bg-black text-white text-sm rounded p-2 z-50 text-center shadow-lg">

                                    <div class="bg-gray-600 rounded-t px-2 py-1 font-bold">
                                        {{ $prodiByCpl[$cpl->id_cpl] }}
                                    </div>
                                    <div class="mt-3 px-2 text-justify">
                                        {{ $cpl->deskripsi_cpl }}
                                    </div>
                                </div>
                            </td>
                            @foreach ($pls as $pl)
                                <td class="px-4 py-2 text-center">
                                    <input type="checkbox" disabled
                                        {{ isset($relasi[$pl->id_pl]) && in_array($cpl->id_cpl, $relasi[$pl->id_pl]->pluck('id_cpl')->toArray()) ? 'checked' : '' }}
                                        class="h-5 w-5 mx-auto appearance-none rounded border-2 border-blue-600 bg-white checked:bg-white-600 checked:border-blue-600 disabled:opacity-100 disabled:cursor-default relative">
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
@endsection