@extends('layouts.wadir1.app')

@section('content')
    <div class="bg-white p-4 md:p-6 lg:p-8 rounded-lg shadow-md mx-2 md:mx-0">
        <h2 class="text-4xl font-extrabold text-center mb-4">Daftar Bobot CPL - MK</h2>
        <hr class="w-full border border-black mb-6">

        {{-- ALERT --}}
        @if (session('success'))
            <div class="bg-green-500 text-white px-4 py-2 rounded-md mb-4 text-center relative">
                <span class="font-bold">{{ session('success') }}</span>
                <button onclick="this.parentElement.style.display='none'"
                    class="absolute top-1 right-3 text-white font-bold text-lg">×</button>
            </div>
        @endif

        {{-- FILTER --}}
        <div class="flex flex-col md:flex-row items-start md:items-center mb-6 gap-4">
            <form method="GET" action="{{ route('wadir1.bobot.index') }}"
                class="flex flex-col md:flex-row gap-4 w-full md:w-auto">

                {{-- Filter Prodi --}}
                <select name="kode_prodi"
                    class="w-full md:w-64 border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                    onchange="this.form.submit()">
                    <option value="">Pilih Prodi</option>
                    @foreach ($prodis as $prodi)
                        <option value="{{ $prodi->kode_prodi }}" {{ $kode_prodi == $prodi->kode_prodi ? 'selected' : '' }}>
                            {{ $prodi->nama_prodi }}
                        </option>
                    @endforeach
                </select>

                {{-- Filter Tahun --}}
                <select name="id_tahun"
                    class="w-full md:w-64 border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                    onchange="this.form.submit()">
                    <option value="">Semua Tahun</option>
                    @foreach ($tahun_tersedia as $tahun)
                        <option value="{{ $tahun->id_tahun }}" {{ $id_tahun == $tahun->id_tahun ? 'selected' : '' }}>
                            {{ $tahun->nama_kurikulum }} - {{ $tahun->tahun }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

        {{-- CEK PRODI DIPILIH --}}
        @if (empty($kode_prodi))
            <div class="p-8 text-center text-gray-600">
                <strong>Silakan pilih prodi terlebih dahulu.</strong>
            </div>
        @elseif ($bobots->isEmpty())
            <div class="p-8 text-center text-gray-600">
                <strong>Data bobot belum tersedia untuk prodi ini.</strong>
            </div>
        @else
            {{-- TABEL BOBOT --}}
            <table class="w-full border border-gray-300 shadow-md rounded-lg overflow-hidden">
                <thead class="bg-green-800 text-white border-b uppercase">
                    <tr>
                        <th class="py-3 px-6 text-center">No</th>
                        <th class="py-3 px-6 text-center">Kode CPL</th>
                        <th class="py-3 px-6 text-center">CPL</th>
                        <th class="py-3 px-6 text-center">MK</th>
                        <th class="py-3 px-6 text-center">Bobot</th>
                        <th class="py-3 px-6 text-center">Total Bobot</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $grouped = $bobots->groupBy('id_cpl'); @endphp
                    @foreach ($grouped as $id_cpl => $items)
                        @php
                            $cpl = $items->first()->capaianProfilLulusan;
                            $totalBobot = $items->sum('bobot');
                        @endphp
                        <tr class="{{ $loop->even ? 'bg-gray-100' : 'bg-white' }} hover:bg-gray-200 border-b align-top">
                            <td class="py-3 px-6 text-center">{{ $loop->iteration }}</td>
                            <td class="py-3 px-6 text-left font-semibold">{{ $cpl->kode_cpl }}</td>
                            <td class="py-3 px-6 text-left">{{ $cpl->deskripsi_cpl }}</td>
                            <td class="py-3 px-6 text-left text-sm text-gray-800">
                                @foreach ($items as $item)
                                    <div>{{ $item->kode_mk }}</div>
                                @endforeach
                            </td>
                            <td class="py-3 px-6 text-left text-sm text-gray-800">
                                @foreach ($items as $item)
                                    <div>{{ $item->bobot }}%</div>
                                @endforeach
                            </td>
                            <td class="py-3 px-6 text-center font-bold align-top">{{ $totalBobot }}%</td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex justify-center space-x-1 md:space-x-2">
                                    <a href="{{ route('wadir1.bobot.detail', $id_cpl) }}"
                                        class="bg-gray-600 hover:bg-gray-700 text-white p-1 md:p-2 rounded-md inline-flex items-center justify-center"
                                        title="Detail">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 md:h-4 md:w-4"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M18 10A8 8 0 11 2 10a8 8 0 0116 0zm-9-3a1 1 0 112 0 1 1 0 01-2 0zm2 5a1 1 0 10-2 0v2a1 1 0 102 0v-2z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
