@extends('layouts.app')

@section('content')

    <div class="mr-20 ml-20">
        <h2 class="text-4xl font-extrabold text-center mb-4">Tambah Profil Lulusan</h2>
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

        <form action="{{ route('admin.profillulusan.store') }}" method="POST">
            @csrf

            <label for="id_tahun" class="text-xl font-semibold">Tahun:</label>
            <select id="id_tahun" name="id_tahun" class="mt-1 w-full p-3 border border-black rounded-lg mb-3" required>
                <option value="" class="placeholder" selected disabled>Pilih Tahun</option>
                @foreach ($tahuns as $tahun)
                    <option value="{{ $tahun->id_tahun }}">{{ $tahun->tahun }}</option>
                @endforeach
            </select>
            <br>

            <label for="kode_prodi" class="text-xl font-semibold">kode prodi</label>
            <select id="kode_prodi" name="kode_prodi" class="mt-1 w-full p-3 border border-black rounded-lg mb-3" required>
                <option value="" class="placeholder" selected disabled>Pilih Prodi</option>
                @foreach ($prodis as $prodi)
                    <option value="{{ $prodi->kode_prodi }}">{{ $prodi->nama_prodi }}</option>
                @endforeach
            </select>
            <br>

            <label for="kode_pl" class="text-xl font-semibold">Kode PL:</label>
            <input type="text" id="kode_pl" name="kode_pl" class="mt-1 w-full p-3 border border-black rounded-lg mb-3"
                required>
            <br>

            <label for="deskripsi_pl" class="text-xl font-semibold">Deskripsi:</label>
            <textarea id="deskripsi_pl" name="deskripsi_pl" class="mt-1 w-full p-3 border border-black rounded-lg mb-3" required></textarea>
            <br>

            <label for="profesi_pl" class="text-xl font-semibold">Profesi:</label>
            <textarea id="profesi_pl" name="profesi_pl" class="mt-1 w-full p-3 border border-black rounded-lg mb-3" required></textarea>
            <br>

            <label for="unsur_pl" class="text-xl font-semibold">Unsur PL:</label>
            <select id="unsur_pl" name="unsur_pl" class="mt-1 w-full p-3 border border-black roubded rounded-lg mb-3"
                required>
                <option value="" selected disabled>Pilih Unsur</option>
                <option value="Pengetahuan">Pengetahuan</option>
                <option value="Keterampilan Khusus">Keterampilan Khusus</option>
                <option value="Sikap dan Keterampilan Umum">Sikap dan Keterampilan Umum</option>
            </select>
            <br>

            <label for="keterangan_pl" class="text-xl font-semibold">Keterangan:</label>
            <select id="keterangan_pl" name="keterangan_pl" class="mt-1 w-full p-3 border border-black rounded-lg mb-3"
                required>
                <option value=""selected disabled>Pilih Keterangan</option>
                <option value="Kompetensi Utama Bidang">Kompetensi Utama Bidang</option>
                <option value="Kompetensi Tambahan">Kompetensi Tambahan</option>
            </select>
            <br>

            <label for="sumber_pl" class="text-xl font-semibold">Sumber:</label>
            <textarea id="sumber_pl" name="sumber_pl" class="mt-1 w-full p-3 border border-black rounded-lg mb-3" required></textarea>
            <br>

            <button type="submit"
                class="bg-blue-600 hover:bg-blue-800 mt-3 px-5 py-2 text-white font-bold rounded-lg">Simpan</button>
            <a href="{{ route('admin.profillulusan.index') }}"
                class="ml-2 bg-gray-600 hover:bg-gray-800 mt-3 px-5 py-2 text-white font-bold rounded-lg">Kembali</a>
        </form>
    </div>
@endsection
