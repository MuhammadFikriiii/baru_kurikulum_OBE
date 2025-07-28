@extends('layouts.tim.app')

@section('content')

<div class="visi">
    <h2>Visi</h2>
    <p>{{ $visis->visi }}</p>
</div>

<div class="misi">
    <h2>Misi</h2>
    <ul>
        @foreach ($misis as $misi)
            <li>{{ $misi->misi }}</li>
        @endforeach
    </ul>
</div>
@endsection