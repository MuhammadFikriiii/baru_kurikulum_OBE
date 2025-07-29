@extends('layouts.tim.app')

@section('content')
    <div class="bg-white p-4 md:p-6 lg:p-8 rounded-lg shadow-md mx-2 md:mx-0">

        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Visi Misi</h1>
            <hr class="border-t-2 md:border-t-4 border-black my-3 md:my-4 mx-auto">
        </div>

        <div class="visi">
            <h1 class="text-2xl text-black text-center">Visi Poliban</h1>
            <p class="text-center mt-4">{{ $visis->visi }}</p>
        </div>

        <div class="misi">
            <h1 class="text-2xl text-black text-center mt-10">Misi Poliban</h1>
            <ol class="list-decimal ml-6 mt-4">
                @foreach ($misis as $misi)
                    <li>{{ $misi->misi }}</li>
                @endforeach
            </ol>
        </div>

        <div>
            <h1 class="text-2xl text-black text-center mt-10">Visi Keilmuan Prodi</h1>
            <ul class="list-disc ml-6 mt-4">
                @foreach ($prodis as $prodi)
                    <p class="mt-4">{{ $prodi->nama_prodi }}</p>
                    <p>{{ $prodi->visi_prodi }}</p>
                @endforeach
            </ul>
        </div>
@endsection