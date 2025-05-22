@extends('layouts.tim.app')

@section('content')
    <div class="mx-5 md:mx-20 my-10">
        <h2 class="text-4xl font-extrabold text-center mb-4">Pemetaan CPL - CPMK - MK</h2>
        <hr class="border border-black mb-4">

        <div class="overflow-auto border">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-green-800 text-white uppercase">
                    <tr>
                        <th class="border px-4 py-2">Kode CPL</th>
                        <th class="border px-4 py-2">Deskripsi CPL</th>
                        <th class="border px-4 py-2">Kode CPMK</th>
                        <th class="border px-4 py-2">Deskripsi CPMK</th>
                        <th class="border px-4 py-2">Mata Kuliah</th>
                    </tr>
                </thead>
                <tbody class="bg-white text-gray-700">
                    @foreach ($matrix as $kode_cpl => $cpl)
                        @php
                            $rowspan = count($cpl['cpmk']);
                            $first = true;
                        @endphp
                        @foreach ($cpl['cpmk'] as $kode_cpmk => $cpmk)
                            <tr>
                                @if ($first)
                                    <td class="border px-4 py-2" rowspan="{{ $rowspan }}">{{ $kode_cpl }}</td>
                                    <td class="border px-4 py-2" rowspan="{{ $rowspan }}">{{ $cpl['deskripsi'] }}</td>
                                    @php $first = false; @endphp
                                @endif
                                <td class="border px-4 py-2">{{ $kode_cpmk }}</td>
                                <td class="border px-4 py-2">{{ $cpmk['deskripsi'] }}</td>
                                <td class="border px-4 py-2 w-64 text-center">
                                    @foreach (array_unique($cpmk['mk']) as $mk)
                                        <div>{{ $mk }}</div>
                                    @endforeach
                                </td>

                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
