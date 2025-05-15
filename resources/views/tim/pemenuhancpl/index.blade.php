@extends('layouts.tim.app')

@section('content')
<div class="mr-20 ml-20">
    <h2 class="text-4xl font-extrabold text-center mb-4">Pemenuhan CPL</h2>
<hr class="border border-black mb-4">
       
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
        @foreach ($petaCPL as $item)
    <tr>
        <td class="border border-b">{{ $item['label'] }}</td>
        @for ($i = 1; $i <= 8; $i++)
            <td class="border border-b">
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
@endsection