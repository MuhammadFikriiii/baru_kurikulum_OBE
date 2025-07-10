@extends('layouts.app')

@section('content')
    <div class="mx-20 mt-6">
        <h2 class="font-extrabold text-3xl mb-5 text-center">Tambah Prodi</h2>
        <hr class="border-t-2 md:border-t-4 border-black my-3 md:my-4 mx-auto">

        <div class="bg-white px-6 pb-6  rounded-lg shadow-md">

            @if ($errors->any())
                <div class="text-red-600 mb-4">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.prodi.store') }}" method="POST" class="space-y-4">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-6">
                    <!-- Kolom Pertama -->
                    <div class="space-y-4">
                        <!-- Jurusan -->
                        <div>
                            <label for="id_jurusan" class="block text-lg font-semibold mb-2 text-gray-700">Jurusan</label>
                            <select name="id_jurusan" id="id_jurusan" required
                                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                                <option value="" selected disabled>Pilih Jurusan</option>
                                @foreach ($jurusans as $jurusan)
                                    <option value="{{ $jurusan->id_jurusan }}">{{ $jurusan->nama_jurusan }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Kode Prodi -->
                        <div>
                            <label for="kode_prodi" class="block text-lg font-semibold mb-2 text-gray-700">Kode
                                Prodi</label>
                            <input type="text" name="kode_prodi" id="kode_prodi" required
                                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                        </div>

                        <!-- Nama Prodi -->
                        <div>
                            <label for="nama_prodi" class="block text-lg font-semibold mb-2 text-gray-700">Nama
                                Prodi</label>
                            <input type="text" name="nama_prodi" id="nama_prodi" required
                                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                        </div>

                        <!-- Nama Kaprodi -->
                        <div>
                            <label for="nama_kaprodi" class="block text-lg font-semibold mb-2 text-gray-700">Nama
                                Kaprodi</label>
                            <input type="text" name="nama_kaprodi" id="nama_kaprodi" required
                                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                        </div>

                        <!-- Nama Kaprodi -->
                        <div>
                            <label for="visi_prodi" class="block text-lg font-semibold mb-2 text-gray-700">Visi
                                Keilmuan</label>
                            <input type="text" name="visi_prodi" id="visi_prodi" required
                                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                        </div>

                        <!-- Tanggal Berdiri -->
                        <div>
                            <label class="block text-lg font-semibold mb-2 text-gray-700">Tanggal Berdiri</label>
                            <input type="date" name="tgl_berdiri_prodi" required
                                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                        </div>

                        <!-- Tanggal Penyelenggaraan -->
                        <div>
                            <label class="block text-lg font-semibold mb-2 text-gray-700">Tanggal Penyelenggaraan</label>
                            <input type="date" name="penyelenggaraan_prodi" required
                                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                        </div>

                        <!-- Nomor SK -->
                        <div>
                            <label class="block text-lg font-semibold mb-2 text-gray-700">Nomor SK</label>
                            <input type="text" name="nomor_sk" required
                                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                        </div>
                    </div>

                    <!-- Kolom Kedua -->
                    <div class="space-y-4">
                        <!-- Peringkat Akreditasi -->
                        <div>
                            <label class="block text-lg font-semibold mb-2 text-gray-700">Peringkat Akreditasi</label>
                            <select name="peringkat_akreditasi" required
                                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                                <option value="" disabled selected>Pilih Akreditasi</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                            </select>
                        </div>

                        <!-- Nomor SK BAN-PT -->
                        <div>
                            <label class="block text-lg font-semibold mb-2 text-gray-700">Nomor SK BAN-PT</label>
                            <input type="text" name="nomor_sk_banpt" required
                                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                        </div>

                        <!-- Jenjang Pendidikan -->
                        <div>
                            <label class="block text-lg font-semibold mb-2 text-gray-700">Jenjang Pendidikan</label>
                            <select name="jenjang_pendidikan" required
                                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                                <option value="" disabled selected>Pilih Jenjang</option>
                                <option value="D3">D3</option>
                                <option value="D4">D4</option>
                            </select>
                        </div>

                        <!-- Gelar Lulusan -->
                        <div>
                            <label class="block text-lg font-semibold mb-2 text-gray-700">Gelar/Sebutan Lulusan</label>
                            <input type="text" name="gelar_lulusan"
                                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                        </div>

                        <!-- Telepon -->
                        <div>
                            <label class="block text-lg font-semibold mb-2 text-gray-700">No. Telepon</label>
                            <input type="text" name="telepon_prodi"
                                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                        </div>

                        <!-- Website -->
                        <div>
                            <label class="block text-lg font-semibold mb-2 text-gray-700">Website</label>
                            <input type="text" name="website_prodi"
                                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-lg font-semibold mb-2 text-gray-700">Email</label>
                            <input type="email" name="email_prodi"
                                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                        </div>


                        <!-- Tanggal SK -->
                        <div>
                            <label class="block text-lg font-semibold mb-2 text-gray-700">Tanggal SK</label>
                            <input type="date" name="tanggal_sk" required
                                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-end space-x-5 pt-6">
                    <a href="{{ route('admin.prodi.index') }}"
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
