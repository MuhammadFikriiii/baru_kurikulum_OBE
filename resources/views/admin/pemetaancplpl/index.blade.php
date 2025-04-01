@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold mb-4">Pemetaan CPL - PL</h2>

<form action="{{ route('admin.pemetaancplpl.store') }}" method="POST">
    @csrf
    <table class="w-full border border-gray-300 shadow-md rounded-lg overflow-hidden">
        <thead class="bg-green-500">
            <tr>
                <th class="px-4 py-2 text-left"></th> 
                @foreach ($cpls as $cpl)
                    <th class="px-4 py-2 text-center">{{ $cpl->kode_cpl }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($pls as $pl)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $pl->kode_pl }}</td>
                    @foreach ($cpls as $cpl)
                        <td class="px-4 py-2 text-center">
                            <input type="checkbox" name="relasi[{{ $pl->kode_pl }}][]" value="{{ $cpl->kode_cpl }}" 
                                {{ isset($relasi[$pl->kode_pl]) && in_array($cpl->kode_cpl, $relasi[$pl->kode_pl]->pluck('kode_cpl')->toArray()) ? 'checked' : '' }} 
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