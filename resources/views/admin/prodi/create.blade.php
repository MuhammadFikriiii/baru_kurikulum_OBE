@extends('layouts.app')

@section('content')
<div class="mx-20">
    <h2 class="font-extrabold text-4xl mb-6 text-center">Tambah Prodi</h2>
    <hr class="w-full border border-black mb-4">

    @if ($errors->any())
        <div class="text-red-600 mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.prodi.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
            <div>
                <label for="kode_jurusan" class="text-xl font-semibold">Jurusan:</label>
                <select name="kode_jurusan" id="kode_jurusan" required
                    class="w-full mt-1 p-3 border border-black rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    <option value="" selected disabled>Pilih Jurusan</option>
                    @foreach ($jurusans as $jurusan)
                        <option value="{{ $jurusan->kode_jurusan }}">{{ $jurusan->nama_jurusan }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="kode_prodi" class="text-xl font-semibold">Kode Prodi:</label>
                <input type="text" name="kode_prodi" id="kode_prodi" required
                    class="w-full mt-1 p-3 border border-black rounded-lg">
            </div>

            <div>
                <label for="nama_prodi" class="text-xl font-semibold">Nama Prodi:</label>
                <input type="text" name="nama_prodi" id="nama_prodi" required
                    class="w-full mt-1 p-3 border border-black rounded-lg">
            </div>

            <div>
                <label class="text-xl font-semibold">Fakultas Prodi:</label>
                <input type="text" name="fakultas_prodi" required class="w-full p-3 border border-black rounded-lg">
            </div>

            <div>
                <label class="text-xl font-semibold">Perguruan Tinggi:</label>
                <input type="text" name="pt_prodi" required class="w-full p-3 border border-black rounded-lg">
            </div>

            <div>
                <label class="text-xl font-semibold">Tanggal Berdiri:</label>
                <input type="date" name="tgl_berdiri_prodi" required class="w-full p-3 border border-black rounded-lg">
            </div>

            <div>
                <label class="text-xl font-semibold">Tanggal Penyelenggaraan:</label>
                <input type="date" name="penyelenggaraan_prodi" required class="w-full p-3 border border-black rounded-lg">
            </div>

            <div>
                <label class="text-xl font-semibold">Nomor SK:</label>
                <input type="text" name="nomor_sk" required class="w-full p-3 border border-black rounded-lg">
            </div>

            <div>
                <label class="text-xl font-semibold">Tanggal SK:</label>
                <input type="date" name="tanggal_sk" required class="w-full p-3 border border-black rounded-lg">
            </div>

            <div>
                <label class="text-xl font-semibold">Peringkat Akreditasi:</label>
                <input type="text" name="peringkat_akreditasi" required class="w-full p-3 border border-black rounded-lg">
            </div>

            <div>
                <label class="text-xl font-semibold">Nomor SK BAN-PT:</label>
                <input type="text" name="nomor_sk_banpt" required class="w-full p-3 border border-black rounded-lg">
            </div>

            <div>
                <label class="text-xl font-semibold">Jenjang Pendidikan:</label>
                <input type="text" name="jenjang_pendidikan" required class="w-full p-3 border border-black rounded-lg">
            </div>

            <div>
                <label class="text-xl font-semibold">Gelar/Sebutan Lulusan:</label>
                <input type="text" name="gelar_lulusan" required class="w-full p-3 border border-black rounded-lg">
            </div>

            <div class="md:col-span-2">
                <label class="text-xl font-semibold">Alamat Prodi:</label>
                <textarea name="alamat_prodi" rows="2" required class="w-full p-3 border border-black rounded-lg"></textarea>
            </div>

            <div>
                <label class="text-xl font-semibold">No. Telepon:</label>
                <input type="text" name="telepon_prodi" class="w-full p-3 border border-black rounded-lg">
            </div>

            <div>
                <label class="text-xl font-semibold">No. Faksimili:</label>
                <input type="text" name="faksimili_prodi" class="w-full p-3 border border-black rounded-lg">
            </div>

            <div>
                <label class="text-xl font-semibold">Website:</label>
                <input type="text" name="website_prodi" class="w-full p-3 border border-black rounded-lg">
            </div>

            <div>
                <label class="text-xl font-semibold">Email:</label>
                <input type="email" name="email_prodi" class="w-full p-3 border border-black rounded-lg">
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white px-6 py-2 rounded-lg">
                Simpan
            </button>
            <a href="{{ route('admin.prodi.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white px-6 py-2 rounded-lg ml-4">
                Kembali
            </a>
        </div>
    </form>
</div>
@endsection
