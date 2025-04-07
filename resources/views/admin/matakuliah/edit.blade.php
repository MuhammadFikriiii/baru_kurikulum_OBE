@extends('layouts.app')
@section('content')

<h1>Edit Mata Kuliah</h1>

@if ($errors->any())
     <div style="color: red;">
       <ul>
            @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route ('admin.matakuliah.update',$matakuliah->kode_mk)}}" method="POST">
    @csrf
    @method('PUT')

    <label for="kode_mk" class="text-2xl">Kode MK</label>
    <input type="text" name="kode_mk" id="kode_mk" value="{{ old ('kode_mk', $matakuliah->kode_mk)}}">
<br>
    <label for="nama_mk" class="text-2xl">Nama MK</label>
    <input type="text" name="nama_mk" id="nama_mk" value="{{ old ('nama_mk', $matakuliah->nama_mk)}}">
<br>
    <label for="jenis_mk" class="text-2xl">Jenis MK</label>
    <input type="text" name="jenis_mk" id="jenis_mk" value="{{ old ('jenis_mk', $matakuliah->jenis_mk)}}">
<br>
    <label for="sks_mk" class="text-2xl">Sks MK</label>
    <input type="number" name="sks_mk" id="sks_mk" value="{{ old ('sks_mk', $matakuliah->sks_mk)}}">
<br>
    <label for="semester_mk">
        <select name="semester_mk" id="semester_mk">
            @for ($i = 1; $i <= 8; $i++)
                <option value="{{ $i }}" {{ $matakuliah->semester_mk == $i ? 'selected' : '' }}>
                    {{ $i }}
                </option>
            @endfor
        </select>        
    </label>
    <br>
    <label for="kompetensi_mk">
        <select name="kompetensi_mk" id="kompetensi_mk">
            <option value="pendukung" {{ $matakuliah->kompetensi_mk == 'pendukung' ? 'selected' : '' }}>pendukung</option>
            <option value="utama" {{ $matakuliah->kompetensi_mk == 'utama' ? 'selected' : '' }}>utama</option>
        </select>
    </label>

    <button type="submit">simpan</button>
</form>
@endsection