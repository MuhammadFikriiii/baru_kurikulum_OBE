@extends('layouts.app')

@section('content')
<div class="mx-5 md:mx-20 my-10">
    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Pemetaan CPL - MK</h1>
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

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <form method="GET" action="{{ route('admin.pemetaancplmk.index') }}" class="w-full md:w-64">
            <select name="kode_prodi" id="kode_prodi"
                class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                onchange="this.form.submit()">
                <option value="">Pilih Prodi</option>
                @foreach ($prodis as $prodi)
                    <option value="{{ $prodi->kode_prodi }}" {{ $kode_prodi == $prodi->kode_prodi ? 'selected' : '' }}>
                        {{ $prodi->nama_prodi }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    @if ($kode_prodi)
        <div class="bg-white rounded-lg shadow">
            @if ($cpls->isEmpty())
                <div class="p-8 text-center text-gray-600">
                    <strong>Data belum dibuat untuk prodi ini.</strong>
                </div>
            @else
                <style>
                    input[type="checkbox"]:checked::before {
                        content: "✓";
                        color: white;
                        font-size: 1rem;
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%);
                    }
                </style>

                <div class="">
                    <table class="w-full border border-gray-300 shadow-md rounded-lg">
                        <thead class="bg-green-800 text-white">
                            <tr>
                                <th class="px-4 py-2 text-left"></th>
                                @foreach ($mks as $mk)
                                    <th class="px-2 py-2 relative group">
                                        <span class="cursor-help">{{ $mk->kode_mk }}</span>
                                        <div
                                            class="absolute left-1/2 -translate-x-1/2 top-full mb-4 hidden group-hover:block w-64 bg-black text-white text-sm rounded p-2 z-50 text-center shadow-lg">
                                            <div class="bg-gray-600 rounded-t px-2 py-1 font-bold">
                                                {{ $mk->nama_prodi }}
                                            </div>
                                            <div class="mt-3 px-2 text-center">
                                                {{ $mk->nama_mk }}
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
                                                {{ $prodiByCpl[$cpl->id_cpl] ?? 'Program Studi Tidak Ditemukan' }}
                                            </div>
                                            <div class="mt-3 px-2 text-justify">
                                                {{ $cpl->deskripsi_cpl }}
                                            </div>
                                        </div>
                                    </td>
                                    @foreach ($mks as $mk)
                                        <td class="px-4 py-2 text-center">
                                            <input type="checkbox" disabled
                                                {{ isset($relasi[$mk->kode_mk]) && in_array($cpl->id_cpl, $relasi[$mk->kode_mk]->pluck('id_cpl')->toArray()) ? 'checked' : '' }}
                                                class="h-5 w-5 mx-auto appearance-none rounded border-2 border-blue-600 bg-white checked:bg-blue-600 checked:border-blue-600 disabled:opacity-100 disabled:cursor-default relative">
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            <p class="mt-3 italic text-red-500">*arahkan cursor pada kode cpl atau kode mk untuk melihat deskripsi*</p>
        </div>
    @else
        <div class="p-8 text-center text-gray-600">
            Silakan pilih prodi terlebih dahulu.
        </div>
    @endif
</div>
@endsection
