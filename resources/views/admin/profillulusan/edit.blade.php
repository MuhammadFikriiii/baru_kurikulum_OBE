@extends('layouts.app')

@section('title', 'Edit Profil Lulusan')

@section('content')
<div class="mx-20 mt-6">
    <h2 class="text-3xl font-extrabold text-center mb-5">Edit Profil Lulusan</h2>
    <hr class="border-t-2 md:border-t-4 border-black my-3 md:my-4 mx-auto">

    <div class="bg-white px-6 pb-6  rounded-lg shadow-md">
        @if ($errors->any())
            <div class="text-red-600 mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.profillulusan.update', $profillulusan->id_pl) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4">
                <div class="space-y-4">
                    <!-- Tahun -->
                    <div>
                        <label for="id_tahun" class="block text-lg font-semibold mb-2 text-gray-700">Tahun</label>
                        <select name="id_tahun" id="id_tahun" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]" required>
                            <option value="" disabled selected>Pilih Tahun</option>
                            @foreach ($tahuns as $tahun)
                                <option value="{{ $tahun->id_tahun }}" {{ $tahun->id_tahun == $profillulusan->id_tahun ? 'selected' : '' }}>
                                    {{ $tahun->tahun }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Kode Profil Lulusan -->
                    <div>
                        <label for="kode_pl" class="block text-lg font-semibold mb-2 text-gray-700">Kode Profil Lulusan</label>
                        <input type="text" name="kode_pl" id="kode_pl" value="{{ old('kode_pl', $profillulusan->kode_pl) }}"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]" required>
                    </div>

                    <!-- Program Studi -->
                    <div>
                        <label for="kode_prodi" class="block text-lg font-semibold mb-2 text-gray-700">Program Studi</label>
                        <select name="kode_prodi" id="kode_prodi" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]" required>
                            @foreach ($prodis as $prodi)
                                <option value="{{ $prodi->kode_prodi }}" {{ $prodi->kode_prodi == $profillulusan->kode_prodi ? 'selected' : '' }}>
                                    {{ $prodi->nama_prodi }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Unsur PL -->
                    <div>
                        <label for="unsur_pl" class="block text-lg font-semibold mb-2 text-gray-700">Unsur PL</label>
                        <select name="unsur_pl" id="unsur_pl" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]" required>
                            <option value="Pengetahuan" {{ $profillulusan->unsur_pl == 'Pengetahuan' ? 'selected' : '' }}>Pengetahuan</option>
                            <option value="Keterampilan Khusus" {{ $profillulusan->unsur_pl == 'Keterampilan Khusus' ? 'selected' : '' }}>Keterampilan Khusus</option>
                            <option value="Sikap dan Keterampilan Umum" {{ $profillulusan->unsur_pl == 'Sikap dan Keterampilan Umum' ? 'selected' : '' }}>Sikap dan Keterampilan Umum</option>
                        </select>
                    </div>

                    <!-- Keterangan -->
                    <div>
                        <label for="keterangan_pl" class="block text-lg font-semibold mb-2 text-gray-700">Keterangan</label>
                        <select name="keterangan_pl" id="keterangan_pl" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]" required>
                            <option value="Kompetensi Utama Bidang" {{ $profillulusan->keterangan_pl == 'Kompetensi Utama Bidang' ? 'selected' : '' }}>
                                Kompetensi Utama Bidang
                            </option>
                            <option value="Kompetensi Tambahan" {{ $profillulusan->keterangan_pl == 'Kompetensi Tambahan' ? 'selected' : '' }}>
                                Kompetensi Tambahan
                            </option>
                        </select>
                    </div>
                </div>

                <div class="space-y-4">
                    <!-- Deskripsi PL -->
                    <div>
                        <label for="deskripsi_pl" class="block text-lg font-semibold mb-2 text-gray-700">Deskripsi Profil Lulusan</label>
                        <textarea name="deskripsi_pl" id="deskripsi_pl"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" focus:bg-[#fbfffd] required>{{ old('deskripsi_pl', $profillulusan->deskripsi_pl) }}</textarea>
                    </div>

                    <!-- Profesi PL -->
                    <div>
                        <label for="profesi_pl" class="block text-lg font-semibold mb-2 text-gray-700">Profesi Profil Lulusan</label>
                        <textarea name="profesi_pl" id="profesi_pl"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]" required>{{ old('profesi_pl', $profillulusan->profesi_pl) }}</textarea>
                    </div>

                    <!-- Sumber -->
                    <div>
                        <label for="sumber_pl" class="block text-lg font-semibold mb-2 text-gray-700">Sumber</label>
                        <textarea name="sumber_pl" id="sumber_pl"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]" required>{{ old('sumber_pl', $profillulusan->sumber_pl) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-end space-x-5 pt-6">
                <a href="{{ route('admin.profillulusan.index') }}" 
                   class="px-6 py-2 bg-blue-600 hover:bg-blue-900 text-white font-semibold rounded-lg transition duration-200">
                    Kembali
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-green-600 hover:bg-green-800 text-white font-semibold rounded-lg transition duration-200">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
