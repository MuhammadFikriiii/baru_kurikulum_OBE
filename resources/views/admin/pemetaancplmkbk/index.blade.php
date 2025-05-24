@extends('layouts.app')

@section('content')
{{-- <div class="mx-5 md:mx-10 my-10">
    <h2 class="text-4xl font-extrabold text-center mb-4">Pemetaan CPL - BK - MK</h2>

    <hr class="border border-black mb-4">

    <div class="w-full max-w-[1650px] h-[80vh] overflow-auto border">

        <table class="min-w-max table-auto divide-y divide-gray-200">
            <thead class="bg-green-500 sticky top-0  text-white text-sm text-center">
            <tr>
                <th class="px-4 py-3 border-r border-white text-left  bg-green-500">CPL / BK</th>
                @foreach($bks as $bk)
                <th class="px-4 py-3 border-r border-white">{{ $bk->kode_bk ?? $bk->id_bk }}</th>
                @endforeach
            </tr>
            </thead>
            <tbody class="bg-white text-sm text-gray-700">
            @foreach($cpls as $cpl)
                <tr class="hover:bg-gray-50">
                <td class="px-4 py-3 font-semibold border border-gray-200">
                    {{ $cpl->kode_cpl ?? $cpl->id_cpl }}
                </td>
                @foreach($bks as $bk)
                    <td class="px-4 py-3 border border-gray-200">
                    @if(isset($matrix[$cpl->id_cpl][$bk->id_bk]))
                        <ul class="list-disc pl-5 space-y-1">
                        @foreach(array_unique($matrix[$cpl->id_cpl][$bk->id_bk]) as $mk)
                            <li>{{ $mk }}</li>
                        @endforeach
                        </ul>
                    @else
                        <span class="text-gray-400">-</span>
                    @endif
                    </td>
                @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    

</div> --}}

<div class="container mx-auto px-4">
    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Pemetaan CPL - BK - MK</h1>
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

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <form method="GET" action="{{ route('admin.pemetaancplbk.index') }}" class="w-full md:w-64">
            <select id="prodi" name="kode_prodi" 
                class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                onchange="this.form.submit()">
                <option value="" {{ empty($kode_prodi) ? 'selected' : '' }} disabled>Pilih Prodi</option>
                @isset($prodis)
                    @foreach($prodis as $prodi)
                        <option value="{{ $prodi->kode_prodi }}" {{ $kode_prodi == $prodi->kode_prodi ? 'selected' : '' }}>
                            {{ $prodi->nama_prodi }}
                        </option>
                    @endforeach
                @endisset
            </select>
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        @if(empty($kode_prodi))
        <div class="p-8 text-center text-gray-600">
            Silakan pilih prodi terlebih dahulu.
        </div>
        @elseif($bks->isEmpty())
        <div class="p-8 text-center text-gray-600">
            <strong>Data belum dibuat untuk prodi ini.</strong>
        </div>
        @else
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300">
                <thead class="bg-green-800 text-white">
                    <tr>
                        <th class="px-4 py-3 text-left border-r border-white">CPL / BK</th>
                        @foreach($bks as $bk)
                        <th class="px-4 py-3 border-r border-white relative group">
                            <span class="cursor-help">{{ $bk->kode_bk ?? $bk->id_bk }}</span>
                            @if(isset($bk->deskripsi_bk))
                            <div class="mt-9 absolute left-1/2 -translate-x-[60%] top-full hidden group-hover:block w-64 bg-gray-700 text-white text-sm rounded p-2 z-50 text-center">
                                {{ $bk->deskripsi_bk }}
                                @if(isset($bk->prodi))
                                <div class="mt-1">{{ $bk->prodi->nama_prodi }}</div>
                                @endif
                            </div>
                            @endif
                        </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($cpls as $cpl)
                    <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }} hover:bg-gray-100">
                        <td class="px-4 py-4 font-semibold border border-gray-200 relative group">
                            <span class="cursor-help">{{ $cpl->kode_cpl ?? $cpl->id_cpl }}</span>
                            @if(isset($cpl->deskripsi_cpl))
                            <div class="mt-9 absolute left-1/2 -translate-x-[60%] top-full hidden group-hover:block w-64 bg-gray-700 text-white text-sm rounded p-2 z-50 text-center">
                                {{ $cpl->deskripsi_cpl }}
                                @if(isset($prodiByCpl[$cpl->id_cpl]))
                                <div class="mt-1">{{ $prodiByCpl[$cpl->id_cpl] }}</div>
                                @endif
                            </div>
                            @endif
                        </td>
                        @foreach($bks as $bk)
                        <td class="px-4 py-4 border border-gray-200">
                            @if(isset($matrix[$cpl->id_cpl][$bk->id_bk]))
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach(array_unique($matrix[$cpl->id_cpl][$bk->id_bk]) as $mk)
                                <li>{{ $mk }}</li>
                                @endforeach
                            </ul>
                            @else
                            <span class="text-gray-400">-</span>
                            @endif
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



