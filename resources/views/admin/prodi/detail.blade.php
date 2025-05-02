@extends('layouts.app')

@section('content')
<div class="mr-20 ml-20">
    <h2 class="text-4xl font-extrabold text-center mb-4">Detail Prodi</h2>
    <hr class="w-full border border-black mb-4">

    <label for="prodi" class="block text-xl font-semibold">Kode Prodi</label>
    <input type="text" prodi="prodi" id="prodi" value="{{ $prodi->kode_prodi }}" readonly
        class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">

    <label for="nama_jurusan" class="block text-xl font-semibold">Nama Jurusan</label>
    <input type="text" name="nama_jurusan" id="nama_jurusan" value="{{ $prodi->jurusan->nama_jurusan }}" readonly
        class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">

    <label for="nama_prodi" class="block text-xl font-semibold">Nama Prodi</label>
    <input type="text" name="nama_prodi" id="nama_prodi" value="{{ $prodi->nama_prodi }}" readonly
        class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">

    <label for="fakultas_prodi" class="block text-xl font-semibold">Fakultas Prodi</label>
    <input type="text" name="fakultas_prodi" id="fakultas_prodi" value="{{ $prodi->fakultas_prodi }}" readonly
        class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">

    <label for="pt_prodi" class="block text-xl font-semibold">pt Prodi</label>
    <input type="text" name="pt_prodi" id="pt_prodi" value="{{ $prodi->pt_prodi }}" readonly
        class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">

    <label for="tgl_berdiri_prodi" class="block text-xl font-semibold">Tgl Berdiri Prodi</label>
    <input type="text" name="tgl_berdiri_prodi" id="tgl_berdiri_prodi" value="{{ $prodi->tgl_berdiri_prodi }}" readonly
        class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">

    <label for="penyelenggaraan_prodi" class="block text-xl font-semibold">Penyelenggaraan Prodi</label>
    <input type="text" name="penyelenggaraan_prodi" id="penyelenggaraan_prodi" value="{{ $prodi->penyelenggaraan_prodi }}" readonly
        class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">

    <label for="nomor_sk" class="block text-xl font-semibold">Nomor SK Prodi</label>
    <input type="text" name="nomor_sk" id="nomor_sk" value="{{ $prodi->nomor_sk }}" readonly
        class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">

    <label for="tanggal_sk" class="block text-xl font-semibold">tanggal SK Prodi</label>
    <input type="text" name="tanggal_sk" id="tanggal_sk" value="{{ $prodi->tanggal_sk }}" readonly
        class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">
        
    <label for="peringkat_akreditasi" class="block text-xl font-semibold">Peringkat Akreditasi</label>
    <input type="text" name="peringkat_akreditasi" id="peringkat_akreditasi" value="{{ $prodi->peringkat_akreditasi }}" readonly
        class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">

    <label for="nomor_sk_banpt" class="block text-xl font-semibold">nomor_sk_banpt</label>
    <input type="text" name="nomor_sk_banpt" id="nomor_sk_banpt" value="{{ $prodi->nomor_sk_banpt }}" readonly
        class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">

    <label for="jenjang_pendidikan" class="block text-xl font-semibold">jenjang_pendidikan</label>
    <input type="text" name="jenjang_pendidikan" id="jenjang_pendidikan" value="{{ $prodi->jenjang_pendidikan }}" readonly
        class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">

    <label for="gelar_lulusan" class="block text-xl font-semibold">gelar_lulusan</label>
    <input type="text" name="gelar_lulusan" id="gelar_lulusan" value="{{ $prodi->gelar_lulusan }}" readonly
        class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">

    <label for="alamat_prodi" class="block text-xl font-semibold">alamat_prodi</label>
    <input type="text" name="alamat_prodi" id="alamat_prodi" value="{{ $prodi->alamat_prodi }}" readonly
        class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">

    <label for="telepon_prodi" class="block text-xl font-semibold">telepon_prodi</label>
    <input type="text" name="telepon_prodi" id="telepon_prodi" value="{{ $prodi->telepon_prodi }}" readonly
        class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">

    <label for="faksimili_prodi" class="block text-xl font-semibold">faksimili_prodi</label>
    <input type="text" name="faksimili_prodi" id="faksimili_prodi" value="{{ $prodi->faksimili_prodi }}" readonly
        class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">

    <label for="website_prodi" class="block text-xl font-semibold">	website_prodi</label>
    <input type="text" name="website_prodi" id="website_prodi" value="{{ $prodi->website_prodi }}" readonly
        class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">

    <label for="email_prodi" class="block text-xl font-semibold">	email_prodi</label>
    <input type="text" name="email_prodi" id="email_prodi" value="{{ $prodi->email_prodi }}" readonly
        class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">
    <a href="{{ route('admin.prodi.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
        Kembali
    </a>
</div>
@endsection