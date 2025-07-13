@extends('layouts.app')

@section('content')
    <div class="mx-20 mt-6">
        <h2 class="font-extrabold text-3xl mb-5 text-center">Edit Visi & Misi</h2>
        <hr class="border-t-2 md:border-t-4 border-black my-3 md:my-4 mx-auto">

        <div class="bg-white px-6 pb-6 pt-2 rounded-lg shadow-md">

            @if ($errors->any())
                <div style="color: red;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.visimisi.update', $visiMisi->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Nama Jurusan -->
                <div>
                    <label for="visi" class="block text-lg font-semibold mb-2 text-gray-700">Visi</label>
                    <input type="text" id="visi" name="visi"
                        value="{{ old('visi', $visiMisi->visi) }}"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]"
                        required>
                </div>

                <!-- Nama Jurusan -->
                <div>
                    <label for="misi" class="block text-lg font-semibold mb-2 text-gray-700">Misi</label>
                    <input type="text" id="misi" name="misi"
                        value="{{ old('misi', $visiMisi->misi) }}"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]"
                        required>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-end space-x-5 pt-6">
                    <a href="{{ route('admin.visi_misi.index') }}"
                        class="px-6 py-2 bg-blue-600 hover:bg-blue-900 text-white font-semibold rounded-lg transition duration-200">
                        Kembali
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-green-600 hover:bg-green-800 text-white font-semibold rounded-lg transition duration-200">
                        Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection
