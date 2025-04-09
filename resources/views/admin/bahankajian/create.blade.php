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
    <input type="text" name="kode_bk" class="border border-black p-3 w-full mt-1 mb-3 rounded-lg" required>
    <br>

    <label>Nama Bahan Kajian:</label>
    <input type="text" name="nama_bk" class="border border-black p-3 w-full mt-1 mb-3 rounded-lg" required>
    <br>

    <label>Deskripsi Bahan Kajian:</label>
    <input type="text" name="deskripsi_bk" class="border border-black p-3 w-full mt-1 mb-3 rounded-lg" required>
    <br>

    <label>Referensi Bahan Kajian:</label>
    <input type="text" name="referensi_bk" class="border border-black p-3 w-full mt-1 mb-3 rounded-lg" required>
    <br>

    <label>Status BK</label>
    <select name="status_bk" class="border border-black p-3 w-full mt-1 mb-3 rounded-lg" required>
        <option value="core">Core</option>
        <option value="elective">Elective</option>
    </select>

    <label>knowledge Area Bahan Kajian:</label>
    <input type="text" name="knowledge_area" class="border border-black p-3 w-full mt-1 mb-3 rounded-lg" required>
    <br>

    <label>Max Bahan Kajian:</label>
    <input type="int" name="max_bk" class="border border-black p-3 w-full mt-1 mb-3 rounded-lg" required>
    <br>

    <label>Min Bahan Kajian:</label>
    <input type="int" name="min_bk" class="border border-black p-3 w-full mt-1 mb-3 rounded-lg" required>
    <br>

    <button type="submit" class="btn btn-primary bg-green-400 hover:bg-green-800 px-5 py-2 rounded-lg">Simpan</button>
</form>

@endsection