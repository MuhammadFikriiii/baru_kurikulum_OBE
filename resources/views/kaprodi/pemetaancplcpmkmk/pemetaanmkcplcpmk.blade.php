@extends('layouts.kaprodi.app')
@section('content')
    <div class="mx-5 md:mx-20 my-10">
        <h2 class="text-4xl font-extrabold text-center mb-4">Pemetaan CPL - MK - CPMK</h2>
        <hr class="border border-black mb-4">

        <div class="overflow-visible border">
            <table class="min-w-full divide-y divide-gray-300 text-sm">
                <thead class="bg-green-800 text-white text-center">
                    <tr>
                        <th class="border px-4 py-2">Kode MK</th>
                        <th class="border px-4 py-2">Nama Mata Kuliah</th>
                        @foreach ($semuaCpl as $cpl)
                            <th class="border px-4 py-2 relative group cursor-pointer">
                                {{ $cpl->kode_cpl }}
                                <div
                                    class="absolute left-1/2 -translate-x-1/2 top-full mt-1 hidden group-hover:block w-64 bg-black text-white text-sm rounded p-2 z-50 text-center shadow-lg">
                                    <div class="bg-gray-600"><strong>{{ $cpl->nama_prodi ?? '-' }}</strong></div>
                                    <div class="mt-3 text-justify">{{ $cpl->deskripsi_cpl ?? '-' }}</div>
                                </div>
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="bg-white text-gray-800">
                    @foreach ($matrix as $kodeMk => $mk)
                        <tr>
                            <td class="border px-4 py-2 align-top text-center">{{ $kodeMk }}</td>
                            <td class="border px-4 py-2 align-top text-center">{{ $mk['nama'] }}</td>
                            @foreach ($semuaCpl as $cpl)
                                <td class="border px-4 py-2 text-center relative">
                                    @if (!empty($mk['cpl'][$cpl->kode_cpl]['cpmks']))
                                        @foreach ($mk['cpl'][$cpl->kode_cpl]['cpmks'] as $kodeCpmk)
                                            <div class="group inline-block relative cursor-pointer px-1">
                                                <span>{{ $kodeCpmk }}</span>
                                                <div
                                                    class="absolute left-1/2 -translate-x-1/2 top-full mt-1 hidden group-hover:block w-64 bg-black text-white text-sm rounded p-2 z-50 text-center shadow-lg">
                                                    <div class="bg-gray-600 font-bold">
                                                        <strong>{{ $mk['cpl'][$cpl->kode_cpl]['cpmk_details'][$kodeCpmk]['nama_prodi'] ?? '-' }}</strong>
                                                    </div>
                                                    <div class="mt-3 text-justify">
                                                        {{ $mk['cpl'][$cpl->kode_cpl]['cpmk_details'][$kodeCpmk]['deskripsi_cpmk'] ?? '-' }}
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                        @endforeach
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