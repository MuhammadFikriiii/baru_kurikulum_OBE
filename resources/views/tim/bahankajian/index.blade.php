@extends('layouts.tim.app')

@section('content')
    <div class="mr-20 ml-20">
        <h2 class="text-2xl font-bold text-gray-700 mb-4 text-center">Daftar Bahan Kajian</h2>
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
                <a href="{{ route('tim.bahankajian.create') }}"
                    class="bg-green-600 h-10 font-bold text-white px-5 inline-flex items-center py-2 rounded-md hover:bg-green-800">
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
                    <a href="{{ route('tim.bahankajian.index') }}"
                        class="text-xs text-blue-600 hover:text-blue-800 underline">
                        Reset filter
                    </a>
                </div>
            </div>
        @endif

        <div class="bg-white shadow-lg overflow-hidden">
            <table class="w-full border border-gray-300 shadow-md rounded-lg overflow-hidden">
                <thead class="bg-green-800 text-white border-b">
                    <tr>
                        <th class="py-3 px-4 text-center min-w-[10px] font-bold uppercase ">No.</th>
                        <th class="py-3 px-6 text-center min-w-[10px] font-bold uppercase">Prodi</th>
                        <th class="py-3 px-6 text-center min-w-[10px] font-bold uppercase">Kode BK</th>
                        <th class="py-3 px-6 text-center min-w-[10px] font-bold uppercase">Nama BK</th>
                        <th class="py-3 px-6 text-center min-w-[10px] font-bold uppercase">Deskripsi BK</th>
                        <th class="py-3 px-6 text-center min-w-[10px] font-bold uppercase">Referensi BK</th>
                        <th class="py-3 px-6 text-center min-w-[10px] font-bold uppercase">Status BK</th>
                        <th class="py-3 px-6 text-center min-w-[10px] font-bold uppercase">Knowledge Area</th>
                        <th class="py-3 px-6 font-bold uppercase text-center min-w-[10px]">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bahankajians as $index => $bahankajian)
                        <tr class="{{ $index % 2 == 0 ? 'bg-gray-100' : 'bg-white' }} hover:bg-gray-200 border-b">
                            <td class="py-3 px-6 text-center min-w-[10px]">{{ $index + 1 }}</td>
                            <td class="py-3 px-6 text-center min-w-[10px]">{{ $bahankajian->nama_prodi }}</td>
                            <td class="py-3 px-6 text-center min-w-[10px]">{{ $bahankajian->kode_bk }}</td>
                            <td class="py-3 px-6 text-center min-w-[10px]">{{ $bahankajian->nama_bk }}</td>
                            <td class="py-3 px-6 text-center min-w-[10px]">{{ $bahankajian->deskripsi_bk }}</td>
                            <td class="py-3 px-6 text-center min-w-[10px]">{{ $bahankajian->referensi_bk }}</td>
                            <td class="py-3 px-6 text-center min-w-[10px]">{{ $bahankajian->status_bk }}</td>
                            <td class="py-3 px-6 text-center min-w-[10px]">{{ $bahankajian->knowledge_area }}</td>
                            <td class="py-3 px-6 flex justify-center min-w-[10px] items-center space-x-2">
                                <a
                                    href="{{ route('tim.bahankajian.detail', $bahankajian->id_bk) }}"class="bg-gray-600 font-bold text-white px-5 py-2 rounded-md hover:bg-gray-700">🛈</a>
                                <a href="{{ route('tim.bahankajian.edit', $bahankajian->id_bk) }}"
                                    class="bg-blue-600 text-white font-bold px-5 py-2 rounded-md hover:bg-blue-800">✏️</a>
                                <form action="{{ route('tim.bahankajian.destroy', $bahankajian->id_bk) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button class="bg-red-500 text-white px-5 py-2 rounded-md hover:bg-red-600"
                                        onclick="return confirm('Hapus BK ini?')">
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

            let url = "{{ route('tim.bahankajian.index') }}";

            if (idTahun) {
                url += '?id_tahun=' + encodeURIComponent(idTahun);
            }

            window.location.href = url;
        }
    </script>
@endsection
