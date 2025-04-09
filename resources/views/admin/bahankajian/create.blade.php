@extends("layouts.app")

@section("content")

<div class="mr-20 ml-20">
<h2 class="text-4xl text-center font-extrabold mb-4">Tambah Bahan Kajian</h2>
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

<form action="{{ route('admin.bahankajian.store') }}" method="POST">
    @csrf
    <label for="kode_bk">Kode Bahan Kajian:</label>
    <input id="kode_bk" type="text" name="kode_bk" class="border border-black p-3 w-full mt-1 mb-3 rounded-lg" required>
    <br>

    <label for="nama_bk">Nama Bahan Kajian:</label>
    <input id="nama_bk" type="text" name="nama_bk" class="border border-black p-3 w-full mt-1 mb-3 rounded-lg" required>
    <br>

    <label for="deskripsi_bk">Deskripsi Bahan Kajian:</label>
    <input id="deskripsi_bk" type="text" name="deskripsi_bk" class="border border-black p-3 w-full mt-1 mb-3 rounded-lg" required>
    <br>

    <label for="referensi_bk">Referensi Bahan Kajian:</label>
    <input id="referensi_bk" type="text" name="referensi_bk" class="border border-black p-3 w-full mt-1 mb-3 rounded-lg" required>
    <br>

    <label for="status_bk">Status BK</label>
    <select id="status_bk" name="status_bk" class="border border-black p-3 w-full mt-1 mb-3 rounded-lg" required>
        <option value="" selected disabled>Pilih Status BK</option>
        <option value="core">Core</option>
        <option value="elective">Elective</option>
    </select>

    <label for="knowledge_area">knowledge Area Bahan Kajian:</label>
    <input id="knowledge_area" type="text" name="knowledge_area" class="border border-black p-3 w-full mt-1 mb-3 rounded-lg" required>
    <br>

    <label for="max_bk">Max Bahan Kajian:</label>
    <input id="max_bk" type="number" name="max_bk" class="border border-black p-3 w-full mt-1 mb-3 rounded-lg" required>
    <br>

    <label for="min_bk">Min Bahan Kajian:</label>
    <input id="min_bk" type="number" name="min_bk" class="border border-black p-3 w-full mt-1 mb-3 rounded-lg" required>
    <br>

    <button type="submit" class="btn btn-primary bg-green-400 hover:bg-green-800 px-5 py-2 rounded-lg">Simpan</button>
    <a href="{{ route('admin.bahankajian.index') }}" class="bg-blue-400 hover:bg-blue-800 rounded-lg px-5 py-2">Kembali</a>
</form>
</div>
@endsection