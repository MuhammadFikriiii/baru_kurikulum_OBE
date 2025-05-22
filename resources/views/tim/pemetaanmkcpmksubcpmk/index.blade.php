@extends('layouts.tim.app')
@section('content')
    <div class="mr-20 ml-20">
        <h2 class="text-4xl font-extrabold text-center mb-4">Pemetaan MK - CPMK - SUBCPMK</h2>
        <hr class="w-full border border-black mb-4">

        <table class="w-full border border-gray-300 rounded-lg overflow-hidden shadow-md">
            <thead class="bg-green-800">
                <tr class="text-white uppercase text-center">
                    <th class="p-2 py-3 px-4 min-w-[10px] text-center font-bold uppercase">No</th>
                    <th class="p-2 py-3 px-4 min-w-[10px] text-center font-bold uppercase">kode MK</th>
                    <th class="p-2 py-3 px-4 min-w-[10px] text-center font-bold uppercase">nama MK</th>
                    <th class="p-2 py-3 px-4 min-w-[10px] text-center font-bold uppercase">kode CPMK</th>
                    <th class="p-2 py-3 px-4 min-w-[10px] text-center font-bold uppercase">nama CPMK</th>
                    <th class="p-2 py-3 px-4 min-w-[10px] text-center font-bold uppercase">kode Sub CPMK</th>
                    <th class="p-2 py-3 px-4 min-w-[10px] text-center font-bold uppercase">nama Sub CPMK</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $index => $row)
                    <tr class="{{ $index % 2 == 0 ? 'bg-gray-100' : 'bg-white' }} hover:bg-gray-200 border-b">
                        <td class="p-2 py-3 px-4 min-w-[10px] text-justify uppercase">{{ $index + 1 }}</td>
                        <td class="p-2 py-3 px-4 min-w-[10px] text-justify uppercase">{{ $row->kode_mk }}</td>
                        <td class="p-2 py-3 px-4 min-w-[10px] text-justify uppercase">{{ $row->nama_mk }}</td>
                        <td class="p-2 py-3 px-4 min-w-[10px] text-justify uppercase">{{ $row->kode_cpmk }}</td>
                        <td class="p-2 py-3 px-4 min-w-[10px] text-justify uppercase">{{ $row->deskripsi_cpmk }}</td>
                        <td class="p-2 py-3 px-4 min-w-[10px] text-justify uppercase">{{ $row->sub_cpmk }}</td>
                        <td class="p-2 py-3 px-4 min-w-[10px] text-justify uppercase">{{ $row->uraian_cpmk }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection