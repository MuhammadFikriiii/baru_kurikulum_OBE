@extends('layouts.app')

@section('content')
<div class="mx-5 md:mx-20 my-10">
    <h2 class="text-4xl font-extrabold text-center mb-4">Pemetaan CPL - CPMK - MK</h2>
    <hr class="border border-black mb-4">

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <form method="GET" action="{{ route('admin.pemetaancplcpmkmk.index') }}" class="w-full md:w-64">
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
            @if (empty($matrix))
                <div class="p-8 text-center text-gray-600">
                    <strong>Data belum dibuat untuk prodi ini.</strong>
                </div>
            @else
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
            @endif
        </div>
    @else
        <div class="p-8 text-center text-gray-600">
            Silakan pilih prodi terlebih dahulu.
        </div>
    @endif
</div>
@endsection