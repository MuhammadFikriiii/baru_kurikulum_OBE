@extends('layouts.app')

@section('content')

    <div class="container mx-auto px-4">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Pemetaan CPL - BK - MK</h1>
            <hr class="border-t-4 border-black my-4 mx-auto mb-4">
        </div>

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <form method="GET" action="{{ route('admin.pemetaancplmkbk.index') }}" class="w-full md:w-64">
                <select name="kode_prodi"
                    class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                    onchange="this.form.submit()">
                    <option value="" {{ empty($kode_prodi) ? 'selected' : '' }} disabled>Pilih Prodi</option>
                    @foreach ($prodis as $item)
                        <option value="{{ $item->kode_prodi }}" {{ $kode_prodi == $item->kode_prodi ? 'selected' : '' }}>
                            {{ $item->nama_prodi }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

        <div class="bg-white rounded-lg shadow overflow-visible">
            @if (empty($kode_prodi))
                <div class="p-8 text-center text-gray-600">
                    Silakan pilih prodi terlebih dahulu.
                </div>
            @elseif($bks->isEmpty() || $cpls->isEmpty())
                <div class="p-8 text-center text-gray-600">
                    <strong>Data belum tersedia untuk prodi ini.</strong>
                </div>
            @else
                <div class="">
                    <table class="min-w-full border border-gray-300">
                        <thead class="bg-green-800 text-white">
                            <tr>
                                <th class="px-4 py-3 text-left border-r border-white">CPL / BK</th>
                                @foreach ($bks as $bk)
                                    <th class="px-4 py-3 border-r border-white relative group">
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
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cpls as $cpl)
                                <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }} hover:bg-gray-100">
                                    <td class="px-4 py-4 font-semibold border border-gray-200 relative group">
                                        <span class="cursor-help">{{ $cpl->kode_cpl ?? $cpl->id_cpl }}</span>
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
                                        <td class="px-4 py-4 border border-gray-200">
                                            @if (isset($matrix[$cpl->id_cpl][$bk->id_bk]))
                                                <ul class="list-disc pl-5 space-y-1">
                                                    @foreach (array_unique($matrix[$cpl->id_cpl][$bk->id_bk]) as $mk)
                                                        <li>{{ $mk }}</li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <span class="text-gray-400">-</span>
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

@endsection
