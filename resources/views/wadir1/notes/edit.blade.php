@extends('layouts.wadir1.app')

@section('content')
    <div class="mr-20 ml-20">
        <h2 class="text-4xl text-center font-extrabold mb-4">Edit Catatan Wadir</h2>
        <hr class="w-full border border-black mb-4">

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('wadir1.notes.update', $note->id_note) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="kode_prodi" class="text-2xl font-semibold mb-2">Program Studi:</label>
                <select id="kode_prodi" name="kode_prodi"
                    class="border border-black p-3 w-full rounded-lg mt-1 mb-3 focus:outline-none focus:ring-2 focus:ring-[#5460B5] focus:bg-[#f7faff]"
                    required>
                    <option value="" disabled>Pilih Prodi</option>
                    @foreach ($prodis as $prodi)
                        <option value="{{ $prodi->kode_prodi }}" 
                            {{ $note->kode_prodi == $prodi->kode_prodi ? 'selected' : '' }}>
                            {{ $prodi->nama_prodi }}
                        </option>
                    @endforeach
                </select>
                @error('kode_prodi')
                    <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="title" class="text-2xl font-semibold mb-2">Judul:</label>
                <input type="text" id="title" name="title" value="{{ old('title', $note->title) }}"
                    class="border border-black p-3 w-full rounded-lg mt-1 mb-3 focus:outline-none focus:ring-2 focus:ring-[#5460B5] focus:bg-[#f7faff]"
                    placeholder="Masukkan judul catatan">
                @error('title')
                    <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- <div class="mb-4">
                <label for="category" class="text-2xl font-semibold mb-2">Kategori:</label>
                <input type="text" id="category" name="category" value="{{ old('category', $note->category) }}"
                    class="border border-black p-3 w-full rounded-lg mt-1 mb-3 focus:outline-none focus:ring-2 focus:ring-[#5460B5] focus:bg-[#f7faff]"
                    placeholder="Masukkan kategori catatan">
                @error('category')
                    <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
                @enderror
            </div> --}}

            <div class="mb-4">
                <label for="note_content" class="text-2xl font-semibold mb-2">Catatan:</label>
                <textarea id="note_content" name="note_content" rows="6"
                    class="border border-black p-3 w-full rounded-lg mt-1 mb-3 focus:outline-none focus:ring-2 focus:ring-[#5460B5] focus:bg-[#f7faff]"
                    placeholder="Tulis catatan di sini..." required>{{ old('note_content', $note->note_content) }}</textarea>
                @error('note_content')
                    <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-end space-x-5 pt-6">
              <a href="{{ route('wadir1.notes.index') }}" 
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
@endsection