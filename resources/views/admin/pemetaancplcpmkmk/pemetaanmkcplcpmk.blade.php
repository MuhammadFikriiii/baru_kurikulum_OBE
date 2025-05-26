@extends('layouts.app')
@section('content')
    <div class="mx-5 md:mx-20 my-10">
        <h2 class="text-4xl font-extrabold text-center mb-4">Pemetaan MK - CPL - CPMK</h2>
        <hr class="border border-black mb-4">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <form method="GET" action="{{ route('admin.pemetaancplcpmkmk.pemenuhancplcpmkmk') }}" class="w-full md:w-64">
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
