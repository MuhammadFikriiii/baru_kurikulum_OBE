@extends('layouts.app')

@section('content')
<div class="">
    <h4 class="mb-4">Pemetaan BK - CPL - MK</h4>

@if(session('success'))
    <div id="alert" class="bg-green-500 text-white px-4 py-2 rounded-md mb-4 text-center relative">
        <span class="font-bold">{{ session('success') }}</span>
        <button onclick="document.getElementById('alert').style.display='none'"
            class="absolute top-1 right-3 text-white font-bold text-lg">
            &times;
         </button>
    </div>
@endif

    <form action="{{ route('admin.pemetaancplmkbk.store') }}" method="POST">
        @csrf

        <table class="w-full border border-gray-300 shadow-md rounded-lg overflow-hidden">
            <thead class="bg-green-500 text-white">
                <tr>
                    <th class="px-2 py-2 roubded-lg">CPL</th>
                    @foreach ($bk as $b)
                        <th class="px-2 py-2">{{ $b->kode_bk }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($cpl as $c)
                    <tr class="border-b">
                        <td class="text-center">{{ $c->kode_cpl }}</td>
                        @foreach ($bk as $b)
                            <td class="px-2 py-2">
                                @php
                                    $key = $c->kode_cpl . '-' . $b->kode_bk;
                                    $selectedKodeMk = $pemetaan[$key][0]->kode_mk ?? '';
                                @endphp
                                <select name="pemetaan[{{ $c->kode_cpl }}][{{ $b->kode_bk }}]" class="form-select text-center text-sm px-1 py-1 w-32">
                                    <option value="" disabled selected >Pilih MK</option>
                                    @foreach ($mataKuliah as $mk)
                                        <option value="{{ $mk->kode_mk }}" {{ $selectedKodeMk == $mk->kode_mk ? 'selected' : '' }}>
                                            {{ $mk->nama_mk }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
    </form>
</div>
@endsection