@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold text-center mb-4">Detail Catatan Wadir</h1>
        <hr class="border-t-4 border-black my-4">

        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-4">
                <h3 class="text-2xl font-semibold mb-2">Judul:</h3>
                <p class="text-lg">{{ $note->title ?? 'Tidak ada judul' }}</p>
            </div>

            <div class="mb-6">
                <h3 class="text-2xl font-semibold mb-2">Isi Catatan:</h3>
                <div class="border border-gray-300 p-4 rounded-lg bg-gray-50">
                    {!! nl2br(e($note->note_content)) !!}
                </div>
            </div>

            <div class="flex justify-end space-x-5 pt-6">
                <a href="{{ route('admin.notes.index') }}"
                    class="px-6 py-2 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg transition duration-200">
                    Kembali
                </a>
            </div>
        </div>
    </div>
@endsection
