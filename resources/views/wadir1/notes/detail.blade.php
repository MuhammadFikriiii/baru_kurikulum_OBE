@extends('layouts.wadir1.app')

@section('content')
    <div class="mr-20 ml-20">
        <h2 class="text-4xl text-center font-extrabold mb-4">Detail Catatan Wadir</h2>
        <hr class="w-full border border-black mb-4">

        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-4">
                <h3 class="text-2xl font-semibold mb-2">Program Studi:</h3>
                <p class="text-lg">{{ $note->prodi->nama_prodi ?? 'Tidak ada prodi' }}</p>
            </div>

            <div class="mb-4">
                <h3 class="text-2xl font-semibold mb-2">Judul:</h3>
                <p class="text-lg">{{ $note->title ?? 'Tidak ada judul' }}</p>
            </div>

            {{-- <div class="mb-4">
                <h3 class="text-2xl font-semibold mb-2">Kategori:</h3>
                <p class="text-lg">{{ $note->category ?? 'Tidak ada kategori' }}</p>
            </div> --}}

            <div class="mb-6">
                <h3 class="text-2xl font-semibold mb-2">Isi Catatan:</h3>
                <div class="border border-gray-300 p-4 rounded-lg bg-gray-50">
                    {!! nl2br(e($note->note_content)) !!}
                </div>
            </div>

            <div class="flex justify-between items-center">
  
                <div class="flex space-x-3">
                    <a href="{{ route('wadir1.notes.edit', $note->id_note) }}" 
                       class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold rounded-lg transition duration-200">
                        Edit
                    </a>
                    <form action="{{ route('wadir1.notes.destroy', $note->id_note) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="px-4 py-2 bg-red-600 hover:bg-red-800 text-white font-semibold rounded-lg transition duration-200"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus catatan ini?')">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="flex justify-end space-x-5 pt-6">
            <a href="{{ route('wadir1.notes.index') }}" 
              class="px-6 py-2 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg transition duration-200">
                  Kembali
              </a>
        </div>
    </div>
@endsection