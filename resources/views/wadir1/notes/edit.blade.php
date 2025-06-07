@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Catatan</h1>

        <div class="bg-white rounded-lg shadow overflow-hidden p-6">
            <form action="{{ route('wadir.notes.update', $note->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="prodi_id" class="block text-gray-700 font-medium mb-2">Prodi</label>
                    <select name="prodi_id" id="prodi_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" required>
                        @foreach($prodis as $prodi)
                            <option value="{{ $prodi->id }}" {{ $note->prodi_id == $prodi->id ? 'selected' : '' }}>{{ $prodi->nama_prodi }}</option>
                        @endforeach
                    </select>
                    @error('prodi_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="note" class="block text-gray-700 font-medium mb-2">Catatan</label>
                    <textarea name="note" id="note" rows="6" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Tulis catatan Anda di sini..." required>{{ old('note', $note->note) }}</textarea>
                    @error('note')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('wadir.notes.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md mr-2">
                        Batal
                    </a>
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md">
                        Update Catatan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection