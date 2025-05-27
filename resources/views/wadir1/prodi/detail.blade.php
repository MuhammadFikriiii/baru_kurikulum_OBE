@extends('layouts.wadir1.app')

@section('content')
<div class="mx-20">
    <h2 class="text-4xl font-extrabold text-center mb-4">Detail Prodi</h2>
    <hr class="w-full border border-black mb-4">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
        <div>
            <label for="prodi" class="block text-xl font-semibold">Kode Prodi</label>
            <input type="text" id="prodi" value="{{ $prodi->kode_prodi }}" readonly
                class="w-full p-3 border border-black rounded-lg bg-gray-100">
        </div>

        <div>
            <label for="nama_jurusan" class="block text-xl font-semibold">Nama Jurusan</label>
            <input type="text" id="nama_jurusan" value="{{ $prodi->jurusan->nama_jurusan }}" readonly
                class="w-full p-3 border border-black rounded-lg bg-gray-100">
        </div>

        <div>
            <label for="nama_prodi" class="block text-xl font-semibold">Nama Prodi</label>
            <input type="text" id="nama_prodi" value="{{ $prodi->nama_prodi }}" readonly
                class="w-full p-3 border border-black rounded-lg bg-gray-100">
        </div>

        <div>
            <label for="pt_prodi" class="block text-xl font-semibold">PT Prodi</label>
            <input type="text" id="pt_prodi" value="{{ $prodi->pt_prodi }}" readonly
                class="w-full p-3 border border-black rounded-lg bg-gray-100">
        </div>

        <div>
            <label for="tgl_berdiri_prodi" class="block text-xl font-semibold">Tanggal Berdiri Prodi</label>
            <input type="text" id="tgl_berdiri_prodi" value="{{ $prodi->tgl_berdiri_prodi }}" readonly
                class="w-full p-3 border border-black rounded-lg bg-gray-100">
        </div>

        <div>
            <label for="penyelenggaraan_prodi" class="block text-xl font-semibold">Penyelenggaraan Prodi</label>
            <input type="text" id="penyelenggaraan_prodi" value="{{ $prodi->penyelenggaraan_prodi }}" readonly
                class="w-full p-3 border border-black rounded-lg bg-gray-100">
        </div>

        <div>
            <label for="nomor_sk" class="block text-xl font-semibold">Nomor SK Prodi</label>
            <input type="text" id="nomor_sk" value="{{ $prodi->nomor_sk }}" readonly
                class="w-full p-3 border border-black rounded-lg bg-gray-100">
        </div>

        <div>
            <label for="tanggal_sk" class="block text-xl font-semibold">Tanggal SK Prodi</label>
            <input type="text" id="tanggal_sk" value="{{ $prodi->tanggal_sk }}" readonly
                class="w-full p-3 border border-black rounded-lg bg-gray-100">
        </div>

        <div>
            <label for="peringkat_akreditasi" class="block text-xl font-semibold">Peringkat Akreditasi</label>
            <input type="text" id="peringkat_akreditasi" value="{{ $prodi->peringkat_akreditasi }}" readonly
                class="w-full p-3 border border-black rounded-lg bg-gray-100">
        </div>

        <div>
            <label for="nomor_sk_banpt" class="block text-xl font-semibold">Nomor SK BAN-PT</label>
            <input type="text" id="nomor_sk_banpt" value="{{ $prodi->nomor_sk_banpt }}" readonly
                class="w-full p-3 border border-black rounded-lg bg-gray-100">
        </div>

        <div>
            <label for="jenjang_pendidikan" class="block text-xl font-semibold">Jenjang Pendidikan</label>
            <input type="text" id="jenjang_pendidikan" value="{{ $prodi->jenjang_pendidikan }}" readonly
                class="w-full p-3 border border-black rounded-lg bg-gray-100">
        </div>

        <div>
            <label for="gelar_lulusan" class="block text-xl font-semibold">Gelar Lulusan</label>
            <input type="text" id="gelar_lulusan" value="{{ $prodi->gelar_lulusan }}" readonly
                class="w-full p-3 border border-black rounded-lg bg-gray-100">
        </div>

        <div>
            <label for="telepon_prodi" class="block text-xl font-semibold">Telepon Prodi</label>
            <input type="text" id="telepon_prodi" value="{{ $prodi->telepon_prodi }}" readonly
                class="w-full p-3 border border-black rounded-lg bg-gray-100">
        </div>

        <div>
            <label for="faksimili_prodi" class="block text-xl font-semibold">Faksimili Prodi</label>
            <input type="text" id="faksimili_prodi" value="{{ $prodi->faksimili_prodi }}" readonly
                class="w-full p-3 border border-black rounded-lg bg-gray-100">
        </div>

        <div>
            <label for="website_prodi" class="block text-xl font-semibold">Website Prodi</label>
            <input type="text" id="website_prodi" value="{{ $prodi->website_prodi }}" readonly
                class="w-full p-3 border border-black rounded-lg bg-gray-100">
        </div>

        <div>
            <label for="email_prodi" class="block text-xl font-semibold">Email Prodi</label>
            <input type="text" id="email_prodi" value="{{ $prodi->email_prodi }}" readonly
                class="w-full p-3 border border-black rounded-lg bg-gray-100">
        </div>
    </div>

    <div class="mt-6 text-left py-5">
        <a href="{{ route('wadir1.prodi.index') }}" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-700">
            Kembali
        </a>
    </div>
</div>
@endsection
