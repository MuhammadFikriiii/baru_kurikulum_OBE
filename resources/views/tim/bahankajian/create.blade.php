@extends('layouts.tim.app')

@section('content')

    <div class="mr-20 ml-20">
        <h2 class="text-4xl text-center font-extrabold mb-4">Tambah Bahan Kajian</h2>
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

        <form action="{{ route('tim.bahankajian.store') }}" method="POST">
            @csrf

            <label for="id_cpls" class="text-xl font-semibold mb-2">Capaian Profil Lulusan Terkait:</label>
            <select id="id_cpls" name="id_cpls[]" size="2"
                class="border border-black p-3 w-full rounded-lg mt-1 mb-3 focus:outline-none focus:ring-2 focus:ring-[#5460B5] focus:bg-[#f7faff]"
                multiple required>
                @foreach ($capaianProfilLulusans as $cpl)
                    <option value="{{ $cpl->id_cpl }}" title="{{ $cpl->kode_cpl }} - {{ $cpl->deskripsi_cpl }}">
                        {{ $cpl->kode_cpl }}: {{ $cpl->deskripsi_cpl }}
                    </option>
                @endforeach
            </select>
            <p class="italic text-red-700 mb-2">*Tekan tombol Ctrl dan klik untuk memilih lebih dari satu item.</p>

            <label for="kode_bk" class="text-xl font-semibold">Kode Bahan Kajian:</label>
            <input id="kode_bk" type="text" name="kode_bk" class="border border-black p-3 w-full mt-1 mb-3 rounded-lg"
                required>
            <br>

            <label for="nama_bk" class="font-semibold text-xl">Nama Bahan Kajian:</label>
            <input id="nama_bk" type="text" name="nama_bk" class="border border-black p-3 w-full mt-1 mb-3 rounded-lg"
                required>
            <br>

            <label for="deskripsi_bk" class="font-semibold text-xl">Deskripsi Bahan Kajian:</label>
            <input id="deskripsi_bk" type="text" name="deskripsi_bk"
                class="border border-black p-3 w-full mt-1 mb-3 rounded-lg">
            <br>

            <label for="referensi_bk" class="text-xl font-semibold">Referensi Bahan Kajian:</label>
            <input id="referensi_bk" type="text" name="referensi_bk"
                class="border border-black p-3 w-full mt-1 mb-3 rounded-lg" required>
            <br>

            <label for="status_bk" class="text-xl font-semibold">Status BK</label>
            <select id="status_bk" name="status_bk" class="border border-black p-3 w-full mt-1 mb-3 rounded-lg" required>
                <option value="" selected disabled>Pilih Status BK</option>
                <option value="core">Core</option>
                <option value="elective">Elective</option>
            </select>

            <label for="knowledge_area" class="text-xl font-semibold">knowledge Area Bahan Kajian:</label>
            <input id="knowledge_area" type="text" name="knowledge_area"
                class="border border-black p-3 w-full mt-1 mb-5 rounded-lg">
            <br>

            <button type="submit"
                class="bg-blue-600 hover:bg-blue-800 px-5 py-2 rounded-lg mt-3 text-white font-bold">Simpan</button>
            <a href="{{ route('tim.bahankajian.index') }}"
                class="ml-3 bg-gray-600 hover:bg-gray-700 rounded-lg px-5 py-2 text-white font-bold">Kembali</a>
        </form>
    </div>
@endsection
