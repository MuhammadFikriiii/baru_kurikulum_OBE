@extends('layouts.app')

@section('content')
    <div class="mr-20 ml-20">

        <h2 class="text-4xl font-extrabold mb-4 text-center">Edit Tahun Ajaran</h2>
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

        <form action="{{ route('admin.tahun.update', $tahun->id_tahun) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="tahun" class="text-xl font-semibold mb-2">Tahun Ajaran</label>
            <input type="number" id="tahun" name="tahun" class="border border-black p-3 w-full rounded-lg mt-1 mb-3"
                placeholder="Contoh: 2024/2025" value="{{ old('tahun', $tahun->tahun) }}" required>

            <label for="nama_kurikulum" class="text-xl font-semibold mb-2">Nama Kurikulum</label>
            <input type="text" id="nama_kurikulum" name="nama_kurikulum"
                class="border border-black p-3 w-full rounded-lg mt-1 mb-3" placeholder="Contoh: Kurikulum OBE 2023"
                value="{{ old('nama_kurikulum', $tahun->nama_kurikulum) }}" required>

            <div class="flex justify-end space-x-5 mt-[50px]">
                <a href="{{ route('admin.tahun.index') }}"
                    class="px-6 py-2 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg transition duration-200">
                    Kembali
                </a>
                <button type="submit"
                    class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition duration-200">
                    Update
                </button>
            </div>
        </form>
    </div>
@endsection
