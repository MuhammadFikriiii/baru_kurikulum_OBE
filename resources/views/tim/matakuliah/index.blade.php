@extends('layouts.tim.app')

@section('content')
    <div class="mr-20 ml-20">
        <h1 class="text-2xl font-bold text-gray-700 mb-4 text-center">Daftar Mata Kuliah</h1>
        <hr class="border-t-4 border-black my-8">

        @if (session('success'))
            <div id="alert" class="bg-green-500 text-white px-4 py-2 rounded-md mb-4 text-center relative">
                <span class="font-bold">{{ session('success') }}</span>
                <button onclick="document.getElementById('alert').style.display='none'"
                    class="absolute top-1 right-3 text-white font-bold text-lg">
                    &times;
                </button>
            </div>
        @endif

        @if (session('sukses'))
            <div id="alert" class="bg-red-500 text-white px-4 py-2 rounded-md mb-4 text-center relative">
                <span class="font-bold">{{ session('sukses') }}</span>
                <button onclick="document.getElementById('alert').style.display='none'"
                    class="absolute top-1 right-3 text-white font-bold text-lg">
                    &times;
                </button>
            </div>
        @endif

        <div class="flex justify-between mb-4">
            <div class="space-x-2">
                <a href="{{ route('tim.matakuliah.create') }}"
                    class="bg-green-600 inline-flex text-white font-bold px-4 py-2 rounded-md hover:bg-green-800">
                    Tambah
                </a>
            </div>
            <!-- Filter Tahun -->
            <select id="tahun" name="id_tahun"
                class="border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                onchange="updateFilter()">
                <option value="" {{ empty($id_tahun) ? 'selected' : '' }}>Semua Tahun</option>
                @if (isset($tahun_tersedia))
                    @foreach ($tahun_tersedia as $thn)
                        <option value="{{ $thn->id_tahun }}" {{ $id_tahun == $thn->id_tahun ? 'selected' : '' }}>
                            {{ $thn->nama_kurikulum }} - {{ $thn->tahun }}
                        </option>
                    @endforeach
                @endif
            </select>
            <div class="ml-auto justify-between">
                <input type="text" id="search" placeholder="Search..."
                    class="border border-black px-3 py-2 rounded-md">
            </div>
        </div>

        <!-- Filter Info -->
        @if ($id_tahun)
            <div class="mb-4 p-3 bg-blue-50 border border-blue-200 rounded-md">
                <div class="flex flex-wrap gap-2 items-center">
                    <span class="text-sm text-blue-800 font-medium">Filter aktif:</span>
                    @if ($id_tahun)
                        @php
                            $selected_tahun = $tahun_tersedia->where('id_tahun', $id_tahun)->first();
                        @endphp
                        <span
                            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            Tahun:
                            {{ $selected_tahun ? $selected_tahun->nama_kurikulum . ' - ' . $selected_tahun->tahun : $id_tahun }}
                        </span>
                    @endif
                    <a href="{{ route('tim.matakuliah.index') }}"
                        class="text-xs text-blue-600 hover:text-blue-800 underline">
                        Reset filter
                    </a>
                </div>
            </div>
        @endif

        <table class="w-full border border-gray-300 shadow-md rounded-lg overflow-hidden">
            <thead class="bg-green-800 text-white border-b">
                <tr>
                    <th class="py-2 px-3 text-center w-3 font-bold uppercase truncate">No</th>
                    <th class="py-2 px-3 text-center w-8 font-bold uppercase">Prodi</th>
                    <th class="py-2 px-3 text-center font-bold uppercase">Kode MK</th>
                    <th class="py-2 px-3 text-center font-bold uppercase">Nama MK</th>
                    <th class="py-2 px-3 text-center font-bold uppercase">Jenis MK</th>
                    <th class="py-2 px-3text-center font-bold uppercase">Sks MK</th>
                    @for ($i = 1; $i <= 8; $i++)
                        <th class="py-2 px-3">Smstr {{ $i }}</th>
                    @endfor
                    <th class="py-2 px-3 text-center font-bold uppercase">kompetensi MK</th>
                    <th class="py-2 px-3 text-center font-bold uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mata_kuliahs as $index => $mata_kuliah)
                    <tr class="{{ $index % 2 == 0 ? 'bg-gray-100' : 'bg-white' }} hover:bg-gray-200 border-b">
                        <td class="py-2 px-3 text-center">{{ $index + 1 }}</td>
                        <td class="py-3 px-6 text-center">{{ $mata_kuliah->nama_prodi }}</td>
                        <td class="py-2 px-3 text-center">{{ $mata_kuliah->kode_mk }}</td>
                        <td class="py-2 px-3 text-center">{{ $mata_kuliah->nama_mk }}</td>
                        <td class="py-2 px-3 text-center">{{ $mata_kuliah->jenis_mk }}</td>
                        <td class="py-2 px-3 text-center">{{ $mata_kuliah->sks_mk }}</td>
                        @for ($i = 1; $i <= 8; $i++)
                            <td class="py-2 px-4 items-center text-center">
                                @if ($mata_kuliah->semester_mk == $i)
                                    ✔️
                                @endif
                            </td>
                        @endfor
                        <td class="py-2 px-3 text-center">{{ $mata_kuliah->kompetensi_mk }}</td>
                        <td class="py-2 px-3 flex justify-center items-center space-x-2">
                            <a href="{{ route('tim.matakuliah.detail', $mata_kuliah->kode_mk) }}"
                                class="bg-gray-600 font-bold text-white px-5 py-2 rounded-md hover:bg-gray-700">🛈</a>
                            <a href="{{ route('tim.matakuliah.edit', $mata_kuliah->kode_mk) }}"
                                class="bg-blue-600 text-white font-bold px-5 py-2 rounded-md hover:bg-blue-800">✏️</a>
                            <form action="{{ route('tim.matakuliah.destroy', $mata_kuliah->kode_mk) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-5 py-2 rounded-md hover:bg-red-600"
                                    onclick="return confirm('Hapus MK ini?')">
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

            let url = "{{ route('tim.matakuliah.index') }}";

            if (idTahun) {
                url += '?id_tahun=' + encodeURIComponent(idTahun);
            }

            window.location.href = url;
        }
    </script>
@endsection
