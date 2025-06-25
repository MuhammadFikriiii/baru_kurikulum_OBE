@extends('layouts.tim.app')

@section('content')
    <div class="bg-white p-4 md:p-6 lg:p-8 rounded-lg shadow-md mx-2 md:mx-0">
        <h2 class="text-4xl font-extrabold text-center mb-4">Daftar Capaian Pembelajaran Matakuliah</h2>
        <hr class="w-full border border-black mb-4">

        @if (session('success'))
            <div id="alert" class="bg-green-500 text-white px-4 py-2 rounded-md mb-4 text-center relative">
                <span class="font-bold">{{ session('success') }}</span>
                <button onclick="document.getElementById('alert').style.display='none'"
                    class="absolute top-1 right-3 text-white font-bold text-lg">&times;</button>
            </div>
        @endif

        @if (session('sukses'))
            <div id="alert" class="bg-red-500 text-white px-4 py-2 rounded-md mb-4 text-center relative">
                <span class="font-bold">{{ session('sukses') }}</span>
                <button onclick="document.getElementById('alert').style.display='none'"
                    class="absolute top-1 right-3 text-white font-bold text-lg">&times;</button>
            </div>
        @endif

        <div class="flex justify-between mb-4 flex-wrap gap-2">
            <a href="{{ route('tim.capaianpembelajaranmatakuliah.create') }}"
                class="bg-green-600 inline-flex text-white font-bold px-4 py-2 rounded-md hover:bg-green-800">
                Tambah CPMK
            </a>

            <select id="tahun" name="id_tahun"
                class="border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                onchange="updateFilter()">
                <option value="" {{ empty($id_tahun) ? 'selected' : '' }}>Semua Tahun</option>
                @foreach ($tahun_tersedia as $thn)
                    <option value="{{ $thn->id_tahun }}" {{ $id_tahun == $thn->id_tahun ? 'selected' : '' }}>
                        {{ $thn->nama_kurikulum }} - {{ $thn->tahun }}
                    </option>
                @endforeach
            </select>

            <input type="text" id="search" placeholder="Search..."
                class="border border-black px-3 py-2 rounded-md ml-auto">
        </div>

        @if ($id_tahun)
            <div class="mb-4 p-3 bg-blue-50 border border-blue-200 rounded-md">
                <div class="flex flex-wrap gap-2 items-center">
                    <span class="text-sm text-blue-800 font-medium">Filter aktif:</span>
                    @php
                        $selected_tahun = $tahun_tersedia->where('id_tahun', $id_tahun)->first();
                    @endphp
                    <span
                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        Tahun:
                        {{ $selected_tahun ? $selected_tahun->nama_kurikulum . ' - ' . $selected_tahun->tahun : $id_tahun }}
                    </span>
                    <a href="{{ route('tim.capaianpembelajaranmatakuliah.index') }}"
                        class="text-xs text-blue-600 hover:text-blue-800 underline">Reset filter</a>
                </div>
            </div>
        @endif

        <table class="w-full border border-gray-300 shadow-md rounded-lg overflow-hidden">
            <thead class="bg-green-800 text-white border-b">
                <tr>
                    <th class="py-2 px-3 text-center">No</th>
                    <th class="py-2 px-3 text-center">Kode CPMK</th>
                    <th class="py-2 px-3 text-center">Deskripsi CPMK</th>
                    <th class="py-2 px-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cpmks as $index => $cpmk)
                    <tr class="{{ $index % 2 == 0 ? 'bg-gray-100' : 'bg-white' }} hover:bg-gray-200 border-b">
                        <td class="py-2 px-3 text-center">{{ $index + 1 }}</td>
                        <td class="py-2 px-3 text-center">{{ $cpmk->kode_cpmk }}</td>
                        <td class="py-2 px-3">{{ $cpmk->deskripsi_cpmk }}</td>
                        <td class="py-2 px-3 flex justify-center items-center space-x-2">
                            <a href="{{ route('tim.capaianpembelajaranmatakuliah.detail', $cpmk->id_cpmk) }}"
                                class="bg-gray-600 text-white px-3 py-1 rounded hover:bg-gray-700">🛈</a>
                            <a href="{{ route('tim.capaianpembelajaranmatakuliah.edit', $cpmk->id_cpmk) }}"
                                class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-800">✏️</a>
                            <form action="{{ route('tim.capaianpembelajaranmatakuliah.destroy', $cpmk->id_cpmk) }}"
                                method="POST" onsubmit="return confirm('Hapus CPMK ini?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-800">🗑️</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-gray-500 py-4">Belum ada data CPMK.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script>
        function updateFilter() {
            const tahunSelect = document.getElementById('tahun');
            const idTahun = tahunSelect.value;
            let url = "{{ route('tim.capaianpembelajaranmatakuliah.index') }}";

            if (idTahun) {
                url += '?id_tahun=' + encodeURIComponent(idTahun);
            }

            window.location.href = url;
        }
    </script>
@endsection
