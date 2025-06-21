@extends('layouts.kaprodi.app')

@section('content')
    <div class="mr-20 ml-20">
        <h2 class="text-4xl text-center font-extrabold mb-4">Detail Catatan</h2>
        <hr class="w-full border border-black mb-4">

        <div class="bg-white p-6 rounded-lg shadow-md">

            <!-- Program Studi -->
            <div class="mb-4">
                <label class="text-2xl font-semibold mb-2 block">Program Studi:</label>
                <p class="text-lg border border-gray-300 rounded-lg p-3 bg-gray-100">
                    {{ $note->prodi->nama_prodi ?? 'Tidak ada prodi' }}
                </p>
            </div>

            <!-- Judul -->
            <div class="mb-4">
                <label class="text-2xl font-semibold mb-2 block">Judul:</label>
                <p class="text-lg border border-gray-300 rounded-lg p-3 bg-gray-100">
                    {{ $note->title ?? 'Tidak ada judul' }}
                </p>
            </div>

            <!-- Isi Catatan -->
            <div class="mb-6">
                <label class="text-2xl font-semibold mb-2 block">Isi Catatan:</label>
                <div class="border border-gray-300 p-4 rounded-lg bg-gray-50">
                    {!! nl2br(e($note->note_content)) !!}
                </div>
            </div>

            <!-- Tombol Kembali -->
            <div class="flex justify-end pt-6">
                <a href="{{ route('kaprodi.notes.index') }}"
                    class="px-6 py-2 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg transition duration-200">
                    Kembali
                </a>
            </div>
        </div>
    </div>
@endsection
