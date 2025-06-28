@extends('layouts.app')

@section('content')

<div class="mx-20 mt-6">
    <h2 class="text-3xl font-extrabold text-center mb-4">Edit Bahan Kajian</h2>
    <hr class="border-t-2 md:border-t-4 border-black my-3 md:my-4 mx-auto">

    @if ($errors->any())
        <div class="text-red-600 mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.bahankajian.update', $bahankajian->id_bk) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-white p-6 rounded-lg shadow-md">

            <!-- CPL Terkait -->
            <div class="md:col-span-2">
                <label for="id_cpls" class="block text-xl font-semibold mb-2">Profil Lulusan Terkait:</label>
                <select id="id_cpls" name="id_cpls[]" size="4"
                    class="border border-black p-3 w-full rounded-lg focus:outline-none focus:ring-2 focus:ring-[#5460B5] focus:bg-[#f7faff]"
                    multiple required>
                    @foreach ($capaianprofillulusans as $cpl)
                        <option value="{{ $cpl->id_cpl }}"
                            @if (in_array($cpl->id_cpl, old('id_cpls', $selectedCapaianProfilLulusans ?? []))) selected @endif
                            title="{{ $cpl->tahun }}: {{ $cpl->nama_prodi }}: {{ $cpl->kode_cpl }}: {{ $cpl->deskripsi_cpl }}">
                            {{ $cpl->tahun }}: {{ $cpl->nama_prodi }}: {{ $cpl->kode_cpl }}: {{ $cpl->deskripsi_cpl }}
                        </option>
                    @endforeach
                </select>
                <p class="italic text-red-700 mt-1">*Tahan tombol Ctrl atau klik untuk memilih lebih dari satu item.</p>
            </div>

            <!-- Kode BK -->
            <div>
                <label for="kode_bk" class="block text-xl font-semibold">Kode BK</label>
                <input type="text" name="kode_bk" id="kode_bk"
                    value="{{ old('kode_bk', $bahankajian->kode_bk) }}"
                    class="w-full p-3 border border-black rounded-lg" required>
            </div>

            <!-- Nama BK -->
            <div>
                <label for="nama_bk" class="block text-xl font-semibold">Nama BK</label>
                <input type="text" name="nama_bk" id="nama_bk"
                    value="{{ old('nama_bk', $bahankajian->nama_bk) }}"
                    class="w-full p-3 border border-black rounded-lg" required>
            </div>

            <!-- Referensi BK -->
            <div>
                <label for="referensi_bk" class="block text-xl font-semibold">Referensi BK</label>
                <input type="text" name="referensi_bk" id="referensi_bk"
                    value="{{ old('referensi_bk', $bahankajian->referensi_bk) }}"
                    class="w-full p-3 border border-black rounded-lg" required>
            </div>

            <!-- Status BK -->
            <div>
                <label for="status_bk" class="block text-xl font-semibold">Status Bahan Kajian</label>
                <select name="status_bk" id="status_bk"
                    class="w-full p-3 border border-black rounded-lg" required>
                    <option value="" disabled>Pilih Status BK</option>
                    <option value="core" {{ old('status_bk', $bahankajian->status_bk) == 'core' ? 'selected' : '' }}>Core</option>
                    <option value="elective" {{ old('status_bk', $bahankajian->status_bk) == 'elective' ? 'selected' : '' }}>Elective</option>
                </select>
            </div>

            <!-- Deskripsi BK & Knowledge Area -->
            <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="deskripsi_bk" class="block text-xl font-semibold">Deskripsi BK</label>
                    <textarea name="deskripsi_bk" id="deskripsi_bk"
                        class="w-full p-3 border border-black rounded-lg h-32 resize-none">{{ old('deskripsi_bk', $bahankajian->deskripsi_bk) }}</textarea>
                </div>

                <div>
                    <label for="knowledge_area" class="block text-xl font-semibold">Knowledge Area</label>
                    <textarea name="knowledge_area" id="knowledge_area"
                        class="w-full p-3 border border-black rounded-lg h-32 resize-none">{{ old('knowledge_area', $bahankajian->knowledge_area) }}</textarea>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="md:col-span-2 flex justify-end items-end pt-6 space-x-4">
                <a href="{{ route('admin.bahankajian.index') }}"
                   class="px-6 py-2 bg-blue-600 hover:bg-blue-900 text-white font-semibold rounded-lg transition duration-200">
                    Kembali
                </a>
                <button type="submit"
                    class="px-6 py-2 bg-green-600 hover:bg-green-800 text-white font-semibold rounded-lg transition duration-200">
                    Simpan
                </button>
            </div>
        </div>
    </form>
</div>

@endsection
