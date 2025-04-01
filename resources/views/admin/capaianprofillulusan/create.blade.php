@extends('layouts.app')

@section('content')
@if (session('success'))
<p style="color: green;">{{ session('success') }}</p>
@endif

<h2>Tambah Profil Lulusan</h2>

<form action="{{ route('admin.capaianprofillulusan.store') }}" method="POST">
@csrf
<label>Kode CPL:</label>
<input type="text" name="kode_cpl" required>
<br>

<label>Deskripsi CPL:</label>
<input type="text" name="deskripsi_cpl" required>
<br>

<label>Status CPL:</label>
<select name="status_cpl" required>
    <option value="Kompetensi Utama Bidang">Kompetensi Utama</option>
    <option value="Kompetensi Tambahan">Kompetensi Tambahan</option>
</select>
<br>

<button type="submit">Simpan</button>
</form>
@endsection