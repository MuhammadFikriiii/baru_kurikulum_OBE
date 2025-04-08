@extends('layouts.app')

@section('content')

<h2>Tambah Profil Lulusan</h2>

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
<label>Kode PL:</label>
<input type="text" name="kode_pl" class="mt-1 w-full p-3 border border-black rounded-lg" required>
<br>

<label for="kode_prodi" class="mb-3">kode prodi</label>
<select name="kode_prodi" class="mt-1 w-full p-3 border border-black rounded-lg" required>
    @foreach($prodis as $prodi)
        <option value="" class="placeholder" selected disabled>Pilih Prodi</option>
        <option value="{{ $prodi->kode_prodi }}">{{ $prodi->nama_prodi }}</option>
    @endforeach
</select>
<br>

<label>Deskripsi:</label>
<input name="deskripsi_pl" class="mt-1 w-full p-3 border border-black rounded-lg" required></input>
<br>

<label>Profesi:</label>
<input name="profesi_pl" class="mt-1 w-full p-3 border border-black rounded-lg" required></input>
<br>

<label>Unsur PL:</label>
<select name="unsur_pl" class="mt-1 w-full p-3 border border-black roubded rounded-lg" required>
    <option value="" selected disabled>pilih unsur</option>
    <option value="Pengetahuan">Pengetahuan</option>
    <option value="Keterampilan Khusus">Keterampilan Khusus</option>
    <option value="Sikap dan Keterampilan Umum">Sikap dan Keterampilan Umum</option>
</select>
<br>

<label>Keterangan:</label>
<select name="keterangan_pl" class="mt-1 w-full p-3 border border-black rounded-lg" required>
    <option value=""selected disabled>pilih keterangan</option>
    <option value="Kompetensi Utama Bidang">Kompetensi Utama Bidang</option>
    <option value="Kompetensi Utama">Kompetensi Utama</option>
    <option value="Kompetensi Tambahan">Kompetensi Tambahan</option>
</select>
<br>

<label>Sumber:</label>
<input name="sumber_pl" class="mt-1 w-full p-3 border border-black rounded-lg" required></input>
<br>

<button type="submit" class="btn btn-primary bg-green-400 hover:bg-green-800 mt-3 px-5 py-2 rounded-lg">Simpan</button>
<a href="{{ route('admin.profillulusan.index') }}" class="bg-blue-400 hoer:bg-blue-800 mt-3 px-5 py-2 rounded-lg">kembali</a>
</form>
@endsection