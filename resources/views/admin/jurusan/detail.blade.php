@extends('layouts.app')

@section('content')
<div class="mx-20 mt-6">
    <h2 class="font-extrabold text-3xl mb-5 text-center">Detail Jurusan</h2>
    <hr class="border-t-2 md:border-t-4 border-black my-3 md:my-4 mx-auto">

    <div class="bg-white px-6 pb-6 rounded-lg shadow-md">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-6">
            <!-- Kolom Pertama -->
            <div class="space-y-4">
                <!-- Nama Jurusan -->
                <div>
                    <label for="nama_jurusan" class="block text-lg font-semibold mb-2 text-gray-700">Nama Jurusan</label>
                    <input type="text" name="nama_jurusan" id="nama_jurusan" value="{{ $jurusan->nama_jurusan }}" readonly
                        class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 focus:outline-none">
                </div>
            </div>

            <!-- Kolom Kedua (bisa ditambahkan data lain di sini jika perlu) -->
            <div class="space-y-4">
                <!-- Kosong sementara -->
                <div class="flex justify-end items-end">
                    <div class="flex items-end space-x-4 pt-10 ">
                        <a href="{{ route('admin.jurusan.edit', $jurusan->id_jurusan) }}" 
                           class="px-5 py-2 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold rounded-lg transition duration-200">
                            Edit
                        </a>
                        <form action="{{ route('admin.jurusan.destroy', $jurusan->id_jurusan) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="px-4 py-2 bg-red-600 hover:bg-red-800 text-white font-semibold rounded-lg transition duration-200"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus catatan ini?')">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="flex justify-start pt-6">
            <a href="{{ route('admin.jurusan.index') }}" 
               class="px-6 py-2 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg transition duration-200">
                Kembali
            </a>
        </div>
    </div>
</div>
@endsection
