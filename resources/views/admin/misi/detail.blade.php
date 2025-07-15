@extends('layouts.app')

@section('content')
    <div class="mx-20 mt-6">
        <h2 class="font-extrabold text-3xl mb-5 text-center">Detail Misi</h2>
        <hr class="border-t-2 md:border-t-4 border-black my-3 md:my-4 mx-auto">

        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Visi Terkait</h3>
                <p class="text-gray-700">{{ $misi->visi->visi }}</p>
            </div>

            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Isi Misi</h3>
                <p class="text-gray-700 whitespace-pre-line">{{ $misi->misi }}</p>
            </div>

            <div class="flex justify-end mt-6">
                <a href="{{ route('admin.misi.index') }}"
                    class="px-6 py-2 bg-blue-600 hover:bg-blue-900 text-white font-semibold rounded-lg transition duration-200">
                    Kembali
                </a>
            </div>
        </div>
    </div>
@endsection
