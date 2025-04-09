@extends('layouts.app')

@section('content')
@if (session('success'))
<p style="color: green;">{{ session('success') }}</p>
@endif

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

<form action="{{ route('admin.capaianprofillulusan.store') }}" method="POST">
@csrf
<label>Kode CPL:</label>
<input type="text" name="kode_cpl" class="border border-black p-3 w-full rounded-lg mt-1" required></input>
<br>

<label>Deskripsi CPL:</label>
<textarea type="text" name="deskripsi_cpl" class="border border-black p-3 w-full rounded-lg mt-1" required></textarea>
<br>

<label>Status CPL:</label>
<select name="status_cpl" class="border border-black p-3 w-full rounded-lg mt-1" required>
    <option value="Kompetensi Utama Bidang">Kompetensi Utama</option>
    <option value="Kompetensi Tambahan">Kompetensi Tambahan</option>
</select>
<br>

<button type="submit" class="btn btn-primary bg-green-400 hover:bg-green-800 mt-2 rounded-lg px-5 py-2">Simpan</button>
</form>
@endsection