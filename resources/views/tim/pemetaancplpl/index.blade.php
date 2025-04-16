@extends('layouts.tim.app')

@section('content')
<div class="mr-20 ml-20">
<h2 class="text-4xl font-extrabold text-center mb-4">Pemetaan CPL - PL</h2>
<hr class="w-full border border-black mb-4">

@if(session('success'))
    <div id="alert" class="bg-green-500 text-white px-4 py-2 rounded-md mb-4 text-center relative">
        <span class="font-bold">{{ session('success') }}</span>
        <button onclick="document.getElementById('alert').style.display='none'"
            class="absolute top-1 right-3 text-white font-bold text-lg">
            &times;
         </button>
    </div>
@endif

<form action="{{ route('tim.pemetaancplpl.store') }}" method="POST">
    @csrf
    <table class="w-full border border-gray-300 shadow-md rounded-lg overflow-visible">
        <thead class="bg-green-500">
            <tr>
                <th class="px-4 py-2 text-left"></th> 
                @foreach ($pls as $pl)
                <th class="px-2 py-2 relative group">
                    <span class="cursor-help">{{ $pl->kode_pl }}</span>
                    <div class="mt-9 absolute left-1/2 -translate-x-[60%] top-full hidden group-hover:block w-64 bg-gray-700 text-white text-sm rounded p-2 z-50 text-center">
                        {{ $pl->deskripsi_pl }}
                    </div>
                    <div class="absolute left-1/2 -translate-x-[60%] top-full hidden group-hover:block w-64 bg-gray-700 text-white text-sm rounded p-2 z-50 text-center">
                        {{ $pl->prodi->nama_prodi }}
                    </div>
                </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($cpls as $cpl)
                <tr class="border-b">
                    <td class="px-4 py-2 relative group">
                        <span class="cursor-help">{{ $cpl->kode_cpl }}</span>
                        <div class="absolute -mt-10 left-1/2 -translate-x-2 top-full hidden group-hover:block w-64 bg-gray-700 text-white text-sm rounded p-2 z-50 text-center">
                            {{ $cpl->deskripsi_cpl }}
                        </div>
                    </td>                    
                    @foreach ($pls as $pl)
                        <td class="px-4 py-2 text-center">
                            <input type="checkbox" name="relasi[{{ $pl->id_pl }}][]" value="{{ $cpl->id_cpl }}" 
                                {{ isset($relasi[$pl->id_pl]) && in_array($cpl->id_cpl, $relasi[$pl->id_pl]->pluck('id_cpl')->toArray()) ? 'checked' : '' }} 
                                class="form-checkbox h-5 w-5 text-blue-600 mx-auto">
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
    <button type="submit" class="mt-4 px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Simpan</button>
</form>

</div>
@endsection