@extends('layouts.app')

@section('content')
<div class="mx-20 mt-6">
    <h2 class="font-extrabold text-3xl mb-5 text-center">Edit Profil Lulusan</h2>
    <hr class="border-t-2 md:border-t-4 border-black my-3 md:my-4 mx-auto">

    <div class="bg-white px-6 pb-6 rounded-lg shadow-md">
        @if ($errors->any())
        <div class="text-red-600 mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.profillulusan.update', $profillulusan->id_pl) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-6">
                <div class="space-y-4">
                    <div>
                        <label for="id_tahun" class="block text-lg font-semibold mb-2 text-gray-700">Tahun</label>
                        <select id="id_tahun" name="id_tahun" required class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                            <option value="" disabled>Pilih Tahun</option>
                            @foreach ($tahuns as $tahun)
                                <option value="{{ $tahun->id_tahun }}" {{ $tahun->id_tahun == $profillulusan->id_tahun ? 'selected' : '' }}>{{ $tahun->tahun }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="kode_prodi" class="block text-lg font-semibold mb-2 text-gray-700">Prodi</label>
                        <select id="kode_prodi" name="kode_prodi" required class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                            <option value="" disabled>Pilih Prodi</option>
                            @foreach ($prodis as $prodi)
                                <option value="{{ $prodi->kode_prodi }}" {{ $prodi->kode_prodi == $profillulusan->kode_prodi ? 'selected' : '' }}>{{ $prodi->nama_prodi }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="kode_pl" class="block text-lg font-semibold mb-2 text-gray-700">Kode PL</label>
                        <input type="text" id="kode_pl" name="kode_pl" value="{{ $profillulusan->kode_pl }}" required class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>

                    <div>
                        <label for="deskripsi_pl" class="block text-lg font-semibold mb-2 text-gray-700">Deskripsi</label>
                        <textarea id="deskripsi_pl" name="deskripsi_pl" rows="3" required class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">{{ $profillulusan->deskripsi_pl }}</textarea>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label for="unsur_pl" class="block text-lg font-semibold mb-2 text-gray-700">Unsur PL</label>
                        <select id="unsur_pl" name="unsur_pl" required class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                            <option value="" disabled>Pilih Unsur</option>
                            <option value="Pengetahuan" {{ $profillulusan->unsur_pl == 'Pengetahuan' ? 'selected' : '' }}>Pengetahuan</option>
                            <option value="Keterampilan Khusus" {{ $profillulusan->unsur_pl == 'Keterampilan Khusus' ? 'selected' : '' }}>Keterampilan Khusus</option>
                            <option value="Sikap dan Keterampilan Umum" {{ $profillulusan->unsur_pl == 'Sikap dan Keterampilan Umum' ? 'selected' : '' }}>Sikap dan Keterampilan Umum</option>
                        </select>
                    </div>

                    <div>
                        <label for="keterangan_pl" class="block text-lg font-semibold mb-2 text-gray-700">Keterangan</label>
                        <select id="keterangan_pl" name="keterangan_pl" required class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                            <option value="Kompetensi Utama Bidang" {{ $profillulusan->keterangan_pl == 'Kompetensi Utama Bidang' ? 'selected' : '' }}>Kompetensi Utama Bidang</option>
                            <option value="Kompetensi Tambahan" {{ $profillulusan->keterangan_pl == 'Kompetensi Tambahan' ? 'selected' : '' }}>Kompetensi Tambahan</option>
                        </select>
                    </div>

                    <div>
                        <label for="profesi_pl" class="block text-lg font-semibold mb-2 text-gray-700">Profesi</label>
                        <input type="text" id="profesi_pl" name="profesi_pl" value="{{ $profillulusan->profesi_pl }}" required class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>

                    <div>
                        <label for="sumber_pl" class="block text-lg font-semibold mb-2 text-gray-700">Sumber</label>
                        <textarea id="sumber_pl" name="sumber_pl" rows="3" required class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">{{ $profillulusan->sumber_pl }}</textarea>
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-5 pt-6">
                <a href="{{ route('admin.profillulusan.index') }}" class="px-6 py-2 bg-blue-600 hover:bg-blue-900 text-white font-semibold rounded-lg transition duration-200">Kembali</a>
                <button type="submit" class="px-6 py-2 bg-green-600 hover:bg-green-800 text-white font-semibold rounded-lg transition duration-200">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
