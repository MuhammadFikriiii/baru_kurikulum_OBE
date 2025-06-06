@extends('layouts.app')

@section('content')
<div class="mx-5 md:mx-20 my-10">
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Pemetaan BK - MK</h2>
        <hr class="border-t-4 border-black my-4 mx-auto mb-4">

        @if(session('success'))
            <div id="alert" class="bg-green-500 text-white px-4 py-3 rounded-md mb-6 text-center relative">
                <span class="font-semibold">{{ session('success') }}</span>
                <button onclick="document.getElementById('alert').style.display='none'"
                    class="absolute top-2 right-3 text-white font-bold hover:text-gray-200">
                    &times;
                </button>
            </div>
        @endif

        <div class="mb-6 flex justify-between items-center">
            <form method="GET" action="{{ route('admin.pemetaanbkmk.index') }}" class="w-full">
                <div class="flex items-center">
                    <select name="kode_prodi" id="kode_prodi" 
                    onchange="this.form.submit()" 
                    class="border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="" selected disabled>Pilih Prodi</option>
                        @foreach($prodis as $prodi)
                            <option value="{{ $prodi->kode_prodi }}" {{ request('kode_prodi') == $prodi->kode_prodi ? 'selected' : '' }}>
                                {{ $prodi->nama_prodi }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>

        @if(!request()->has('kode_prodi') || empty($kode_prodi))
            <div class="p-8 text-center text-gray-600">
                Silakan pilih prodi terlebih dahulu untuk melihat data pemetaan.
            </div>
        @elseif($mks->isEmpty())
            <div class="p-8 text-center text-gray-600">
                <strong>Data belum tersedia untuk prodi ini.</strong>
            </div>
        @else
            <style>
            input[type="checkbox"]:checked {
                background-color: #2563eb;
                border-color: #2563eb;   
            }
            input[type="checkbox"]:checked::before {
                content: "✓";
                color: white;            
                font-size: 1rem;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -55%);
            }
            </style>

            <div class="">
                <table class="w-full border border-gray-200 shadow-sm rounded-lg overflow-visible">
                    <thead class="bg-green-800 text-white">
                        <tr>
                            <th class="px-6 py-3 text-left font-semibold">BK</th> 
                            @foreach ($mks as $mk)
                            <th class="px-4 py-3 relative group text-center">
                                <span class="cursor-help">{{ $mk->kode_mk }}</span>
                                <div
                                    class="absolute left-1/2 -translate-x-1/2 top-full mb-4 hidden group-hover:block w-64 bg-black text-white text-sm rounded p-2 z-50 text-center shadow-lg">
                                    <div class="bg-gray-600 rounded-t px-2 py-1 font-bold">
                                        {{ $mk->nama_prodi }}
                                    </div>
                                    <div class="mt-3 px-2 text-center">
                                        {{ $mk->nama_mk }}
                                    </div>
                                </div>
                            </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($bks as $bk)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap relative group">
                                    <span class="cursor-help font-medium">{{ $bk->kode_bk }}</span>
                                    <div
                                    class="absolute left-1/2 -translate-x-1/2 top-full mb-4 hidden group-hover:block w-64 bg-black text-white text-sm rounded p-2 z-50 text-center shadow-lg">

                                    <div class="bg-gray-600 rounded-t px-2 py-1 font-bold">
                                        {{ $bk->nama_prodi }}
                                    </div>
                                    <div class="mt-3 px-2 text-center">
                                        {{ $bk->nama_bk }}
                                    </div>
                                </div>
                                </td> 
                                @foreach ($mks as $mk)
                                    <td class="px-4 py-4 text-center">
                                        <input type="checkbox" disabled 
                                            {{ isset($relasi[$mk->kode_mk]) && in_array($bk->id_bk, $relasi[$mk->kode_mk]->pluck('id_bk')->toArray()) ? 'checked' : '' }} 
                                            class="h-5 w-5 mx-auto appearance-none rounded border-2 border-blue-600 bg-white checked:bg-blue-600 checked:border-blue-600 disabled:opacity-100 disabled:cursor-default relative">
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection