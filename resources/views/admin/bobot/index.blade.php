@extends('layouts.app')

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

        <a href="{{ route('admin.bobot.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg mb-4 inline-block">
            Tambah Bobot CPL-MK
        </a>

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
                        $cpl = $items->first()->capaianProfilLulusan;
                        $totalBobot = $items->sum('bobot');
                    @endphp
                    <tr class="{{ $loop->even ? 'bg-gray-100' : 'bg-white' }} hover:bg-gray-200 border-b align-top">
                        <td class="py-3 px-6 text-center">{{ $loop->iteration }}</td>

                        {{-- Kolom kode CPL --}}
                        <td class="py-3 px-6 text-left">
                            <strong>{{ $cpl->kode_cpl }}</strong>
                        </td>

                        {{-- Kolom deskripsi CPL --}}
                        <td class="py-3 px-6 text-left">
                            <div>{{ $cpl->deskripsi_cpl }}</div>
                        </td>

                        {{-- Kolom daftar MK --}}
                        <td class="py-3 px-6 text-left text-sm text-gray-800">
                            @foreach ($items as $item)
                                <div>{{ $item->kode_mk }}</div>
                            @endforeach
                        </td>

                        {{-- Kolom bobot per MK --}}
                        <td class="py-3 px-6 text-left text-sm text-gray-800">
                            @foreach ($items as $item)
                                <div>{{ $item->bobot }}%</div>
                            @endforeach
                        </td>

                        {{-- Total bobot --}}
                        <td class="py-3 px-6 text-center font-bold align-top">{{ $totalBobot }}%</td>

                        {{-- Aksi --}}
                        <td class="py-3 px-6 flex flex-col items-center space-y-1">
                            <a href="{{ route('admin.bobot.detail', $id_cpl) }}"
                                class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 font-bold text-center">🛈</a>
                            <a href="{{ route('admin.bobot.edit', $id_cpl) }}"
                                class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 font-bold text-center">✏️</a>
                            <form action="{{ route('admin.bobot.destroy', $id_cpl) }}" method="POST"
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
@endsection
