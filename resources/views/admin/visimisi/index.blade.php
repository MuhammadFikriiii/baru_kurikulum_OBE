@extends('layouts.app')

@section('content')
    <div class="bg-white p-4 md:p-6 lg:p-8 rounded-lg shadow-md mx-2 md:mx-0">

        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Visi Misi</h1>
            <hr class="border-t-2 md:border-t-4 border-black my-3 md:my-4 mx-auto">
        </div>

        {{-- Visi Poliban Section --}}
        <div class="mb-8 p-6 bg-green-50 rounded-lg shadow-sm">
            <h2 class="text-2xl font-semibold text-blue-800 text-center mb-4">Visi Poliban</h2>
            <p class="text-gray-700 text-center">{{ $visis->visi }}</p>
        </div>

        {{-- Misi Poliban Section --}}
        <div class="mb-8 p-6 bg-green-50 rounded-lg shadow-sm">
            <h2 class="text-2xl font-semibold text-green-800 text-center mb-4">Misi Poliban</h2>
            <ol class="list-decimal list-inside text-gray-700 space-y-2">
                @foreach ($misis as $misi)
                    <li>{{ $misi->misi }}</li>
                @endforeach
            </ol>
        </div>

        {{-- Visi Keilmuan Prodi Section --}}
        <div class="p-6 bg-yellow-50 rounded-lg shadow-sm">
            <h2 class="text-2xl font-semibold text-yellow-800 text-center mb-6">Visi Keilmuan Prodi</h2>
            <div class="space-y-6">
                @foreach ($prodis as $prodi)
                    <div class="text-center border-b border-yellow-50 pb-4 last:border-b-0">
                        <h3 class="text-lg font-medium text-yellow-700 mb-2">{{ $prodi->nama_prodi }}</h3>
                        <p class="text-gray-700">{{ $prodi->visi_prodi }}</p>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection