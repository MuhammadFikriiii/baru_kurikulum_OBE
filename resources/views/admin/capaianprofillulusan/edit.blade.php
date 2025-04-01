@extends('layouts.app')

@section('content')
<h2>Edit Profil Lulusan</h2>

<form action="{{ route('admin.capaianprofillulusan.update', $capaianprofillulusan->kode_cpl) }}" method="POST">
    
    @csrf
    @method('PUT')

    <label for="kode_cpl">Kode Capaian Profil Lulusan:</label>
    <input type="text" name="kode_cpl" id="kode_cpl" value="{{ old('kode_cpl', $capaianprofillulusan->kode_cpl) }}" required>
    <br>

    <label for="deskripsi_cpl">Deskripsi Capaian Profil Lulusan:</label>
    <input type="text" name="deskripsi_cpl" id="deskripsi_cpl" value="{{ old('deskripsi_cpl', $capaianprofillulusan->deskripsi_cpl) }}" required>
    <br>

    <label for="status_cpl">Status CPL:</label>
    <select name="status_cpl" id="status_cpl" required>
        <option value="Kompetensi Utama Bidang" {{ $capaianprofillulusan->status_cpl == "Kompetensi Utama Bidang" ? 'selected' : '' }}>Kompetensi Utama Bidang</option>
        <option value="Kompetensi Tambahan" {{ $capaianprofillulusan->status_cpl == "Kompetensi Tambahan" ? 'selected' : '' }}>Kompetensi Tambahan</option>
    </select>
    <br>
    <button type="submit">Update</button>
</form>

<a href="{{ route('admin.capaianprofillulusan.index') }}">Kembali</a>
@endsection