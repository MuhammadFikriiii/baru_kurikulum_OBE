@extends("layouts.app")

@section("content")

@if ($errors->any())
    <div style="color: red;">
       <ul>
            @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.bahankajian.store') }}" method="POST">
    @csrf
    <label>Kode Bahan Kajian:</label>
    <input type="text" name="kode_bk" required>
    <br>

    <label>Nama Bahan Kajian:</label>
    <input type="text" name="nama_bk" required>
    <br>

    <label>Deskripsi Bahan Kajian:</label>
    <input type="text" name="deskripsi_bk" required>
    <br>

    <label>Referensi Bahan Kajian:</label>
    <input type="text" name="referensi_bk" required>
    <br>

    <select name="status_bk" required>
        <option value="core">Core</option>
        <option value="elective">Elective</option>
    </select>

    <label>knowledge Area Bahan Kajian:</label>
    <input type="text" name="knowledge_area" required>
    <br>

    <label>Max Bahan Kajian:</label>
    <input type="int" name="max_bk" required>
    <br>

    <label>Min Bahan Kajian:</label>
    <input type="int" name="min_bk" required>
    <br>

    <button type="submit">Simpan</button>
</form>

@endsection