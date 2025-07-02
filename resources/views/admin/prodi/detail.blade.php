@extends('layouts.app')


@section('content')

<div class="mx-20 mt-6">
    <h2 class="font-extrabold text-3xl mb-5 text-center">Detail Prodi</h2>
    <hr class="border-t-2 md:border-t-4 border-black my-3 md:my-4 mx-auto">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-5 bg-white p-6 rounded-lg shadow-md">
        <!-- Kolom Pertama -->
        <div class="space-y-4">
            <div>
                <label class="block text-lg font-semibold text-gray-700">Kode Prodi</label>
                <input type="text" value="{{ $prodi->kode_prodi }}" readonly
                    class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 focus:outline-none">
            </div>

            <div>
                <label class="block text-lg font-semibold text-gray-700">Nama Jurusan</label>
                <input type="text" value="{{ $prodi->jurusan->nama_jurusan }}" readonly
                    class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 focus:outline-none">
            </div>

            <div>
                <label class="block text-lg font-semibold text-gray-700">Nama Prodi</label>
                <input type="text" value="{{ $prodi->nama_prodi }}" readonly
                    class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 focus:outline-none">
            </div>

            <div>
                <label class="block text-lg font-semibold text-gray-700">Tanggal Berdiri</label>
                <input type="text" value="{{ $prodi->tgl_berdiri_prodi }}" readonly
                    class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 focus:outline-none">
            </div>

            <div>
                <label class="block text-lg font-semibold text-gray-700">Tanggal Penyelenggaraan</label>
                <input type="text" value="{{ $prodi->penyelenggaraan_prodi }}" readonly
                    class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 focus:outline-none">
            </div>

            <div>
                <label class="block text-lg font-semibold text-gray-700">Nomor SK</label>
                <input type="text" value="{{ $prodi->nomor_sk }}" readonly
                    class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 focus:outline-none">
            </div>

            <div>
                <label class="block text-lg font-semibold text-gray-700">Tanggal SK</label>
                <input type="text" value="{{ $prodi->tanggal_sk }}" readonly
                    class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 focus:outline-none">
            </div>
        </div>

        <!-- Kolom Kedua -->
        <div class="space-y-4">
            <div>
                <label class="block text-lg font-semibold text-gray-700">Peringkat Akreditasi</label>
                <input type="text" value="{{ $prodi->peringkat_akreditasi }}" readonly
                    class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 focus:outline-none">
            </div>

            <div>
                <label class="block text-lg font-semibold text-gray-700">Nomor SK BAN-PT</label>
                <input type="text" value="{{ $prodi->nomor_sk_banpt }}" readonly
                    class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 focus:outline-none">
            </div>

            <div>
                <label class="block text-lg font-semibold text-gray-700">Jenjang Pendidikan</label>
                <input type="text" value="{{ $prodi->jenjang_pendidikan }}" readonly
                    class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 focus:outline-none">
            </div>

            <div>
                <label class="block text-lg font-semibold text-gray-700">Gelar Lulusan</label>
                <input type="text" value="{{ $prodi->gelar_lulusan }}" readonly
                    class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 focus:outline-none">
            </div>

            <div>
                <label class="block text-lg font-semibold text-gray-700">Telepon</label>
                <input type="text" value="{{ $prodi->telepon_prodi }}" readonly
                    class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 focus:outline-none">
            </div>


            <div>
                <label class="block text-lg font-semibold text-gray-700">Website</label>
                <input type="text" value="{{ $prodi->website_prodi }}" readonly
                    class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 focus:outline-none">
            </div>

            <div>
                <label class="block text-lg font-semibold text-gray-700">Email</label>
                <input type="text" value="{{ $prodi->email_prodi }}" readonly
                    class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 focus:outline-none">
            </div>

            
        </div>
    </div>

    <!-- Tombol Kembali -->
    <div class="flex justify-start pt-6">
        <a href="{{ route('admin.prodi.index') }}" 
           class="px-6 py-2 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg transition duration-200">
            Kembali
        </a>
    </div>
</div>
@endsection
