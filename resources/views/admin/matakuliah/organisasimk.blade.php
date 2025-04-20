@extends('layouts.app')

@section('content')
<div class="mr-20 ml-20">
    <h2 class="text-4xl font-extrabold text-center mb-4">Organisasi MK</h2>
    <hr class="border border-black mb-4">
    <table class="w-full border border-gray-300 shadow-md rounded-lg">
        <thead class="bg-green-500">
            <tr>
                <th class="py-2 px-3 text-center font-bold uppercase">Semester</th>
                <th class="py-2 px-3 text-center font-bold uppercase">SKS</th>
                <th class="py-2 px-3 text-center font-bold uppercase">Jumlah MK</th>
                <th class="py-2 px-3 text-center font-bold uppercase">Mata Kuliah</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalSks = 0;
                $totalMk = 0;
            @endphp

            @for ($i = 1; $i <= 8; $i++)
                @php
                    $data = $organisasiMK->get($i, [
                        'semester_mk' => $i,
                        'sks_mk' => 0,
                        'jumlah_mk' => 0,
                        'kode_mk' => [],
                    ]);

                    $totalSks += $data['sks_mk'];
                    $totalMk += $data['jumlah_mk'];
                @endphp
                <tr class="{{ $i % 2 == 0 ? 'bg-gray-100' : 'bg-white' }} hover:bg-gray-200 border-b">
                    <td class="py-2 px-3 text-center">Semester {{ $data['semester_mk'] }}</td>
                    <td class="py-2 px-3 text-center">{{ $data['sks_mk'] }}</td>
                    <td class="py-2 px-3 text-center">{{ $data['jumlah_mk'] }}</td>
                    <td class="py-2 px-3">
                        @if (count($data['kode_mk']) > 0)
                            @foreach ($data['kode_mk'] as $kode)
                                {{ $kode }}&nbsp;
                            @endforeach
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @endfor

            <tr class="font-bold bg-gray-300">
                <td class="py-2 px-3 text-center">Total</td>
                <td class="py-2 px-3 text-center">{{ $totalSks }}</td>
                <td class="py-2 px-3 text-center">{{ $totalMk }}</td>
                <td></td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
