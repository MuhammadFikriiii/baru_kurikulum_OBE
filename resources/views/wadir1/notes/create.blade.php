@extends('layouts.wadir1.app')

@section('content')
    <div class="mr-20 ml-20">
        <h2 class="text-4xl text-center font-extrabold mb-4">Tambah Catatan Wadir</h2>
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

        <form action="{{ route('wadir1.notes.store') }}" method="POST">
            @csrf

            <!-- Field Program Studi -->
            <label for="kode_prodi" class="text-2xl font-semibold mb-2">Program Studi:</label>
            <select id="kode_prodi" name="kode_prodi"
                class="w-full p-3 border border-gray-300 rounded-lg mt-1 mb-3 focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]"
                required>
                <option value="" selected disabled>Pilih Prodi</option>
                @foreach ($prodis as $prodi)
                    <option value="{{ $prodi->kode_prodi }}">{{ $prodi->nama_prodi }}</option>
                @endforeach
            </select>
            @error('kode_prodi')
                <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
            @enderror

            <!-- Field Judul (Baru Ditambahkan) -->
            <label for="title" class="text-2xl font-semibold mb-2">Judul:</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}"
                class="w-full p-3 border border-gray-300 rounded-lg mt-1 mb-3 focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]"
                placeholder="Masukkan judul catatan">
            @error('title')
                <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
            @enderror
            

            <!-- Field Kategori (Baru Ditambahkan) -->
            {{-- <label for="category" class="text-2xl font-semibold mb-2">Kategori:</label>
            <select id="category" name="category" class="border border-black p-3 w-full rounded-lg mt-1 mb-3 focus:outline-none focus:ring-2 focus:ring-[#5460B5] focus:bg-[#f7faff]">
                <option value="">Pilih Kategori</option>
                <option value="Profil Lulusan" {{ old('category') == 'Profil Lulusan' ? 'selected' : '' }}>Profil Lulusan</option>
                <option value="Capaian Profil Lulusan" {{ old('category') == 'Capaian Profil Lulusan' ? 'selected' : '' }}>Capaian Profil Lulusan</option>
                <option value="Pemetaan CPL-PL" {{ old('category') == 'Pemetaan CPL-PL' ? 'selected' : '' }}>Pemetaan CPL-PL</option>
                <option value="Bahan Kajian" {{ old('category') == 'Bahan Kajian' ? 'selected' : '' }}>Bahan Kajian</option>
                <option value="Pemetaan CPL-BK" {{ old('category') == 'Pemetaan CPL-BK' ? 'selected' : '' }}>Pemetaan CPL-BK</option>
                <option value="Mata Kuliah" {{ old('category') == 'Mata Kuliah' ? 'selected' : '' }}>Mata Kuliah</option>
                <option value="Pemetaan CPL-MK" {{ old('category') == 'Pemetaan CPL-MK' ? 'selected' : '' }}>Pemetaan CPL-MK</option>
                <option value="Pemetaan BK-MK" {{ old('category') == 'Pemetaan BK-MK' ? 'selected' : '' }}>Pemetaan BK-MK</option>
                <option value="Pemetaan CPL-BK-MK" {{ old('category') == 'Pemetaan CPL-BK-MK' ? 'selected' : '' }}>Pemetaan CPL-BK-MK</option>
                <option value="Orginsasi MK" {{ old('category') == 'Orginsasi MK' ? 'selected' : '' }}>Orginsasi MK</option>
                <option value="CPMK" {{ old('category') == 'CPMK' ? 'selected' : '' }}>CPMK</option>
            </select>
            @error('category')
                <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
            @enderror --}}

            <!-- Field Isi Catatan -->
            <label for="note_content" class="text-2xl font-semibold mb-2">Catatan:</label>
            <textarea id="note_content" name="note_content" rows="6"
                class="w-full p-3 border border-gray-300 rounded-lg mt-1 mb-3 focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]"
                placeholder="Tulis catatan di sini..." required>{{ old('note_content') }}</textarea>
            @error('note_content')
                <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
            @enderror

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
    </div>
@endsection