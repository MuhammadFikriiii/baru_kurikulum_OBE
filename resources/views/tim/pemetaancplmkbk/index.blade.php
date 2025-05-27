@extends('layouts.tim.app')

@section('content')
    <div class="mx-5 md:mx-10 my-10">
        <h2 class="text-4xl font-extrabold text-center mb-4">Pemetaan CPL - MK - BK</h2>

        <hr class="border border-black mb-4">

        <div class="w-full  overflow-x-auto border">

            <table class="min-w-max table-auto">
                <thead class="bg-green-800 sticky top-0  text-white text-sm text-center">
                    <tr>
                        <th class="text-center  bg-green-800">CPL / BK</th>
                        @foreach ($bks as $bk)
                            <th class="px-4 py-3 relative group">
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
                        @endforeach
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white text-sm text-gray-700">
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
                            @foreach ($bks as $bk)
                                <td class="px-4 py-3 border">
                                    @if (isset($matrix[$cpl->id_cpl][$bk->id_bk]))
                                        <ul class="list-disc pl-5 space-y-1">
                                            @foreach (array_unique($matrix[$cpl->id_cpl][$bk->id_bk]) as $mk)
                                                <li>{{ $mk }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <span class="text-gray-400"></span>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
