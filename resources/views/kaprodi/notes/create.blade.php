@extends('layouts.kaprodi.app')

@section('content')
    <div class="mr-20 ml-20">
        <h2 class="text-4xl text-center font-extrabold mb-4">Tambah Catatan Kaprodi</h2>
        <hr class="w-full border border-black mb-4">

        <div class="bg-white p-6 rounded-lg shadow-md">

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('kaprodi.notes.store') }}" method="POST">
                @csrf

                {{-- Judul --}}
                <label for="title" class="text-2xl font-semibold mb-2">Judul:</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}"
                    class="w-full p-3 border border-gray-300 rounded-lg mt-1 mb-3 focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]"
                    placeholder="Masukkan judul catatan">
                @error('title')
                    <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
                @enderror

                {{-- Catatan --}}
                <label for="note_content" class="text-2xl font-semibold mb-2">Catatan:</label>
                <textarea id="note_content" name="note_content" rows="6"
                    class="w-full p-3 border border-gray-300 rounded-lg mt-1 mb-3 focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]"
                    placeholder="Tulis catatan di sini..." required>{{ old('note_content') }}</textarea>
                @error('note_content')
                    <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
                @enderror

                {{-- Tombol --}}
                <div class="flex justify-end space-x-5 pt-6">
                    <a href="{{ route('kaprodi.notes.index') }}"
                        class="px-6 py-2 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg transition duration-200">
                        Kembali
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition duration-200">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
