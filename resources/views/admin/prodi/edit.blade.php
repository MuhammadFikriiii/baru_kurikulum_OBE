@extends('layouts.app')

@section('content')
<div class="mr-20 ml-20">
<h2 class="font-extrabold text-4xl mb-6 text-center">Edit Prodi</h2>
<hr class="border border-black mb-4">
    @if ($errors->any())
        <div style="color: red;">
        <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
<form action="{{ route('admin.prodi.update', $prodi->kode_prodi) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
    <label for="kode_jurusan" class="text-2xl">Jurusan:</label>
    <select name="kode_jurusan" id="kode_jurusan" class="mt-1 w-full p-3 border border-black rounded-lg">
        @foreach ($jurusans as $jurusan)
            <option value="{{ $jurusan->kode_jurusan }}" {{ $prodi->kode_jurusan == $jurusan->kode_jurusan ? 'selected' : '' }}>
                {{ $jurusan->nama_jurusan }}
            </option>
        @endforeach
    </select>
    </div> 

    <div class="mb-3">
    <label for="kode_prodi" class="text-2xl">Kode Prodi:</label>
    <input type="text" class="mt-1 w-full p-3 border border-black rounded-lg" name="kode_prodi" id="kode_prodi" value="{{ old('kode_prodi', $prodi->kode_prodi) }}" required>
    </div>

    <div class="mb-3">
    <label for="nama_prodi" class="text-2xl">Nama Prodi:</label>
    <input type="text" class="mt-1 w-full p-3 border border-black rounded-lg" name="nama_prodi" id="nama_prodi" value="{{ old('nama_prodi', $prodi->nama_prodi) }}" required>
    </div>

    <div class="mb-3">
        <label class="text-2xl">Fakultas Prodi:</label>
        <input type="text" name="fakultas_prodi" class="w-full p-3 border border-black rounded-lg" value="{{ old('fakultas_prodi', $prodi->fakultas_prodi) }}" required>
    </div>

    <div class="mb-3">
        <label class="text-2xl">Perguruan Tinggi:</label>
        <input type="text" name="pt_prodi" class="w-full p-3 border border-black rounded-lg" value="{{ old('pt_prodi', $prodi->pt_prodi) }}" required>
    </div>

    <div class="mb-3">
        <label class="text-2xl">Tanggal Berdiri:</label>
        <input type="date" name="tgl_berdiri_prodi" class="w-full p-3 border border-black rounded-lg" value="{{ old('tgl_berdiri_prodi', $prodi->tgl_berdiri_prodi) }}" required>
    </div>

    <div class="mb-3">
        <label class="text-2xl">Tanggal Penyelenggaraan:</label>
        <input type="date" name="penyelenggaraan_prodi" class="w-full p-3 border border-black rounded-lg" value="{{ old('penyelenggaraan_prodi', $prodi->penyelenggaraan_prodi) }}" required>
    </div>

    <div class="mb-3">
        <label class="text-2xl">Nomor SK:</label>
        <input type="text" name="nomor_sk" class="w-full p-3 border border-black rounded-lg" value="{{ old('nomor_sk', $prodi->nomor_sk) }}" required>
    </div>

    <div class="mb-3">
        <label class="text-2xl">Tanggal SK:</label>
        <input type="date" name="tanggal_sk" class="w-full p-3 border border-black rounded-lg" value="{{ old('tanggal_sk', $prodi->tanggal_sk) }}" required>
    </div>

    <div class="mb-3">
        <label class="text-2xl">Peringkat Akreditasi:</label>
        <input type="text" name="peringkat_akreditasi" class="w-full p-3 border border-black rounded-lg" value="{{ old('peringkat_akreditasi', $prodi->peringkat_akreditasi) }}" required>
    </div>

    <div class="mb-3">
        <label class="text-2xl">Nomor SK BAN-PT:</label>
        <input type="text" name="nomor_sk_banpt" class="w-full p-3 border border-black rounded-lg" value="{{ old('nomor_sk_banpt', $prodi->nomor_sk_banpt) }}" required>
    </div>

    <div class="mb-3">
        <label class="text-2xl">Jenjang Pendidikan:</label>
        <input type="text" name="jenjang_pendidikan" class="w-full p-3 border border-black rounded-lg" value="{{ old('jenjang_pendidikan', $prodi->jenjang_pendidikan) }}" required>
    </div>

    <div class="mb-3">
        <label class="text-2xl">Gelar/Sebutan Lulusan:</label>
        <input type="text" name="gelar_lulusan" class="w-full p-3 border border-black rounded-lg" value="{{ old('gelar_lulusan', $prodi->gelar_lulusan) }}" required>
    </div>

    <div class="mb-3">
        <label class="text-2xl">Alamat Prodi:</label>
        <textarea name="alamat_prodi" rows="2" class="w-full p-3 border border-black rounded-lg" required>{{ old('alamat_prodi', $prodi->alamat_prodi) }}</textarea>
    </div>

    <div class="mb-3">
        <label class="text-2xl">No. Telepon:</label>
        <input type="text" name="telepon_prodi" class="w-full p-3 border border-black rounded-lg" value="{{ old('telepon_prodi', $prodi->telepon_prodi) }}">
    </div>

    <div class="mb-3">
        <label class="text-2xl">No. Faksimili:</label>
        <input type="text" name="faksimili_prodi" class="w-full p-3 border border-black rounded-lg" value="{{ old('faksimili_prodi', $prodi->faksimili_prodi) }}">
    </div>

    <div class="mb-3">
        <label class="text-2xl">Website:</label>
        <input type="text" name="website_prodi" class="w-full p-3 border border-black rounded-lg" value="{{ old('website_prodi', $prodi->website_prodi) }}">
    </div>

    <div class="mb-3">
        <label class="text-2xl">Email:</label>
        <input type="email" name="email_prodi" class="w-full p-3 border border-black rounded-lg" value="{{ old('email_prodi', $prodi->email_prodi) }}">
    </div>
    
    <div>
        <button type="submit" class="btn btn-primary bg-green-400 hover:bg-green-800 mt-3 px-5 py-2 rounded-lg">Update</button>
        <a href="{{ route('admin.prodi.index') }}" class="bg-blue-400 hover:bg-blue-800 mt-3 px-5 py-2 rounded-lg">Kembali</a>
    </div>
@endsection