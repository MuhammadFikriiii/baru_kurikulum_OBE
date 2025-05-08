@extends('layouts.app')

@section('content')
<div class="mr-20 ml-20">
    <h2 class="text-4xl font-extrabold text-center mb-4">Organisasi MK</h2>
    <hr class="border border-black mb-4">
    <form method="GET" action="{{ route('admin.matakuliah.organisasimk') }}" class="flex items-center mb-4">
        <select id="prodi" name="kode_prodi" class="border border-gray-300 px-3 py-2 rounded-md mr-2" onchange="this.form.submit()">
            <option value="all" {{ $kode_prodi == 'all' ? 'selected' : '' }}>Semua Program Studi</option>
            @foreach($prodis as $prodi)
                <option value="{{ $prodi->kode_prodi }}" {{ $kode_prodi == $prodi->kode_prodi ? 'selected' : '' }}>
                    {{ $prodi->nama_prodi }}
                </option>
            @endforeach
        </select>
    </form>
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
                        'nama_mk' => [],
                    ]);

                    $totalSks += $data['sks_mk'];
                    $totalMk += $data['jumlah_mk'];
                @endphp
                <tr class="{{ $i % 2 == 0 ? 'bg-gray-100' : 'bg-white' }} hover:bg-gray-200 border-b">
                    <td class="py-2 px-3 text-center">Semester {{ $data['semester_mk'] }}</td>
                    <td class="py-2 px-3 text-center">{{ $data['sks_mk'] }}</td>
                    <td class="py-2 px-3 text-center">{{ $data['jumlah_mk'] }}</td>
                    <td class="py-2 px-3">
                        @if (count($data['nama_mk']) > 0)
                            @foreach ($data['nama_mk'] as $kode)
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
