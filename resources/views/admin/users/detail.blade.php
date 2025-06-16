@extends('layouts.app')

@section('content')
<div class="mx-20">
    <h2 class="font-extrabold text-4xl mb-6 text-center">Detail User</h2>
    <hr class="w-full border border-black mb-4">
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-6">
        <!-- Kolom Pertama -->
        <div class="space-y-4">
            <!-- Nama -->
            <div>
                <label for="name" class="block text-lg font-semibold mb-2 text-gray-700">Nama</label>
                <input type="text" id="name" name="name" value="{{ $user->name }}" readonly
                    class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 focus:outline-none">
            </div>
    
            <!-- Email -->
            <div>
                <label for="email" class="block text-lg font-semibold mb-2 text-gray-700">Email</label>
                <input type="text" id="email" name="email" value="{{ $user->email }}" readonly
                    class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 focus:outline-none">
            </div>

             <!-- Role -->
             <div>
                <label for="role" class="block text-lg font-semibold mb-2 text-gray-700">Role</label>
                <input type="text" id="role" name="role" value="{{ $user->role }}" readonly
                    class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 focus:outline-none">
            </div>
        </div>
    
        <!-- Kolom Kedua -->
        <div class="space-y-4">
            <!-- Prodi -->
            <div>
                <label for="prodi" class="block text-lg font-semibold mb-2 text-gray-700">Prodi</label>
                <input type="text" id="prodi" name="prodi" value="{{ $user->prodi->nama_prodi ?? '' }}" readonly
                    class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 focus:outline-none">
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-lg font-semibold mb-2 text-gray-700">Status</label>
                <input type="text" id="status" name="status" value="{{ $user->status }}" readonly
                    class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 focus:outline-none">
            </div>
        </div>
    </div>

    <!-- Tombol Aksi -->
    <div class="flex justify-start pt-6">
        <a href="{{ route('admin.users.index') }}" 
           class="px-6 py-2 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg transition duration-200">
            Kembali
        </a>
    </div>
</div>
@endsection