@extends('layouts.app')

@section('content')

    <div class="ml-20 mr-20">
        <h2 class="text-4xl text-center font-extrabold mb-4">Edit Bahan Kajian</h2>
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

        <form action="{{ route('admin.bahankajian.update', $bahankajian->id_bk) }}" method="POST">

            @csrf
            @method('PUT')

            <label for="id_cpls" class="text-2xl font-semibold mb-2">Profil Lulusan Terkait:</label>
            <select id="id_cpls" name="id_cpls[]" size="2"
                class="border border-black p-3 w-full rounded-lg mt-1 mb-3 focus:outline-none focus:ring-2 focus:ring-[#5460B5] focus:bg-[#f7faff]"
                multiple required>
                @foreach ($capaianprofillulusans as $cpl)
                    <option value="{{ $cpl->id_cpl }}" @if (in_array($cpl->id_cpl, old('id_cpls', $selectedCapaianProfilLulusans ?? []))) selected @endif
                        title="{{ $cpl->kode_cpl }} - {{ $cpl->deskripsi_cpl }}">
                        {{ $cpl->kode_cpl }}: {{ $cpl->deskripsi_cpl }}
                    </option>
                @endforeach
            </select>
            <p class="italic text-red-700 mb-2">*Tekan tombol Ctrl dan klik untuk memilih lebih dari satu item.</p>
            <br>

            <label for="kode_bk">Kode Bahan Kajian:</label>
            <input type="text" name="kode_bk" id="kode_bk" value="{{ old('kode_bk', $bahankajian->kode_bk) }}"
                class="border border-black p-3 w-full mt-1 mb-3 rounded-lg" required>
            <br>

            <label for="nama_bk">Nama Bahan Kajian:</label>
            <input type="text" name="nama_bk" id="nama_bk" value="{{ old('nama_bk', $bahankajian->nama_bk) }}"
                class="border border-black p-3 w-full mt-1 mb-3 rounded-lg" required>
            <br>

            <label for="deskripsi_bk">Deskripsi Bahan Kajian:</label>
            <input type="text" name="deskripsi_bk" id="deskripsi_bk"
                value="{{ old('deskripsi_bk', $bahankajian->deskripsi_bk) }}"
                class="border border-black p-3 w-full mt-1 mb-3 rounded-lg">
            <br>

            <label for="referensi_bk">Referensi Bahan Kajian:</label>
            <input type="text" name="referensi_bk" id="referensi_bk"
                value="{{ old('referensi_bk', $bahankajian->referensi_bk) }}" required
                class="border border-black p-3 w-full mt-1 mb-3 rounded-lg">
            <br>

            <label for="status_bk">Status Bahan Kajian:</label>
            <select name="status_bk" id="status_bk" class="border border-black p-3 w-full mt-1 mb-3 rounded-lg" required>
                <option value="core" {{ $bahankajian->status_bk == 'core' ? 'selected' : '' }}>Core</option>
                <option value="elective" {{ $bahankajian->status_bk == 'elective' ? 'selected' : '' }}>Elective</option>
            </select>
            <br>

            <label for="knowledge_area">Area Pengetahuan:</label>
            <input type="text" name="knowledge_area" id="knowledge_area"
                value="{{ old('knowledge_area', $bahankajian->knowledge_area) }}" required
                class="border border-black p-3 w-full mt-1 mb-3 rounded-lg">
            <br>

            <button type="submit"
                class="btn btn-primary bg-green-400 hover:bg-green-800 px-5 py-2 rounded-lg">Simpan</button>
            <a href="{{ route('admin.bahankajian.index') }}"
                class="bg-blue-400 hover:bg-blue-800 px-5 py-2 rounded-lg">Kembali</a>
        </form>
    </div>
@endsection
