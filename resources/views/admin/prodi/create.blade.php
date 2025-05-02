@extends('layouts.app')

@section('content')
<div class="mr-20 ml-20">
    <h2 class="font-extrabold text-4xl mb-6 text-center">Tambah Prodi</h2>
    <hr class="w-full border border-black mb-4">
    @if ($errors->any())
        <div style="color: red;">
        <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.prodi.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="kode_jurusan" class="text-2xl">Jurusan:</label>
            <select name="kode_jurusan" id="kode_jurusan" class="mt-1 w-full p-3 border border-black rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                <option value="" selected disabled>Pilih Jurusan</option>
                @foreach ($jurusans as $jurusan)
                    <option value="{{ $jurusan->kode_jurusan }}">{{ $jurusan->nama_jurusan }}</option>
                @endforeach
            </select>
            </div>

        <div class="mb-3">
        <label for="kode_prodi" class="text-2xl">Kode Prodi:</label>
        <input type="text" class="mt-1 w-full p-3 border border-black rounded-lg focus:ring-blue-500 focus:border-blue-500" name="kode_prodi" id="kode_prodi" required>
        </div>

        <div class="mb-3">
        <label for="nama_prodi" class="text-2xl">Nama Prodi:</label>
        <input type="text" class="mt-1 w-full p-3 border border-black rounded-lg focus:ring-blue-500 focus:border-blue-500" name="nama_prodi" id="nama_prodi" required>
        </div>
        <div class="mb-3">
            <label class="text-2xl">Fakultas Prodi:</label>
            <input type="text" name="fakultas_prodi" class="w-full p-3 border border-black rounded-lg" required>
        </div>

        <div class="mb-3">
            <label class="text-2xl">Perguruan Tinggi:</label>
            <input type="text" name="pt_prodi" class="w-full p-3 border border-black rounded-lg" required>
        </div>

        <div class="mb-3">
            <label class="text-2xl">Tanggal Berdiri:</label>
            <input type="date" name="tgl_berdiri_prodi" class="w-full p-3 border border-black rounded-lg" required>
        </div>

        <div class="mb-3">
            <label class="text-2xl">Tanggal Penyelenggaraan:</label>
            <input type="date" name="penyelenggaraan_prodi" class="w-full p-3 border border-black rounded-lg" required>
        </div>

        <div class="mb-3">
            <label class="text-2xl">Nomor SK:</label>
            <input type="text" name="nomor_sk" class="w-full p-3 border border-black rounded-lg" required>
        </div>

        <div class="mb-3">
            <label class="text-2xl">Tanggal SK:</label>
            <input type="date" name="tanggal_sk" class="w-full p-3 border border-black rounded-lg" required>
        </div>

        <div class="mb-3">
            <label class="text-2xl">Peringkat Akreditasi:</label>
            <input type="text" name="peringkat_akreditasi" class="w-full p-3 border border-black rounded-lg" required>
        </div>

        <div class="mb-3">
            <label class="text-2xl">Nomor SK BAN-PT:</label>
            <input type="text" name="nomor_sk_banpt" class="w-full p-3 border border-black rounded-lg" required>
        </div>

        <div class="mb-3">
            <label class="text-2xl">Jenjang Pendidikan:</label>
            <input type="text" name="jenjang_pendidikan" class="w-full p-3 border border-black rounded-lg" required>
        </div>

        <div class="mb-3">
            <label class="text-2xl">Gelar/Sebutan Lulusan:</label>
            <input type="text" name="gelar_lulusan" class="w-full p-3 border border-black rounded-lg" required>
        </div>

        <div class="mb-3">
            <label class="text-2xl">Alamat Prodi:</label>
            <textarea name="alamat_prodi" rows="2" class="w-full p-3 border border-black rounded-lg" required></textarea>
        </div>

        <div class="mb-3">
            <label class="text-2xl">No. Telepon:</label>
            <input type="text" name="telepon_prodi" class="w-full p-3 border border-black rounded-lg">
        </div>

        <div class="mb-3">
            <label class="text-2xl">No. Faksimili:</label>
            <input type="text" name="faksimili_prodi" class="w-full p-3 border border-black rounded-lg">
        </div>

        <div class="mb-3">
            <label class="text-2xl">Website:</label>
            <input type="text" name="website_prodi" class="w-full p-3 border border-black rounded-lg">
        </div>

        <div class="mb-3">
            <label class="text-2xl">Email:</label>
            <input type="email" name="email_prodi" class="w-full p-3 border border-black rounded-lg">
        </div>
        <div>
            <button type="submit" class="btn btn-primary bg-green-400 hover:bg-green-800 mt-3 px-5 py-2 rounded-lg">Simpan</button>
            <a href="{{ route('admin.prodi.index') }}" class="bg-blue-400 hover:bg-blue-800 mt-3 px-5 py-2 rounded-lg">Kembali</a>
           </div>
    </form>
</div>
@endsection