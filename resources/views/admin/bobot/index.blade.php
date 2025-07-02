@extends('layouts.app')

@section('content')
    <div class="bg-white p-4 md:p-6 lg:p-8 rounded-lg shadow-md mx-2 md:mx-0">
        <h2 class="text-3xl font-extrabold text-center mb-4">Daftar Bobot CPL - MK</h2>
        <hr class="border-t-2 md:border-t-4 border-black my-3 md:my-4 mx-auto">

        @if (session('success'))
            <div class="bg-green-500 text-white px-4 py-2 rounded-md mb-4 text-center relative">
                <span class="font-bold">{{ session('success') }}</span>
                <button onclick="this.parentElement.style.display='none'"
                    class="absolute top-1 right-3 text-white font-bold text-lg">×</button>
            </div>
        @endif

        {{-- <a href="{{ route('admin.bobot.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg mb-4 inline-block">
            Tambah Bobot CPL-MK
        </a> --}}

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
                        <td class="px-3 py-2 md:px-6 md:py-4 border border-gray-200">
                            <div class="flex justify-center space-x-1 md:space-x-2">
                                <a href="{{ route('admin.bobot.detail', $id_cpl) }}"
                                    class="bg-gray-600 hover:bg-gray-700 text-white p-1 md:p-2 rounded-md inline-flex items-center justify-center"
                                    title="Detail">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 md:h-4 md:w-4"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M18 10A8 8 0 11 2 10a8 8 0 0116 0zm-9-3a1 1 0 112 0 1 1 0 01-2 0zm2 5a1 1 0 10-2 0v2a1 1 0 102 0v-2z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                                {{-- <a href="{{ route('admin.bobot.edit', $id_cpl) }}"
                                    class="bg-blue-600 hover:bg-blue-800 text-white p-1 md:p-2 rounded-md inline-flex items-center justify-center"
                                    title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 md:h-4 md:w-4"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                    </svg>
                                </a>
                                <form action="{{ route('admin.bobot.destroy', $id_cpl) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-600 hover:bg-red-800 text-white p-1 md:p-2 rounded-md inline-flex items-center justify-center"
                                        title="Hapus" onclick="return confirm('Hapus user ini?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 md:h-4 md:w-4"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </form> --}}
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
