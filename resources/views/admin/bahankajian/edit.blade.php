@extends('layouts.app')

@section('content')

<h2>Edit Bahan Kajian</h2>

<form action="{{ route('admin.bahankajian.update', $bahankajian->kode_bk) }}" method="POST">
    
    @csrf
    @method('PUT')

    <label for="kode_bk">Kode Bahan Kajian:</label>
    <input type="text" name="kode_bk" id="kode_bk" value="{{ old('kode_bk', $bahankajian->kode_bk) }}" required>
    <br>

    <label for="nama_bk">Nama Bahan Kajian:</label>
    <input type="text" name="nama_bk" id="nama_bk" value="{{ old('nama_bk', $bahankajian->nama_bk) }}" required>
    <br>

    <label for="deskripsi_bk">Deskripsi Bahan Kajian:</label>
    <input type="text" name="deskripsi_bk" id="deskripsi_bk" value="{{ old('deskripsi_bk', $bahankajian->deskripsi_bk) }}">
    <br>

    <label for="referensi_bk">Referensi Bahan Kajian:</label>
    <input type="text" name="referensi_bk" id="referensi_bk" value="{{ old('referensi_bk', $bahankajian->referensi_bk) }}" required>
    <br>

    <label for="status_bk">Status Bahan Kajian:</label>
    <select name="status_bk" id="status_bk" required>
        <option value="core" {{ $bahankajian->status_bk == "core" ? 'selected' : '' }}>Core</option>
        <option value="elective" {{ $bahankajian->status_bk == "elective" ? 'selected' : '' }}>Elective</option>
    </select>
    <br>

    <label for="knowledge_area">Area Pengetahuan:</label>
    <input type="text" name="knowledge_area" id="knowledge_area" value="{{ old('knowledge_area', $bahankajian->knowledge_area) }}" required>
    <br>

    <label for="max_bk">Maksimal Bahan Kajian:</label>
    <input type="number" name="max_bk" id="max_bk" value="{{ old('max_bk', $bahankajian->max_bk) }}" required>
    <br>

    <label for="min_bk">Minimal Bahan Kajian:</label>
    <input type="number" name="min_bk" id="min_bk" value="{{ old('min_bk', $bahankajian->min_bk) }}" required>
    <br>
    
    <button type="submit">Update</button>

</form>

@endsection