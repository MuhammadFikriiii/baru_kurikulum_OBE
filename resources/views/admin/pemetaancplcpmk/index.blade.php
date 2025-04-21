@extends('layouts.app')

@section('content')
<div class="mr-20 ml-20">
<h2 class="text-4xl font-extrabold text-center mb-4">Pemetaan CPL - MK</h2>
<hr class="border border-black mb-4">

@if(session('success'))
    <div id="alert" class="bg-green-500 text-white px-4 py-2 rounded-md mb-4 text-center relative">
        <span class="font-bold">{{ session('success') }}</span>
        <button onclick="document.getElementById('alert').style.display='none'"
            class="absolute top-1 right-3 text-white font-bold text-lg">
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

<form>
    @csrf
    <table class="w-full border border-gray-300 shadow-md rounded-lg">
        <thead class="bg-green-500">
            <tr>
                <th class="px-4 py-2 text-left"></th> 
                @foreach ($cpmks as $cpmk)
                <th class="px-2 py-2 relative group">
                    <span class="cursor-help">{{ $cpmk->id_cpmk }}</span>
                    <div class="mt-9 absolute left-1/2 -translate-x-[60%] top-full hidden group-hover:block w-64 bg-gray-700 text-white text-sm rounded p-2 z-50 text-center">
                        {{ $cpmk->deskripsi_cpmk }}
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
                    @foreach ($cpmks as $cpmk)
                        <td class="px-4 py-2 text-center">
                            <input type="checkbox" disabled 
                                {{ isset($relasi[$cpmk->id_cpmk]) && in_array($cpl->id_cpl, $relasi[$cpmk->id_cpmk]->pluck('id_cpl')->toArray()) ? 'checked' : '' }} 
                                class="h-5 w-5 mx-auto appearance-none rounded border-2 border-blue-600 bg-white checked:bg-white-600 checked:border-blue-600 disabled:opacity-100 disabled:cursor-default relative">
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</form>
</div>
@endsection