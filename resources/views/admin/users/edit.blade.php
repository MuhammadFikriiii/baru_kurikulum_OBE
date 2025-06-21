@extends('layouts.app')

@section('title', 'Edit Pengguna')

@section('content')
    <div class="mx-20">
        <h2 class="mb-6 text-4xl font-extrabold text-center">Edit User</h2>
        <hr class="border border-black mb-4">

<div class="bg-white p-6 rounded-lg shadow-md">

        @if ($errors->any())
            <div style="color: red;">
            <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-6">
                <!-- Kolom Pertama -->
                <div class="space-y-4">
                    <!-- Nama -->
                    <div>
                        <label for="name" class="block text-lg font-semibold mb-2 text-gray-700">Nama</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                    </div>
            
                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-lg font-semibold mb-2 text-gray-700">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                    </div>
            
                    <!-- Password -->
                    <div class="pt-6">
                        <label for="password" class="block text-lg font-semibold mb-2 text-gray-700">Password (Opsional)</label>
                        <input type="password" id="password" name="password"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                        <p class="mt-2 text-sm text-gray-500 italic">*Kosongkan jika tidak ingin mengubah password*</p>
                    </div>
                </div>
            
                <!-- Kolom Kedua -->
                <div class="space-y-4">
                    <!-- Role -->
                    <div>
                        <label for="role" class="block text-lg font-semibold mb-2 text-gray-700">Role</label>
                        <select id="role" name="role"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="wadir1" {{ $user->role === 'wadir1' ? 'selected' : '' }}>Wadir 1</option>
                            <option value="tim" {{ $user->role === 'tim' ? 'selected' : '' }}>Tim</option>
                            <option value="kaprodi" {{ $user->role === 'kaprodi' ? 'selected' : '' }}>Kaprodi</option>
                        </select>
                    </div>
            
                    <!-- Prodi -->
                    <div>
                        <label for="kode_prodi" class="block text-lg font-semibold mb-2 text-gray-700">Prodi</label>
                        <select name="kode_prodi" id="kode_prodi"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                            <option value="">Pilih Prodi</option>
                            @foreach ($prodis as $prodi)
                                <option value="{{ $prodi->kode_prodi }}" @if(old('kode_prodi', $user->kode_prodi) == $prodi->kode_prodi) selected @endif>
                                    {{ $prodi->nama_prodi }}
                                </option>
                            @endforeach
                        </select>
                        <p class="mt-2 text-sm text-gray-500 italic">*Kosongkan bila user admin/wadir1*</p>
                    </div>
            
                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-lg font-semibold mb-2 text-gray-700">Status User</label>
                        <select name="status" id="status" 
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]" required>
                            <option value="" disabled {{ old('status', $user->status) == '' ? 'selected' : '' }}>Pilih Status</option>
                            <option value="approved" {{ old('status', $user->status) == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="pending" {{ old('status', $user->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                        </select>
                    </div>
                </div>
            </div>
        
            <!-- Tombol Aksi -->
   
            <div class="flex justify-end space-x-5 mt-[50px]">
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