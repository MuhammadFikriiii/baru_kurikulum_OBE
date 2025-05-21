@extends('layouts.app')

@section('content')
<div class="container mx-auto px-10">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">Pemetaan CPL - MK</h2>
        <hr class="border-t-2 border-gray-300 mb-6">

    @if(session('success'))
            <div id="alert" class="bg-green-500 text-white px-4 py-3 rounded-md mb-6 text-center relative">
                <span class="font-semibold">{{ session('success') }}</span>
                <button onclick="document.getElementById('alert').style.display='none'"
                    class="absolute top-2 right-3 text-white font-bold hover:text-gray-200">
                    &times;
                </button>
            </div>
    @endif

        <style>
            input[type="checkbox"]:checked::before {
                content: "✔";
                color: white;
                font-size: 1rem;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -55%);
            }
        </style>

        <div class="mb-4 flex justify-between items-center">
            <form method="GET" action="{{ route('admin.pemetaancplmk.index') }}" class="w-full">
                <div class="flex items-center">
                    <label for="kode_prodi" class="mr-2 font-medium text-gray-700">Program Studi:</label>
                    <select name="kode_prodi" id="kode_prodi" onchange="this.form.submit()" 
                            class="border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="all" {{ $kode_prodi == 'all' ? 'selected' : '' }}>Semua Prodi</option>
                        @foreach($prodis as $prodi)
                            <option value="{{ $prodi->kode_prodi }}" {{ $kode_prodi == $prodi->kode_prodi ? 'selected' : '' }}>
                                {{ $prodi->nama_prodi }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border border-gray-200 shadow-sm rounded-lg overflow-hidden">
                <thead class="bg-green-600 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left font-semibold">CPL</th> 
                        @foreach ($mks as $mk)
                        <th class="px-4 py-3 relative group text-center">
                            <span class="cursor-help">{{ $mk->kode_mk }}</span>
                            <div class="absolute z-50 hidden group-hover:block w-64 bg-gray-800 text-white text-sm rounded p-2 -ml-32 mt-2">
                                <p class="font-semibold">{{ $mk->kode_mk }}</p>
                                <p class="text-gray-300">{{ $mk->nama_mk }}</p>
                            </div>
                        </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($cpls as $cpl)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap relative group">
                                <span class="cursor-help font-medium">{{ $cpl->kode_cpl }}</span>
                                <div class="absolute z-50 hidden group-hover:block w-96 bg-gray-800 text-white text-sm rounded p-3 -ml-48 mt-2">
                                    <p class="font-semibold">{{ $cpl->kode_cpl }}</p>
                                    <p class="text-gray-300">{{ $cpl->deskripsi_cpl }}</p>
                                </div>
                            </td> 
                            @foreach ($mks as $mk)
                                <td class="px-4 py-4 text-center">
                                    <input type="checkbox" disabled 
                                        {{ isset($relasi[$mk->kode_mk]) && in_array($cpl->id_cpl, $relasi[$mk->kode_mk]->pluck('id_cpl')->toArray()) ? 'checked' : '' }} 
                                        class="h-5 w-5 mx-auto appearance-none rounded border-2 border-blue-600 bg-white checked:bg-blue-600 checked:border-blue-600 disabled:opacity-100 disabled:cursor-default relative">
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection