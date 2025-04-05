@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold mb-4">Pemetaan CPL - MK</h2>

<form action="{{ route('admin.pemetaancplmk.store') }}" method="POST">
    @csrf
    <table class="w-full border border-gray-300 shadow-md rounded-lg overflow-hidden">
        <thead class="bg-green-500">
            <tr>
                <th class="px-4 py-2 text-left"></th> 
                @foreach ($mks as $mk)
                    <th class="px-4 py-2 text-center">{{ $mk->kode_mk }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($cpls as $cpl)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $cpl->kode_cpl }}</td>
                    @foreach ($mks as $mk)
                        <td class="px-4 py-2 text-center">
                            <input type="checkbox" name="relasi[{{ $mk->kode_mk }}][]" value="{{ $cpl->kode_cpl }}" 
                                {{ isset($relasi[$mk->kode_mk]) && in_array($cpl->kode_cpl, $relasi[$mk->kode_mk]->pluck('kode_cpl')->toArray()) ? 'checked' : '' }} 
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