@extends('layouts.app')

@section('content')
<div class="mx-20">
    <h2 class="font-extrabold text-4xl mb-6 text-center">Tambah User</h2>
    <hr class="w-full border border-black mb-4">
<div class="">
    @if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-6">
            <!-- Kolom Pertama -->
            <div class="space-y-4">
                <!-- Nama -->
                <div>
                    <label for="name" class="block text-lg font-semibold mb-2 text-gray-700">Nama</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
        
                <!-- Email -->
                <div>
                    <label for="email" class="block text-lg font-semibold mb-2 text-gray-700">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
        
                <!-- Password -->
                <div class="pt-6">
                    <label for="password" class="block text-lg font-semibold mb-2 text-gray-700">Password</label>
                    <input type="password" id="password" name="password" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                </div>
            </div>
        
            <!-- Kolom Kedua -->
            <div class="space-y-4">
                <!-- Role -->
                <div>
                    <label for="role" class="block text-lg font-semibold mb-2 text-gray-700">Role</label>
                    <select id="role" name="role" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="" disabled selected>Pilih Role</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="wadir1" {{ old('role') == 'wadir1' ? 'selected' : '' }}>Wadir 1</option>
                        <option value="tim" {{ old('role') == 'tim' ? 'selected' : '' }}>Tim</option>
                        <option value="kaprodi" {{ old('role') == 'kaprodi' ? 'selected' : '' }}>Kaprodi</option>
                    </select>
                </div>
        
                <!-- Prodi -->
                <div>
                    <label for="kode_prodi" class="block text-lg font-semibold mb-2 text-gray-700">Prodi</label>
                    <select name="kode_prodi" id="kode_prodi"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">Pilih Prodi</option>
                        @foreach ($prodis as $prodi)
                            <option value="{{ $prodi->kode_prodi }}" {{ old('kode_prodi') == $prodi->kode_prodi ? 'selected' : '' }}>
                                {{ $prodi->nama_prodi }}
                            </option>
                        @endforeach
                    </select>
                    <p class="mt-2 text-sm text-gray-500 italic">*Kosongkan bila user admin/wadir1*</p>
                </div>
        
                <!-- Status -->
                <div>
                    <label for="status" class="block text-lg font-semibold mb-2 text-gray-700">Status User</label>
                    <select name="status" id="status" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="" disabled selected>Pilih Status</option>
                        <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    </select>
                </div>
            </div>
        </div>
    
        <!-- Tombol Aksi -->
        <div class="flex justify-end space-x-5 pt-6">
            <a href="{{ route('admin.users.index') }}" 
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