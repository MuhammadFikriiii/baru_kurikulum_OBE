@extends('layouts.app')
@section('content')
    <div class="mx-5 md:mx-20 my-10">
        <h2 class="text-4xl font-extrabold text-center mb-4">Pemetaan MK - CPL - CPMK</h2>
        <hr class="border border-black mb-4">

        <div class="overflow-auto border">
            <table class="min-w-full divide-y divide-gray-300 text-sm">
                <thead class="bg-green-500 text-white text-center">
                    <tr>
                        <th class="border px-4 py-2">Kode MK</th>
                        <th class="border px-4 py-2">Nama Mata Kuliah</th>
                        @foreach ($semuaCpl as $cpl)
                            <th class="border px-4 py-2">{{ $cpl->kode_cpl }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="bg-white text-gray-800">
                    @foreach ($matrix as $kodeMk => $mk)
                        <tr>
                            <td class="border px-4 py-2 align-top">{{ $kodeMk }}</td>
                            <td class="border px-4 py-2 align-top">{{ $mk['nama'] }}</td>
                            @foreach ($semuaCpl as $cpl)
                                <td class="border px-4 py-2 whitespace-pre-line text-center">
                                    @if (isset($mk['cpl'][$cpl->kode_cpl]))
                                        {!! implode('<br>', $mk['cpl'][$cpl->kode_cpl]['cpmks']) !!}
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
