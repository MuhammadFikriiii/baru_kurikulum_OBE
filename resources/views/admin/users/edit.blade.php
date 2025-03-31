@extends('layouts.app')

@section('title', 'Edit Pengguna')

@section('content')
    <div class="w-full bg-white container mr-20 ml-20">
        <h1 class="font-extrabold text-4xl mb-6 text-center">Edit Pengguna</h1>
        <hr class="border border-black mb-4">

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4 w-full">
                <label for="name" class="block text-2xl">Nama</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                    class="mt-1 w-full p-3 border border-black rounded-lg">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="text-2xl">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                    class="mt-1 w-full p-3 border border-black rounded-l">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="text-2xl">Password (Opsional)</label>
                <input type="password" id="password" name="password"
                    class="mt-1 w-full p-3 border border-black rounded-l">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-red-500 text-sm mt-1">*Kosongkan jika tidak ingin mengubah password.*</p>
            </div>

            <div class="mb-4">
                <label for="role" class="block text-gray-700 font-medium">Role</label>
                <select id="role" name="role"
                    class="mt-1 w-full p-3 border border-black rounded-l">
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="wadir1" {{ $user->role === 'wadir1' ? 'selected' : '' }}>Wadir 1</option>
                    <option value="kaprodi" {{ $user->role === 'kaprodi' ? 'selected' : '' }}>Kaprodi</option>
                    <option value="tim" {{ $user->role === 'tim' ? 'selected' : '' }}>Tim</option>
                </select>
                @error('role')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol Simpan --}}
            <div class="flex">
                <a href="{{ route('admin.users.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
                    Batal
                </a>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection