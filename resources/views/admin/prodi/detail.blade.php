@extends('layouts.app')

@section('content')
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
                Kembali
            </a>
        </div>
    </div>
@endsection
