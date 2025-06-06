@extends('layouts.app')

@section('content')
<div class="mx-5 md:mx-20 my-10">
    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Pemenuhan CPL</h1>
        <hr class="border-t-4 border-black my-4 mx-auto mb-4">
    </div>

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <form method="GET" action="{{ route('admin.pemenuhancpl.index') }}" class="w-full md:w-64">
            <select name="kode_prodi" onchange="this.form.submit()" 
                class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                <option value="" selected disabled>Pilih Prodi</option>
                @foreach($prodis as $prodi)
                    <option value="{{ $prodi->kode_prodi }}" {{ request('kode_prodi') == $prodi->kode_prodi ? 'selected' : '' }}>
                        {{ $prodi->nama_prodi }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    @if(request()->has('kode_prodi'))
        <div class="bg-white rounded-lg shadow overflow-hidden">
            @if(empty($petaCPL) || count($petaCPL) === 0)
            <div class="p-8 text-center text-gray-600">
                <strong>Data belum tersedia untuk prodi ini.</strong>
            </div>
            @else
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-300">
                    <thead class="bg-green-800 text-white">
                        <tr>
                            <th class="px-4 py-3">CPL</th>
                            @for ($i = 1; $i <= 8; $i++)
                                <th class="px-4 py-3">Semester {{ $i }}</th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($petaCPL as $item)
                        <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }} hover:bg-gray-100">
                            <td class="text-center px-4 py-4 border border-b">{{ $item['label'] }}</td>
                            @for ($i = 1; $i <= 8; $i++)
                                <td class="text-center px-4 py-4 border border-b">
                                    @if (!empty($item['semester']['Semester '.$i]))
                                        {!! implode('<br>', $item['semester']['Semester '.$i]) !!}
                                    @else
                                        -
                                    @endif
                                </td>
                            @endfor
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    @else
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-8 text-center text-gray-600">
                Silakan pilih prodi terlebih dahulu untuk melihat data.
            </div>
        </div>
    @endif
</div>
@endsection