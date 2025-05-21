@extends('layouts.tim.app')

@section('content')
    <div class="mx-5 md:mx-20 my-10">
        <h2 class="text-4xl font-extrabold text-center mb-4">Pemetaan CPL - CPMK - MK Per Semester</h2>
        <hr class="border border-black mb-4">

        <div class="overflow-auto border">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-green-500 text-white">
                    <tr>
                        <th class="border px-4 py-2">CPL</th>
                        <th class="border px-4 py-2">CPMK</th>
                        @for ($i = 1; $i <= 8; $i++)
                            <th class="border px-4 py-2">Semester {{ $i }}</th>
                        @endfor
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
                                    @php $first = false; @endphp
                                @endif
                                <td class="border px-4 py-2">{{ $kode_cpmk }}</td>
                                @for ($i = 1; $i <= 8; $i++)
                                    <td class="border px-4 py-2 whitespace-pre-line">
                                        @if (!empty($cpmk['semester'][$i]))
                                            {!! implode('<br>', $cpmk['semester'][$i]) !!}
                                        @endif
                                    </td>
                                @endfor
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection