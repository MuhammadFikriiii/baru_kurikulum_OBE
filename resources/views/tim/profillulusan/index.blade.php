@extends('layouts.tim.app')

@section('content')
    <div class="bg-white p-4 md:p-6 lg:p-8 rounded-lg shadow-md mx-2 md:mx-0">
        <h2 class="text-3xl font-bold text-gray-700 mb-4 text-center">Daftar Profil Lulusan</h2>
        <hr class="border-t-2 md:border-t-4 border-black my-3 md:my-4 mx-auto">

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

        <div class="flex flex-col md:flex-row items-start md:items-center mb-6 gap-4">
                <div class="space-x-2">
                    <a href="{{ route('tim.profillulusan.create') }}"
                        class="bg-green-600 h-10 font-bold text-white px-5 inline-flex items-center py-2 rounded-md hover:bg-green-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Tambah
                    </a>
                </div>

            <div class="flex items-center space-x-4">
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

                <!-- Search -->
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
                    <a href="{{ route('tim.profillulusan.index') }}"
                        class="text-xs text-blue-600 hover:text-blue-800 underline">
                        Reset filter
                    </a>
                </div>
            </div>
        @endif

        <div class="bg-white">
            <table class="w-full table-fixed shadow-lg rounded-lg overflow-hidden">
                <thead class="bg-green-800 text-white">
                    <tr class="text-center">
                        <th class="py-3 px-4 w-10 text-center">No.</th>
                        <th class="px-4 py-2 text-center w-16">Kode PL</th>
                        <th class="px-4 py-2 text-center w-64">Deskripsi</th>
                        <th class="px-4 py-2 text-center max-w-96">Profesi</th>
                        <th class="px-4 py-2 text-center w-32">Unsur</th>
                        <th class="px-4 py-2 text-center w-28">Keterangan</th>
                        <th class="px-4 py-2 text-center w-40">Sumber</th>
                        <th class="px-4 py-2 text-center w-32">Tahun/Kurikulum</th>
                        <th class="px-4 py-2 text-center w-64">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($profillulusans as $index => $profillulusan)
                        <tr
                            class="align-top {{ $index % 2 == 0 ? 'bg-gray-200' : 'bg-white' }} hover:bg-gray-200 border-b">
                            <td class="px-4 py-2 w-28 text-center">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 w-28 text-center">{{ $profillulusan->kode_pl }}</td>
                            <td class="px-4 py-2 w-70 whitespace-pre-line text-justify">{{ $profillulusan->deskripsi_pl }}
                            </td>
                            <td class="px-4 py-2 max-w-96 whitespace-pre-line">{{ $profillulusan->profesi_pl }}</td>
                            <td class="px-4 py-2 w-36 text-justify">{{ $profillulusan->unsur_pl }}</td>
                            <td class="px-4 py-2 w-28 text-center">{{ $profillulusan->keterangan_pl }}</td>
                            <td class="px-4 py-2 w-40 text-justify">{{ $profillulusan->sumber_pl }}</td>
                            <td class="px-4 py-2 w-32 text-center">
                                {{ $profillulusan->tahun ? $profillulusan->tahun->nama_kurikulum . ' - ' . $profillulusan->tahun->tahun : '-' }}
                            </td>
                            <td class="py-2 px-4 flex justify-center items-center">
                                <a href="{{ route('tim.profillulusan.detail', $profillulusan->id_pl) }}"
                                    class="bg-gray-600 font-bold text-white px-5 py-2 rounded-md hover:bg-gray-800 mr-2">🛈</a>
                                <a href="{{ route('tim.profillulusan.edit', $profillulusan->id_pl) }}"
                                    class="bg-blue-600 text-white px-5 py-2 rounded-md  hover:bg-blue-800 text-center mr-2">✏️</a>
                                <form action="{{ route('tim.profillulusan.destroy', $profillulusan->id_pl) }}"
                                    method="POST">
                                    @csrf @method('DELETE')
                                    <button class="bg-red-600 text-white px-5 py-2 rounded-md hover:bg-red-800"
                                        onclick="return confirm('Hapus PL ini?')">
                                        🗑️
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function updateFilter() {
            const tahunSelect = document.getElementById('tahun');
            const idTahun = tahunSelect.value;

            let url = "{{ route('tim.profillulusan.index') }}";

            if (idTahun) {
                url += '?id_tahun=' + encodeURIComponent(idTahun);
            }

            window.location.href = url;
        }
    </script>
@endsection