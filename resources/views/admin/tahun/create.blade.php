@extends('layouts.app')

@section('content')
    <div class="mx-20 mt-6">
        <h2 class="font-extrabold text-3xl mb-5 text-center">Tambah Tahun Kurikulum</h2>
        <hr class="border-t-2 md:border-t-4 border-black my-3 md:my-4 mx-auto">
        <div class="bg-white px-6 pb-6  rounded-lg shadow-md">
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.tahun.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-6">

                    <div class="space-y-4">
                        <div>
                            <label for="tahun" class="block text-xl font-semibold mb-2">Tahun Ajaran</label>
                            <input type="number" id="tahun" name="tahun"
                                class="w-full p-3 border border-black rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]"
                                placeholder="Contoh: 2024" required>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label for="nama_kurikulum" class="block text-xl font-semibold mb-2">Nama Kurikulum</label>
                            <input type="text" id="nama_kurikulum" name="nama_kurikulum"
                                class="w-full p-3 border border-black rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]"
                                placeholder="Contoh: Kurikulum OBE 2023" required>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-5 pt-6">
                    <a href="{{ route('admin.tahun.index') }}"
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