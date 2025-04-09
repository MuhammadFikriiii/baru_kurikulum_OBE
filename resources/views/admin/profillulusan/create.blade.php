@extends('layouts.app')

@section('content')

<div class="mr-20 ml-20">
<h2 class="text-4xl font-extrabold text-center mb-4">Tambah Profil Lulusan</h2>
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

<form action="{{ route('admin.profillulusan.store') }}" method="POST">
@csrf
<label for="kode_pl" class="text-2xl">Kode PL:</label>
<input type="text" id="kode_pl" name="kode_pl" class="mt-1 w-full p-3 border border-black rounded-lg mb-3" required>
<br>

<label for="kode_prodi" class="text-2xl">kode prodi</label>
<select id="kode_prodi" name="kode_prodi" class="mt-1 w-full p-3 border border-black rounded-lg mb-3" required>
    @foreach($prodis as $prodi)
        <option value="" class="placeholder" selected disabled>Pilih Prodi</option>
        <option value="{{ $prodi->kode_prodi }}">{{ $prodi->nama_prodi }}</option>
    @endforeach
</select>
<br>

<label for="deskripsi_pl" class="text-2xl">Deskripsi:</label>
<textarea id="deskripsi_pl" name="deskripsi_pl" class="mt-1 w-full p-3 border border-black rounded-lg mb-3" required></textarea>
<br>

<label for="profesi_pl" class="text-2xl">Profesi:</label>
<textarea id="profesi_pl" name="profesi_pl" class="mt-1 w-full p-3 border border-black rounded-lg mb-3" required></textarea>
<br>

<label for="unsur_pl" class="text-2xl">Unsur PL:</label>
<select id="unsur_pl" name="unsur_pl" class="mt-1 w-full p-3 border border-black roubded rounded-lg mb-3" required>
    <option value="" selected disabled>Pilih Unsur</option>
    <option value="Pengetahuan">Pengetahuan</option>
    <option value="Keterampilan Khusus">Keterampilan Khusus</option>
    <option value="Sikap dan Keterampilan Umum">Sikap dan Keterampilan Umum</option>
</select>
<br>

<label for="keterangan_pl" class="text-2xl">Keterangan:</label>
<select id="keterangan_pl" name="keterangan_pl" class="mt-1 w-full p-3 border border-black rounded-lg mb-3" required>
    <option value=""selected disabled>Pilih Keterangan</option>
    <option value="Kompetensi Utama Bidang">Kompetensi Utama Bidang</option>
    <option value="Kompetensi Utama">Kompetensi Utama</option>
    <option value="Kompetensi Tambahan">Kompetensi Tambahan</option>
</select>
<br>

<label for="sumber_pl" class="text-2xl">Sumber:</label>
<textarea id="sumber_pl" name="sumber_pl" class="mt-1 w-full p-3 border border-black rounded-lg mb-3" required></textarea>
<br>

<button type="submit" class="btn btn-primary bg-green-400 hover:bg-green-800 mt-3 px-5 py-2 rounded-lg">Simpan</button>
<a href="{{ route('admin.profillulusan.index') }}" class="bg-blue-400 hover:bg-blue-800 mt-3 px-5 py-2 rounded-lg">kembali</a>
</form>
</div>
@endsection