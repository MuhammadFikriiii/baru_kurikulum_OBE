@extends('layouts.app')

@section('content')
<div class="mr-20 ml-20">
    <h2 class="text-4xl font-extrabold text-center mb-4">Pemenuhan CPL</h2>
<hr class="border border-black mb-4">

<form method="GET" action="{{ route('admin.pemenuhancpl.index') }}">
    <select name="kode_prodi" onchange="this.form.submit()" class="border border-gray-300 px-3 py-2 rounded-md mr-2">
        <option value="all" {{ $kode_prodi == 'all' ? 'selected' : '' }}>All</option>
        @foreach($prodis as $prodi)
            <option value="{{ $prodi->kode_prodi }}" {{ $kode_prodi == $prodi->kode_prodi ? 'selected' : '' }}>
                {{ $prodi->nama_prodi }}
            </option>
        @endforeach
    </select>
</form>       
<table class="w-full border border-gray-300 shadow-md rounded-lg text-center">
    <thead class="bg-green-500">
        <tr>
            <th>CPL</th>
            @for ($i = 1; $i <= 8; $i++)
                <th>Semester {{ $i }}</th>
            @endfor
        </tr>
    </thead>
    <tbody>
        @foreach ($petaCPL as $cpl => $semesters)
            <tr>
                <td class="border border-b">{{ $cpl }}</td>
                @for ($i = 1; $i <= 8; $i++)
                    <td class="border border-b">
                        @if (!empty($semesters['Semester '.$i]))
                            {!! implode('<br>', $semesters['Semester '.$i]) !!}
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
@endsection