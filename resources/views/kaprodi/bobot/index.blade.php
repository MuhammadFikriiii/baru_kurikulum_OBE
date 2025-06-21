@extends('layouts.kaprodi.app')

@section('content')
    <div class="mx-5 md:mx-20 my-10">
        <h2 class="text-4xl font-extrabold text-center mb-4">Daftar Bobot CPL - MK</h2>
        <hr class="w-full border border-black mb-6">

        @if (session('success'))
            <div class="bg-green-500 text-white px-4 py-2 rounded-md mb-4 text-center relative">
                <span class="font-bold">{{ session('success') }}</span>
                <button onclick="this.parentElement.style.display='none'"
                    class="absolute top-1 right-3 text-white font-bold text-lg">×</button>
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

                        <td class="py-3 px-6 text-left">
                            <strong>{{ $first->kode_cpl ?? '-' }}</strong>
                        </td>

                        <td class="py-3 px-6 text-left">
                            <div>{{ $first->deskripsi_cpl ?? '-' }}</div>
                        </td>

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
                            <a href="{{ route('kaprodi.bobot.detail', $first->id_cpl) }}"
                                class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 font-bold text-center">🛈</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
