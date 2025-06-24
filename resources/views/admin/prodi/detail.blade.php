@extends('layouts.app')

@section('content')
<<<<<<< HEAD
    <div class="mx-20">
        <h2 class="text-4xl font-extrabold text-center mb-4">Detail Prodi</h2>
        <hr class="w-full border border-black mb-4">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
            <div>
                <label class="block text-xl font-semibold">Kode Prodi</label>
                <input type="text" value="{{ $prodi->kode_prodi }}" readonly
                    class="w-full p-3 border border-black rounded-lg bg-gray-100">
            </div>

            <div>
                <label class="block text-xl font-semibold">Nama Jurusan</label>
                <input type="text" value="{{ $prodi->jurusan->nama_jurusan }}" readonly
                    class="w-full p-3 border border-black rounded-lg bg-gray-100">
            </div>

            <div>
                <label class="block text-xl font-semibold">Nama Prodi</label>
                <input type="text" value="{{ $prodi->nama_prodi }}" readonly
                    class="w-full p-3 border border-black rounded-lg bg-gray-100">
            </div>

            <div>
                <label class="block text-xl font-semibold">Tanggal Berdiri</label>
                <input type="text" value="{{ $prodi->tgl_berdiri_prodi }}" readonly
                    class="w-full p-3 border border-black rounded-lg bg-gray-100">
            </div>

            <div>
                <label class="block text-xl font-semibold">Tanggal Penyelenggaraan</label>
                <input type="text" value="{{ $prodi->penyelenggaraan_prodi }}" readonly
                    class="w-full p-3 border border-black rounded-lg bg-gray-100">
            </div>

            <div>
                <label class="block text-xl font-semibold">Nomor SK</label>
                <input type="text" value="{{ $prodi->nomor_sk }}" readonly
                    class="w-full p-3 border border-black rounded-lg bg-gray-100">
            </div>

            <div>
                <label class="block text-xl font-semibold">Tanggal SK</label>
                <input type="text" value="{{ $prodi->tanggal_sk }}" readonly
                    class="w-full p-3 border border-black rounded-lg bg-gray-100">
            </div>

            <div>
                <label class="block text-xl font-semibold">Peringkat Akreditasi</label>
                <input type="text" value="{{ $prodi->peringkat_akreditasi }}" readonly
                    class="w-full p-3 border border-black rounded-lg bg-gray-100">
            </div>

            <div>
                <label class="block text-xl font-semibold">Nomor SK BAN-PT</label>
                <input type="text" value="{{ $prodi->nomor_sk_banpt }}" readonly
                    class="w-full p-3 border border-black rounded-lg bg-gray-100">
            </div>

            <div>
                <label class="block text-xl font-semibold">Jenjang Pendidikan</label>
                <input type="text" value="{{ $prodi->jenjang_pendidikan }}" readonly
                    class="w-full p-3 border border-black rounded-lg bg-gray-100">
            </div>

            <div>
                <label class="block text-xl font-semibold">Gelar Lulusan</label>
                <input type="text" value="{{ $prodi->gelar_lulusan }}" readonly
                    class="w-full p-3 border border-black rounded-lg bg-gray-100">
            </div>

            <div>
                <label class="block text-xl font-semibold">Telepon</label>
                <input type="text" value="{{ $prodi->telepon_prodi }}" readonly
                    class="w-full p-3 border border-black rounded-lg bg-gray-100">
            </div>

            <div>
                <label class="block text-xl font-semibold">Faksimili</label>
                <input type="text" value="{{ $prodi->faksimili_prodi }}" readonly
                    class="w-full p-3 border border-black rounded-lg bg-gray-100">
            </div>

            <div>
                <label class="block text-xl font-semibold">Website</label>
                <input type="text" value="{{ $prodi->website_prodi }}" readonly
                    class="w-full p-3 border border-black rounded-lg bg-gray-100">
            </div>

            <div>
                <label class="block text-xl font-semibold">Email</label>
                <input type="text" value="{{ $prodi->email_prodi }}" readonly
                    class="w-full p-3 border border-black rounded-lg bg-gray-100">
            </div>
        </div>

        <div class="mt-6 text-left py-5">
            <a href="{{ route('admin.prodi.index') }}" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-700">
