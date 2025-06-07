@extends('layouts.app')

@section('content')

    <div class="mr-20 ml-20">

        <h2 class="text-4xl font-extrabold mb-4 text-center">Tambah Capaian Pembelajaran Lulusan</h2>
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

        <form action="{{ route('admin.capaianprofillulusan.store') }}" method="POST">
            @csrf

            <label for="id_pls" class="text-xl font-semibold mb-2">PL Terkait</label>
            <select id="id_pls" name="id_pls"
                class="border border-black p-3 w-full rounded-lg mt-1 mb-3 focus:outline-none focus:ring-2 focus:ring-[#5460B5] focus:bg-[#f7faff]"
                required>
                <option value="" disabled selected>Pilih PL</option>
                @foreach ($profilLulusans as $pl)
                    <option value="{{ $pl->id_pl }}"
                        title="{{ $pl->nama_prodi }} - {{ $pl->kode_pl }} - {{ $pl->deskripsi_pl }}">
                        {{ $pl->nama_prodi }} - {{ $pl->kode_pl }} - {{ $pl->deskripsi_pl }}
                    </option>
                @endforeach
            </select>

            <label for="kode_cpl" class="text-xl font-semibold">Kode CPL</label>
            <input type="text" id="kode_cpl" name="kode_cpl" class="border border-black p-3 w-full rounded-lg mt-1 mb-3"
                required></input>
            <br>

            <label for="deskripsi_cpl" class="text-xl font-semibold">Deskripsi CPL</label>
            <textarea id="deskripsi_cpl" type="text" name="deskripsi_cpl"
                class="border border-black p-3 w-full rounded-lg mt-1 mb-3" required></textarea>
            <br>

            <label for="status_cpl" class="text-xl font-semibold">Status CPL</label>
            <select id="status_cpl" name="status_cpl" class="border border-black p-3 w-full rounded-lg mt-1 mb-3" required>
                <option value="" selected disabled>Pilih Status CPL</option>
                <option value="Kompetensi Utama Bidang">Kompetensi Utama</option>
                <option value="Kompetensi Tambahan">Kompetensi Tambahan</option>
            </select>
            <br>
            
                <div class="flex justify-end space-x-5 mt-[50px]">
                    <a href="{{ route('admin.capaianprofillulusan.index') }}" 
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
