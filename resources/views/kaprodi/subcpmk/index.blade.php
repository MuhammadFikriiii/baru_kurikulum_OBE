@extends('layouts.kaprodi.app')

@section('content')
    <div class="ml-20 mr-20">
        <h1 class="text-2xl font-bold text-gray-700 mb-4 text-center">Daftar Sub Cpmk</h1>
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
            <div class="ml-auto justify-between">
                <input type="text" id="search" placeholder="Search..."
                    class="border border-black px-3 py-2 rounded-md">
            </div>
        </div>

        <table class="w-full border border-gray-300 shadow-md rounded-lg overflow-hidden">
            <thead class="bg-green-800 text-white border-b">
                <tr>
                    <th class="py-3 px-4 text-center w-1/12 font-bold uppercase">No</th>
                    <th class="py-3 px-4 text-center w-1/6 font-bold uppercase">CPMK</th>
                    <th class="py-3 px-4 text-center w-1/6 font-bold uppercase">SUB CPMK</th>
                    <th class="py-3 px-4 text-center w-1/6 font-bold uppercase">Uraian Sub CPMK</th>
                    <th class="py-3 px-4 text-center w-1/6 font-bold uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subcpmks as $index => $subcpmk)
                    <tr class="{{ $index % 2 == 0 ? 'bg-gray-100' : 'bg-white' }} hover:bg-gray-200 border-b">
                        <td class="py-3 px-6 w-16 text-center">{{ $index + 1 }}</td>
                        <td class="bpy-3 px-6 w-16 text-center">{{ $subcpmk->kode_cpmk ?? '-' }}</td>
                        <td class="bpy-3 px-6 w-16 text-center">{{ $subcpmk->sub_cpmk }}</td>
                        <td class="bpy-3 px-6 w-16 text-center">{{ $subcpmk->uraian_cpmk }}</td>
                        <td class="py-3 px-6 flex justify-center items-center space-x-2">
                            <a href="{{ route('kaprodi.subcpmk.detail', $subcpmk->id_sub_cpmk) }}"
                                class="bg-gray-600 font-bold text-white px-5 py-2 rounded-md hover:bg-gray-700">🛈</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