=======
<div class="mx-20">
    <h2 class="font-extrabold text-4xl mb-6 text-center">Detail Prodi</h2>
    <hr class="w-full border border-black mb-4">

    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 pt-4">
            <!-- Kolom Kiri dan Kanan -->
            <div>
                <label class="block text-lg font-semibold text-gray-700">Kode Prodi</label>
                <input type="text" value="{{ $prodi->kode_prodi }}" readonly
                    class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100">
            </div>

            <div>
                <label class="block text-lg font-semibold text-gray-700">Nama Jurusan</label>
                <input type="text" value="{{ $prodi->jurusan->nama_jurusan }}" readonly
                    class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100">
            </div>

            <div>
                <label class="block text-lg font-semibold text-gray-700">Nama Prodi</label>
                <input type="text" value="{{ $prodi->nama_prodi }}" readonly
                    class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100">
            </div>

            <div>
                <label class="block text-lg font-semibold text-gray-700">PT Prodi</label>
                <input type="text" value="{{ $prodi->pt_prodi }}" readonly
                    class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100">
            </div>

            <div>
                <label class="block text-lg font-semibold text-gray-700">Tanggal Berdiri Prodi</label>
                <input type="text" value="{{ $prodi->tgl_berdiri_prodi }}" readonly
                    class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100">
            </div>

            <div>
                <label class="block text-lg font-semibold text-gray-700">Penyelenggaraan Prodi</label>
                <input type="text" value="{{ $prodi->penyelenggaraan_prodi }}" readonly
                    class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100">
            </div>

            <div>
                <label class="block text-lg font-semibold text-gray-700">Nomor SK Prodi</label>
                <input type="text" value="{{ $prodi->nomor_sk }}" readonly
                    class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100">
            </div>

            <div>
                <label class="block text-lg font-semibold text-gray-700">Tanggal SK Prodi</label>
                <input type="text" value="{{ $prodi->tanggal_sk }}" readonly
                    class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100">
            </div>

            <div>
                <label class="block text-lg font-semibold text-gray-700">Peringkat Akreditasi</label>
                <input type="text" value="{{ $prodi->peringkat_akreditasi }}" readonly
                    class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100">
            </div>

            <div>
                <label class="block text-lg font-semibold text-gray-700">Nomor SK BAN-PT</label>
                <input type="text" value="{{ $prodi->nomor_sk_banpt }}" readonly
                    class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100">
            </div>

            <div>
                <label class="block text-lg font-semibold text-gray-700">Jenjang Pendidikan</label>
                <input type="text" value="{{ $prodi->jenjang_pendidikan }}" readonly
                    class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100">
            </div>

            <div>
                <label class="block text-lg font-semibold text-gray-700">Gelar Lulusan</label>
                <input type="text" value="{{ $prodi->gelar_lulusan }}" readonly
                    class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100">
            </div>

            <div>
                <label class="block text-lg font-semibold text-gray-700">Telepon Prodi</label>
                <input type="text" value="{{ $prodi->telepon_prodi }}" readonly
                    class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100">
            </div>

            <div>
                <label class="block text-lg font-semibold text-gray-700">Faksimili Prodi</label>
                <input type="text" value="{{ $prodi->faksimili_prodi }}" readonly
                    class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100">
            </div>

            <div>
                <label class="block text-lg font-semibold text-gray-700">Website Prodi</label>
                <input type="text" value="{{ $prodi->website_prodi }}" readonly
                    class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100">
            </div>

            <div>
                <label class="block text-lg font-semibold text-gray-700">Email Prodi</label>
                <input type="text" value="{{ $prodi->email_prodi }}" readonly
                    class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100">
            </div>
        </div>

        <!-- Tombol Edit dan Hapus -->
        <div class="flex justify-end items-end">
            <div class="flex items-end space-x-4 pt-10">
                <a href="{{ route('admin.prodi.edit', $prodi->kode_prodi) }}" 
                   class="px-5 py-2 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold rounded-lg transition duration-200">
                    Edit
                </a>
                <form action="{{ route('admin.prodi.destroy', $prodi->kode_prodi) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="px-4 py-2 bg-red-600 hover:bg-red-800 text-white font-semibold rounded-lg transition duration-200"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                        Hapus
                    </button>
                </form>
            </div>
        </div>

        <!-- Tombol Kembali -->
        <div class="flex justify-start pt-6">
            <a href="{{ route('admin.prodi.index') }}" 
               class="px-6 py-2 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg transition duration-200">
>>>>>>> f29bc42dcb447412a22f2346a79a04e7b4bbe78d
                Kembali
            </a>
        </div>
    </div>
<<<<<<< HEAD
=======
</div>
>>>>>>> f29bc42dcb447412a22f2346a79a04e7b4bbe78d
@endsection
