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
                    <div class="space-y-4">
                        <div>
                            <label for="id_jurusan" class="block text-lg font-semibold mb-2 ">Jurusan</label>
                            <select name="id_jurusan" id="id_jurusan" required
                                class="w-full p-3 border border-black rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                                <option value="" selected disabled>Pilih Jurusan</option>
                                @foreach ($jurusans as $jurusan)
                                    <option value="{{ $jurusan->id_jurusan }}">{{ $jurusan->nama_jurusan }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="kode_prodi" class="block text-lg font-semibold mb-2 ">Kode
                                Prodi</label>
                            <input type="text" name="kode_prodi" id="kode_prodi" required
                                class="w-full p-3 border border-black rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                        </div>

                        <div>
                            <label for="nama_prodi" class="block text-lg font-semibold mb-2 ">Nama
                                Prodi</label>
                            <input type="text" name="nama_prodi" id="nama_prodi" required
                                class="w-full p-3 border border-black rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                        </div>

                        <div>
                            <label for="nama_kaprodi" class="block text-lg font-semibold mb-2 ">Nama
                                Kaprodi</label>
                            <input type="text" name="nama_kaprodi" id="nama_kaprodi" required
                                class="w-full p-3 border border-black rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                        </div>

                        <div>
                            <label for="visi_prodi" class="block text-lg font-semibold mb-2 ">Visi
                                Keilmuan</label>
                            <input type="text" name="visi_prodi" id="visi_prodi" required
                                class="w-full p-3 border border-black rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                        </div>

                        <div>
                            <label class="block text-lg font-semibold mb-2 ">Tanggal Berdiri</label>
                            <input type="date" name="tgl_berdiri_prodi" required
                                class="w-full p-3 border border-black rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                        </div>

                        <div>
                            <label class="block text-lg font-semibold mb-2 ">Tanggal Penyelenggaraan</label>
                            <input type="date" name="penyelenggaraan_prodi" required
                                class="w-full p-3 border border-black rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                        </div>

                        <div>
                            <label for="nomor_sk" class="block text-lg font-semibold mb-2 ">Nomor SK</label>
                            <input type="text" name="nomor_sk" required id="nomor_sk"
                                class="w-full p-3 border border-black rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-lg font-semibold mb-2 ">Peringkat Akreditasi</label>
                            <select name="peringkat_akreditasi" required
                                class="w-full p-3 border border-black rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                                <option value="" disabled selected>Pilih Akreditasi</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-lg font-semibold mb-2 ">Nomor SK BAN-PT</label>
                            <input type="text" name="nomor_sk_banpt" required
                                class="w-full p-3 border border-black rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                        </div>

                        <div>
                            <label class="block text-lg font-semibold mb-2 ">Jenjang Pendidikan</label>
                            <select name="jenjang_pendidikan" required
                                class="w-full p-3 border border-black rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                                <option value="" disabled selected>Pilih Jenjang</option>
                                <option value="D3">D3</option>
                                <option value="D4">D4</option>
                            </select>
                        </div>

                        <div>
                            <label for="gelar_lulusan" class="block text-lg font-semibold mb-2 ">Gelar/Sebutan Lulusan</label>
                            <input type="text" name="gelar_lulusan" id="gelar_lulusan"
                                class="w-full p-3 border border-black rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                        </div>

                        <div>
                            <label for="telepon_prodi" class="block text-lg font-semibold mb-2">No. Telepon</label>
                            <input type="text" name="telepon_prodi" id="telepon_prodi"
                                class="w-full p-3 border border-black rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                        </div>

                        <div>
                            <label for="website_prodi" class="block text-lg font-semibold mb-2 ">Website</label>
                            <input type="text" name="website_prodi" id="website_prodi"
                                class="w-full p-3 border border-black rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                        </div>

                        <div>
                            <label for="email_prodi" class="block text-lg font-semibold mb-2">Email</label>
                            <input type="email" name="email_prodi" id="email_prodi"
                                class="w-full p-3 border border-black rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                        </div>

                        <div>
                            <label class="block text-lg font-semibold mb-2 ">Tanggal SK</label>
                            <input type="date" name="tanggal_sk" required
                                class="w-full p-3 border border-black rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                        </div>
                    </div>
                </div>

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
