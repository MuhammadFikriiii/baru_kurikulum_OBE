@extends('layouts.app')

@section('content')
    <div class="mx-20 mt-6">
        <h2 class="font-extrabold text-3xl mb-5 text-center">Detail Profil Lulusan</h2>
        <hr class="border-t-2 md:border-t-4 border-black my-3 md:my-4 mx-auto">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 px-6 pb-6  bg-white p-6 rounded-lg shadow-md">
            <!-- Kolom Pertama -->
            <div class="space-y-4">
                <div>
                    <label for="tahun" class="block text-lg">Tahun </label>
                    <input type="text" id="tahun" value="{{ $profillulusan->tahun->tahun }}" readonly
                        class="w-full p-3 border border-black rounded-lg focus:outline-none">
                </div>

                <div>
                    <label for="kode_pl" class="block text-lg">Kode PL</label>
                    <input type="text" id="kode_pl" value="{{ $profillulusan->kode_pl }}" readonly
                        class="w-full p-3 border border-black rounded-lg focus:outline-none">
                </div>

                <div>
                    <label for="unsur_pl" class="block text-lg">Unsur PL</label>
                    <input type="text" id="unsur_pl" value="{{ $profillulusan->unsur_pl }}" readonly
                        class="w-full p-3 border border-black rounded-lg focus:outline-none">
                </div>

                <div>
                    <label for="deskripsi_pl" class="block text-lg">Deskripsi PL</label>
                    <textarea id="deskripsi_pl" readonly
                        class="w-full h-32 p-3 border border-black rounded-lg focus:outline-none resize-none">{{ $profillulusan->deskripsi_pl }}</textarea>
                </div>
            </div>

            <!-- Kolom Kedua -->
            <div class="space-y-4">
                <div>
                    <label for="nama_prodi" class="block text-lg">Nama Prodi</label>
                    <input type="text" id="nama_prodi" value="{{ $profillulusan->prodi->nama_prodi }}" readonly
                        class="w-full p-3 border border-black rounded-lg focus:outline-none">
                </div>

                <div>
                    <label for="keterangan_pl" class="block text-lg">Keterangan PL</label>
                    <input type="text" id="keterangan_pl" value="{{ $profillulusan->keterangan_pl }}" readonly
                        class="w-full p-3 border border-black rounded-lg focus:outline-none">
                </div>

                <div>
                    <label for="sumber_pl" class="block text-lg">Sumber PL</label>
                    <input type="text" id="sumber_pl" value="{{ $profillulusan->sumber_pl }}" readonly
                        class="w-full p-3 border border-black rounded-lg focus:outline-none">
                </div>

                <div>
                    <label for="profesi_pl" class="block text-lg">Profesi PL</label>
                    <textarea id="profesi_pl" readonly
                        class="w-full h-32 p-3 border border-black rounded-lg focus:outline-none resize-none">{{ $profillulusan->profesi_pl }}</textarea>
                </div>

                <!-- Tombol Aksi -->
                {{-- <div class="flex justify-end items-end pt-10">
                    <a href="{{ route('admin.profillulusan.edit', $profillulusan->id_pl) }}"
                        class="px-5 py-2 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold rounded-lg transition duration-200">
                        Edit
                    </a>
                    <form action="{{ route('admin.profillulusan.destroy', $profillulusan->id_pl) }}" method="POST" class="ml-4">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-4 py-2 bg-red-600 hover:bg-red-800 text-white font-semibold rounded-lg transition duration-200"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                            Hapus
                        </button>
                    </form>
                </div> --}}
            </div>
            <div class="flex justify-start pt-6">
                <a href="{{ route('admin.profillulusan.index') }}"
                    class="px-6 py-2 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg transition duration-200">
                    Kembali
                </a>
            </div>
        </div>
    </div>
@endsection
