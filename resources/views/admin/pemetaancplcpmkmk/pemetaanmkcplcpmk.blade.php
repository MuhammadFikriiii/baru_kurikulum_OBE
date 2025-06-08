@extends('layouts.app')
@section('content')
    <div class="mx-5 md:mx-20 my-10">
        <h2 class="text-4xl font-extrabold text-center mb-4">Pemetaan MK - CPL - CPMK</h2>
        <hr class="border border-black mb-4">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <form method="GET" action="{{ route('admin.pemetaancplcpmkmk.pemetaanmkcplcpmk') }}" class="w-full md:w-64">
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