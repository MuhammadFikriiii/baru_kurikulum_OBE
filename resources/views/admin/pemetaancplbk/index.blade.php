@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold mb-4">Pemetaan CPL - BK</h2>

@if(session('success'))
    <div id="alert" class="bg-green-500 text-white px-4 py-2 rounded-md mb-4 text-center relative">
        <span class="font-bold">{{ session('success') }}</span>
        <button onclick="document.getElementById('alert').style.display='none'"
            class="absolute top-1 right-3 text-white font-bold text-lg">
            &times;
         </button>
    </div>
@endif

<form action="{{ route('admin.pemetaancplbk.store') }}" method="POST">
    @csrf
    <table class="w-full border border-gray-300 shadow-md rounded-lg overflow-hidden">
        <thead class="bg-green-500">
            <tr>
                <th class="px-4 py-2 text-left"></th> 
                @foreach ($bks as $bk)
                    <th class="px-4 py-2 text-center">{{ $bk->kode_bk }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($cpls as $cpl)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $cpl->kode_cpl }}</td>
                    @foreach ($bks as $bk)
                        <td class="px-4 py-2 text-center">
                            <input type="checkbox" name="relasi[{{ $bk->kode_bk }}][]" value="{{ $cpl->kode_cpl }}" 
                                {{ isset($relasi[$bk->kode_bk]) && in_array($cpl->kode_cpl, $relasi[$bk->kode_bk]->pluck('kode_cpl')->toArray()) ? 'checked' : '' }} 
                                class="form-checkbox h-5 w-5 text-blue-600 mx-auto">
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
    <button type="submit" class="mt-4 px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Simpan</button>
</form>

<a href="{{ route('admin.dashboard') }}" class="inline-block mt-4 px-6 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Kembali</a>
@endsection