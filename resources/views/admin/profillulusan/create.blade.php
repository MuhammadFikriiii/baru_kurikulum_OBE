@extends('layouts.app')

@section('content')
@if (session('success'))
<p style="color: green;">{{ session('success') }}</p>
@endif

<h2>Tambah Profil Lulusan</h2>

<form action="{{ route('admin.profillulusan.store') }}" method="POST">
@csrf
<label>Kode PL:</label>
<input type="text" name="kode_pl" required>
<br>

<select name="kode_prodi" required>
    @foreach($prodis as $prodi)
        <option value="{{ $prodi->kode_prodi }}">{{ $prodi->nama_prodi }}</option>
    @endforeach
</select>

<label>Deskripsi:</label>
<textarea name="deskripsi_pl" required></textarea>
<br>

<label>Profesi:</label>
<textarea name="profesi_pl" required></textarea>
<br>

<label>Unsur PL:</label>
<select name="unsur_pl" required>
    <option value="Pengetahuan">Pengetahuan</option>
    <option value="Keterampilan Khusus">Keterampilan Khusus</option>
    <option value="Sikap dan Keterampilan Umum">Sikap dan Keterampilan Umum</option>
</select>
<br>

<label>Keterangan:</label>
<select name="keterangan_pl" required>
    <option value="Kompetensi Utama Bidang">Kompetensi Utama Bidang</option>
    <option value="Kompetensi Utama">Kompetensi Utama</option>
    <option value="Kompetensi_tambahan">Kompetensi Tambahan</option>
</select>
<br>

<label>Sumber:</label>
<textarea name="sumber_pl" required></textarea>
<br>

<button type="submit">Simpan</button>
</form>
@endsection