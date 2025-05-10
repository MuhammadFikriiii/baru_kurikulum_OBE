@extends('layouts.app')

@section('content')
<div class="mx-5 md:mx-10 my-10">
    <h2 class="text-4xl font-extrabold text-center mb-4">Pemetaan CPL - BK - MK</h2>

    <hr class="border border-black mb-4">

    <div class="w-full max-w-[1650px] h-[80vh] overflow-auto border">

        <table class="min-w-max table-auto divide-y divide-gray-200">
            <thead class="bg-green-500 text-white text-sm text-center">
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
    

</div>
@endsection
