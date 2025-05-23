@extends('layouts.kaprodi.app')

@section('content')
    <div class="mr-20 ml-20">
        <h2 class="text-2xl font-bold text-gray-700 mb-4 text-center">Daftar Penilaian</h2>
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

        <div class="flex justify-between mb-4">
            <div class="ml-auto">
                <input type="text" id="search" placeholder="Search..."
                    class="border border-black px-3 py-2 rounded-md">
            </div>
        </div>

        <div class="bg-white shadow-lg overflow-hidden">
            <table class="w-full border border-gray-300 shadow-md rounded-lg overflow-hidden">
                <thead class="bg-green-800 text-white border-b">
                    <tr>
                        <th class="py-3 px-4 text-center font-bold uppercase">No</th>
                        <th class="py-3 px-4 text-center font-bold uppercase">Kode MK</th>
                        <th class="py-3 px-4 text-center font-bold uppercase">CPL</th>
                        <th class="py-3 px-4 text-center font-bold uppercase">CPMK</th>
                        <th class="py-3 px-4 text-center font-bold uppercase">Kuis</th>
                        <th class="py-3 px-4 text-center font-bold uppercase">Observasi</th>
                        <th class="py-3 px-4 text-center font-bold uppercase">Presentasi</th>
                        <th class="py-3 px-4 text-center font-bold uppercase">UTS</th>
                        <th class="py-3 px-4 text-center font-bold uppercase">UAS</th>
                        <th class="py-3 px-4 text-center font-bold uppercase">Project</th>
                        <th class="py-3 px-4 text-center font-bold uppercase">Total</th>
                        <th class="py-3 px-4 text-center font-bold uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penilaians as $index => $penilaian)
                        <tr class="{{ $index % 2 == 0 ? 'bg-gray-100' : 'bg-white' }} hover:bg-gray-200 border-b">
                            <td class="py-3 px-4 text-center">{{ $index + 1 }}</td>
                            <td class="py-3 px-4 text-center">{{ $penilaian->nama_mk }}</td>
                            <td class="py-3 px-4 text-center">{{ $penilaian->kode_cpl ?? '-' }}</td>
                            <td class="py-3 px-4 text-center">{{ $penilaian->kode_cpmk ?? '-' }}</td>
                            <td class="py-3 px-4 text-center">{{ $penilaian->kuis }}</td>
                            <td class="py-3 px-4 text-center">{{ $penilaian->observasi }}</td>
                            <td class="py-3 px-4 text-center">{{ $penilaian->presentasi }}</td>
                            <td class="py-3 px-4 text-center">{{ $penilaian->uts }}</td>
                            <td class="py-3 px-4 text-center">{{ $penilaian->uas }}</td>
                            <td class="py-3 px-4 text-center">{{ $penilaian->project }}</td>
                            <td class="py-3 px-4 text-center">{{ $penilaian->count }}</td>
                            <td class="py-3 px-4 flex justify-center items-center space-x-2">
                                <a href="{{ route('kaprodi.penilaian.detail', $penilaian->id_penilaian) }}"
                                    class="bg-gray-600 font-bold text-white px-5 py-2 rounded-md hover:bg-gray-700">🛈</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection