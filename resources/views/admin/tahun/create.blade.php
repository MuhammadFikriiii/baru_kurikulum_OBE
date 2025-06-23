@extends('layouts.app')

@section('content')
<div class="mr-20 ml-20">
    <h2 class="text-4xl font-extrabold mb-4 text-center">Tambah Tahun Ajaran</h2>
    <hr class="w-full border border-black mb-4">
    <div class="bg-white p-6 rounded-lg shadow-md">
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
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    
                <div class="space-y-4">
                    <div>
                        <label for="tahun" class="block text-xl font-semibold mb-2">Tahun Ajaran</label>
                        <input type="number" id="tahun" name="tahun" 
                               class="border border-black p-3 w-full rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Contoh: 2024/2025" required>
                    </div>
                </div>
                
        
                <div class="space-y-4">
                    <div>
                        <label for="nama_kurikulum" class="block text-xl font-semibold mb-2">Nama Kurikulum</label>
                        <input type="text" id="nama_kurikulum" name="nama_kurikulum"
                               class="border border-black p-3 w-full rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Contoh: Kurikulum OBE 2023" required>
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-5 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.tahun.index') }}" 
                   class="px-6 py-2 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg transition duration-200">
                    Kembali
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition duration-200">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection