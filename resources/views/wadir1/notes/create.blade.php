@extends('layouts.wadir1.app')

@section('content')
    <div class="mr-20 ml-20">
        <h2 class="text-4xl text-center font-extrabold mb-4">Tambah Catatan Wadir</h2>
        <hr class="w-full border border-black mb-4">

        @if ($errors->any())
            <div style="color: red;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('wadir1.notes.store') }}" method="POST">
            @csrf

            <label for="kode_prodi" class="text-2xl font-semibold mb-2">Program Studi:</label>
            <select id="kode_prodi" name="kode_prodi"
                class="border border-black p-3 w-full rounded-lg mt-1 mb-3 focus:outline-none focus:ring-2 focus:ring-[#5460B5] focus:bg-[#f7faff]"
                required>
                <option value="" selected disabled>Pilih Prodi</option>
                @foreach ($prodis as $prodi)
                    <option value="{{ $prodi->kode_prodi }}">{{ $prodi->nama_prodi }}</option>
                @endforeach
            </select>
            @error('kode_prodi')
                <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
            @enderror

            <label for="note_content" class="text-2xl font-semibold mb-2">Catatan:</label>
            <textarea id="note_content" name="note_content" rows="6"
                class="border border-black p-3 w-full rounded-lg mt-1 mb-3 focus:outline-none focus:ring-2 focus:ring-[#5460B5] focus:bg-[#f7faff]"
                placeholder="Tulis catatan di sini..." required></textarea>
            @error('note_content')
                <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
            @enderror

            <div class="flex justify-start gap-2">
                <button type="submit"
                    class="btn btn-primary bg-green-400 hover:bg-green-800 px-5 py-2 rounded-lg text-white font-semibold">
                    Simpan
                </button>
                <a href="{{ route('wadir1.notes.index') }}"
                    class="bg-blue-400 hover:bg-blue-800 rounded-lg px-5 py-2 text-white font-semibold">
                    Kembali
                </a>
            </div>
        </form>
    </div>
@endsection