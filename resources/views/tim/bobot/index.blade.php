@extends('layouts.tim.app')

@section('content')
    <div class="bg-white p-4 md:p-6 lg:p-8 rounded-lg shadow-md mx-2 md:mx-0">
        <h2 class="text-4xl font-extrabold text-center mb-4">Daftar Bobot CPL - MK</h2>
        <hr class="w-full border border-black mb-6">

        @if (session('success'))
            <div class="bg-green-500 text-white px-4 py-2 rounded-md mb-4 text-center relative">
                <span class="font-bold">{{ session('success') }}</span>
                <button onclick="this.parentElement.style.display='none'"
                    class="absolute top-1 right-3 text-white font-bold text-lg">×</button>
            </div>
        @endif

        <!-- Filter Tahun & Tombol Tambah -->
        <div class="flex flex-col md:flex-row items-start md:items-center mb-6 gap-4">

            <div class="space-x-2">
                <a href="{{ route('tim.bobot.create') }}"
                    class="bg-green-600 inline-flex text-white font-bold px-4 py-2 rounded-md hover:bg-green-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Tambah
                </a>
            </div>

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
        </div>

        <!-- Info Filter Aktif -->
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
                    <a href="{{ route('tim.bobot.index') }}"
                        class="text-xs text-blue-600 hover:text-blue-800 underline">Reset filter</a>
                </div>
            </div>
        @endif

        <table class="w-full border border-gray-300 shadow-md rounded-lg overflow-hidden">
            <thead class="bg-green-800 text-white border-b uppercase">
                <tr>
                    <th class="py-3 px-6 text-center">No</th>
                    <th class="py-3 px-6 text-center">KODE CPL</th>
                    <th class="py-3 px-6 text-center">CPL</th>
                    <th class="py-3 px-6 text-center">MK</th>
                    <th class="py-3 px-6 text-center">Bobot</th>
                    <th class="py-3 px-6 text-center">Total Bobot</th>
                    <th class="py-3 px-6 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $grouped = $bobots->groupBy('id_cpl');
                @endphp
                @foreach ($grouped as $id_cpl => $items)
                    @php
                        $first = $items->first();
                        $totalBobot = $items->sum('bobot');
                    @endphp
                    <tr class="{{ $loop->even ? 'bg-gray-100' : 'bg-white' }} hover:bg-gray-200 border-b align-top">
                        <td class="py-3 px-6 text-center">{{ $loop->iteration }}</td>
                        <td class="py-3 px-6 text-left font-bold">{{ $first->kode_cpl ?? '-' }}</td>
                        <td class="py-3 px-6 text-left">{{ $first->deskripsi_cpl ?? '-' }}</td>
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
                        <td class="py-3 px-6 flex flex-col items-center space-y-1">
                            <a href="{{ route('tim.bobot.detail', $first->id_cpl) }}"
                                class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 font-bold text-center">🛈</a>
                            <a href="{{ route('tim.bobot.edit', $first->id_cpl) }}"
                                class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 font-bold text-center">✏️</a>
                            <form action="{{ route('tim.bobot.destroy', $first->id_cpl) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus semua bobot untuk CPL ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 font-bold text-center">
                                    🗑️
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        function updateFilter() {
            const tahunSelect = document.getElementById('tahun');
            const idTahun = tahunSelect.value;
            let url = "{{ route('tim.bobot.index') }}";
            if (idTahun) {
                url += '?id_tahun=' + encodeURIComponent(idTahun);
            }
            window.location.href = url;
        }
    </script>
@endsection
