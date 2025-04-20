@extends('layouts.app')

@section('content')
<div class=" mr-20 ml-20">
    <h2 class="text-4xl font-extrabold text-center mb-4">Pemetaan CPL - BK - MK</h2>
    <hr class="border border-black mb-4">
    <div class="w-full border border-gray-300 shadow-md rounded-lg">
        <table class="table table-bordered">
            <thead class="text-center bg-green-500">
                <tr>
                    <th>CPL / BK</th>
                    @foreach($bks as $bk)
                        <th>{{ $bk->kode_bk ?? $bk->id_bk }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($cpls as $cpl)
                    <tr>
                        <td><strong>{{ $cpl->kode_cpl ?? $cpl->id_cpl }}</strong></td>
                        @foreach($bks as $bk)
                            <td>
                                @if(isset($matrix[$cpl->id_cpl][$bk->id_bk]))
                                    <ul class="mb-0 ps-3">
                                        @foreach(array_unique($matrix[$cpl->id_cpl][$bk->id_bk]) as $mk)
                                            <li>{{ $mk }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    -
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
