@extends('layouts.wadir1.app')

@section('content')
    <div class="bg-white p-4 md:p-6 lg:p-8 rounded-lg shadow-md mx-2 md:mx-0">
        <h2 class="text-4xl font-extrabold text-center mb-4">Daftar Capaian Pembelajaran Matakuliah</h2>
        <hr class="w-full border border-black mb-4">

        {{-- ALERT --}}
        @if (session('success'))
            <div id="alert" class="bg-green-500 text-white px-4 py-2 rounded-md mb-4 text-center relative">
                <span class="font-bold">{{ session('success') }}</span>
                <button onclick="document.getElementById('alert').style.display='none'"
                    class="absolute top-1 right-3 text-white font-bold text-lg">&times;
                </button>
            </div>
        @endif

        @if (session('sukses'))
            <div id="alert" class="bg-red-500 text-white px-4 py-2 rounded-md mb-4 text-center relative">
                <span class="font-bold">{{ session('sukses') }}</span>
                <button onclick="document.getElementById('alert').style.display='none'"
                    class="absolute top-1 right-3 text-white font-bold text-lg">&times;
                </button>
            </div>
        @endif

        {{-- FILTER --}}
        <div class="flex flex-col md:flex-row items-start md:items-center mb-6 gap-4">
            <form method="GET" action="{{ route('wadir1.capaianpembelajaranmatakuliah.index') }}"
                class="flex flex-col md:flex-row gap-4 w-full md:w-auto">

                {{-- Prodi --}}
                <select name="kode_prodi" id="kode_prodi"
                    class="w-full md:w-64 border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                    onchange="this.form.submit()">
                    <option value="">Pilih Prodi</option>
                    @foreach ($prodis as $prodi)
                        <option value="{{ $prodi->kode_prodi }}" {{ $kode_prodi == $prodi->kode_prodi ? 'selected' : '' }}>
                            {{ $prodi->nama_prodi }}
                        </option>
                    @endforeach
                </select>

                {{-- Tahun --}}
                <select name="id_tahun" id="id_tahun"
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

            {{-- Search --}}
            <div class="sm:min-w-[250px] w-full sm:w-auto">
                <div
                    class="flex items-center border border-gray-300 rounded-md focus-within:ring-2 focus-within:ring-green-500 bg-white">
                    <span class="pl-3 text-gray-400">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" id="search" placeholder="Search..."
                        class="px-3 py-2 w-full focus:outline-none bg-transparent" />
                </div>
            </div>
        </div>

        {{-- JIKA BELUM PILIH PRODI --}}
        @if (empty($kode_prodi))
            <div class="p-8 text-center text-gray-600">
                <strong>Silakan pilih prodi terlebih dahulu.</strong>
            </div>
        @else
            {{-- TABEL --}}
            <table class="w-full border border-gray-300 shadow-md rounded-lg overflow-hidden">
                <thead class="bg-green-800 text-white border-b uppercase">
                    <tr>
                        <th class="py-3 px-6 min-w-[10px] text-center">No</th>
                        <th class="py-3 px-6 min-w-[10px] text-center">Prodi</th>
                        <th class="py-3 px-6 min-w-[10px] text-center">Kode CPMK</th>
                        <th class="py-3 px-6 min-w-[10px] text-center">Deskripsi CPMK</th>
                        <th class="py-3 px-6 min-w-[10px] text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cpmks as $index => $cpmk)
                        <tr class="{{ $index % 2 == 0 ? 'bg-gray-100' : 'bg-white' }} hover:bg-gray-200 border-b">
                            <td class="py-3 px-6 text-center">{{ $index + 1 }}</td>
                            <td class="py-3 px-6 text-center">{{ $cpmk->nama_prodi ?? 'Tidak ada prodi' }}</td>
                            <td class="py-3 px-6 text-center">{{ $cpmk->kode_cpmk }}</td>
                            <td class="py-3 px-6">{{ $cpmk->deskripsi_cpmk }}</td>
                            <td class="py-2 px-3 flex justify-center items-center space-x-2">
                                <a href="{{ route('wadir1.capaianpembelajaranmatakuliah.detail', $cpmk->id_cpmk) }}"
                                    class="bg-green-500 font-bold text-white px-3 py-1 rounded-md hover:bg-green-600">🛈</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
