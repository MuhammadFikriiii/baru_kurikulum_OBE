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
                        <label for="visi" class="block text-lg font-semibold mb-2 text-gray-700">Nama Jurusan</label>
                        <input type="text" name="visi" id="visi" value="{{ $visiMisi->visi }}"
                            readonly class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 focus:outline-none">
                    </div>
                </div>

                <div class="space-y-4">
                    <!-- Nama Jurusan -->
                    <div>
                        <label for="misi" class="block text-lg font-semibold mb-2 text-gray-700">Nama Jurusan</label>
                        <input type="text" name="misi" id="misi" value="{{ $visiMisi->misi }}"
                            readonly class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 focus:outline-none">
                    </div>
                </div>

            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-start pt-6">
                <a href="{{ route('admin.visi_misi.index') }}"
                    class="px-6 py-2 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg transition duration-200">
                    Kembali
                </a>
            </div>
        </div>
    </div>
@endsection
