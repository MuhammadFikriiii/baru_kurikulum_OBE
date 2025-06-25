@extends('layouts.tim.app')

@section('content')

    <div class="mr-20 ml-20">
        <h2 class="text-4xl text-center font-extrabold mb-4">Edit Profil Lulusan</h2>
        <hr class="border border-black mb-4">

        @if ($errors->any())
            <div style="color: red;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tim.profillulusan.update', $profillulusan->id_pl) }}" method="POST">

            @csrf
            @method('PUT')

            <div>
                <label for="id_tahun" class="block text-lg font-semibold mb-2 text-gray-700">Tahun</label>
                <select id="id_tahun" name="id_tahun" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                    <option value="" disabled>Pilih Tahun</option>
                    @foreach ($tahuns as $tahun)
                        <option value="{{ $tahun->id_tahun }}"
                            {{ $tahun->id_tahun == $profillulusan->id_tahun ? 'selected' : '' }}>
                            {{ $tahun->tahun }}
                        </option>
                    @endforeach
                </select>
            </div>

            <label class="text-xl font-semibold">Program Studi:</label>
            <input type="text" class="mt-1 w-full p-3 border border-black rounded-lg mb-3 bg-gray-100"
                value="{{ Auth::user()->prodi->nama_prodi }}" readonly>

            <label for="kode_pl" class="text-xl font-semibold">Kode Profil Lulusan:</label>
            <input type="text" name="kode_pl" id="kode_pl" value="{{ old('kode_pl', $profillulusan->kode_pl) }}"
                class="mt-1 p-3 border border-black rounded-lg w-full mb-3" required>
            <br>

            <label for="deskripsi_pl" class="text-xl font-semibold">Deskripsi Profil Lulusan:</label>
            <textarea name="deskripsi_pl" id="deskripsi_pl" class="mt-1 p-3 border border-black rounded-lg w-full mb-3" required>{{ old('deskripsi_pl', $profillulusan->deskripsi_pl) }}</textarea>
            <br>

            <label for="profesi_pl" class="text-xl font-semibold">Profesi Profil Lulusan:</label>
            <textarea name="profesi_pl" id="profesi_pl" class="mt-1 p-3 border border-black rounded-lg w-full mb-3" required>{{ old('profesi_pl', $profillulusan->profesi_pl) }}</textarea>
            <br>

            <label for="unsur_pl" class="text-xl font-semibold">Unsur PL:</label>
            <select name="unsur_pl" id="unsur_pl" class="mt-1 p-3 border border-black rounded-lg w-full mb-3" required>
                <option value="Pengetahuan" {{ $profillulusan->unsur_pl == 'Pengetahuan' ? 'selected' : '' }}>Pengetahuan
                </option>
                <option value="Keterampilan Khusus"
                    {{ $profillulusan->unsur_pl == 'Keterampilan Khusus' ? 'selected' : '' }}>Keterampilan Khusus</option>
                <option value="Sikap dan Keterampilan Umum"
                    {{ $profillulusan->unsur_pl == 'Sikap dan Keterampilan Umum' ? 'selected' : '' }}>Sikap dan
                    Keterampilan
                    Umum</option>
            </select>
            <br>

            <label for="keterangan_pl" class="text-xl font-semibold">Keterangan:</label>
            <select name="keterangan_pl" id="keterangan_pl" class="mt-1 p-3 border border-black rounded-lg w-full mb-3"
                required>
                <option value="Kompetensi Utama Bidang"
                    {{ $profillulusan->keterangan_pl == 'Kompetensi Utama Bidang' ? 'selected' : '' }}>Kompetensi Utama
                    Bidang</option>
                <option value="Kompetensi Tambahan"
                    {{ $profillulusan->keterangan_pl == 'Kompetensi Tambahan' ? 'selected' : '' }}>Kompetensi Tambahan
                </option>
            </select>
            <br>

            <label for="sumber_pl" class="text-xl font-semibold">Sumber:</label>
            <textarea name="sumber_pl" id="sumber_pl" class="mt-1 p-3 border border-black rounded-lg w-full mb-3" required>{{ old('sumber_pl', $profillulusan->sumber_pl) }}</textarea>
            <br>

            <button type="submit"
                class="bg-blue-600 hover:bg-blue-800 px-5 py-2 rounded-lg text-white font-bold">Simpan</button>
            <a href="{{ route('tim.profillulusan.index') }}"
                class="ml-2 bg-gray-600 hover:bg-gray-700 px-5 py-2 rounded-lg text-white font-bold">Kembali</a>
        </form>
    </div>
@endsection
