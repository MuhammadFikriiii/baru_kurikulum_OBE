@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">

    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Pemetaan CPL - BK</h1>
        <hr class="border-t-4 border-black my-4 mx-auto mb-4">
    </div>


    @if(session('success'))
    <div id="alert" class="bg-green-500 text-white px-4 py-2 rounded-md mb-6 text-center relative max-w-4xl mx-auto">
        <span class="font-bold">{{ session('success') }}</span>
        <button onclick="document.getElementById('alert').style.display='none'"
            class="absolute top-1 right-3 text-white font-bold text-lg">
            &times;
        </button>
    </div>
    @endif

    <!-- Prodi -->
    <div class="mb-6">
        <form method="GET" action="{{ route('admin.pemenuhancpl.index') }}" class="w-full md:w-64">
            <select name="kode_prodi" onchange="this.form.submit()"
                class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                <option value="all" disabled selected>Pilih Prodi</option>
                @foreach($prodis as $prodi)
                    <option value="{{ $prodi->kode_prodi }}" {{ $kode_prodi == $prodi->kode_prodi ? 'selected' : '' }}>
                        {{ $prodi->nama_prodi }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        @if(empty($kode_prodi))
        <div class="p-8 text-center text-gray-600">
            Silakan pilih prodi terlebih dahulu.
        </div>
        @elseif($cpls->isEmpty())
        <div class="p-8 text-center text-gray-600">
            <strong>Data belum dibuat untuk prodi ini.</strong>
        </div>
        @else
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
        
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300">
                <thead class="bg-green-800 text-white">
                    <tr>
                        <th class="px-4 py-3 text-left"></th>
                        @foreach ($bks as $bk)
                        <th class="px-2 py-3 relative group">
                            <span class="cursor-help">{{ $bk->kode_bk }}</span>
                            <div class="mt-9 absolute left-1/2 -translate-x-[60%] top-full hidden group-hover:block w-64 bg-gray-700 text-white text-sm rounded p-2 z-50 text-center">
                                {{ $bk->nama_bk }}
                            </div>
                        </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cpls as $cpl)
                    <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }} hover:bg-gray-100 border-b">
                        <td class="px-4 py-4 relative group">
                            <span class="cursor-help">{{ $cpl->kode_cpl }}</span>
                            <div class="absolute -mt-10 left-1/2 -translate-x-2 top-full hidden group-hover:block w-64 bg-gray-700 text-white text-sm rounded p-2 z-50 text-center">
                                {{ $cpl->deskripsi_cpl }}
                            </div>
                        </td>
                        @foreach ($bks as $bk)
                        <td class="px-4 py-4 text-center">
                            <input type="checkbox" disabled 
                                {{ isset($relasi[$bk->id_bk]) && in_array($cpl->id_cpl, $relasi[$bk->id_bk]->pluck('id_cpl')->toArray()) ? 'checked' : '' }} 
                                class="h-5 w-5 mx-auto appearance-none rounded border-2 border-blue-600 bg-white checked:bg-white-600 checked:border-blue-600 disabled:opacity-100 disabled:cursor-default relative">
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