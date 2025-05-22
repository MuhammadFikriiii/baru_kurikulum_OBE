@extends('layouts.tim.app')

@section('content')
    <div class="mr-20 ml-20">
        <h2 class="text-4xl font-extrabold text-center mb-4">Pemetaan CPL - PL</h2>
        <hr class="w-full border border-black mb-4">

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

        <form>
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
        </form>
        <p class="mt-3 italic text-red-500">*arahkan cursor pada kode cpl atau kode pl untuk melihat deskripsi*</p>
    </div>
@endsection
