@extends('layouts.app')

@section('title', 'Edit Pengguna')

@section('content')
    <div class="mx-20">
        <h2 class="mb-6 text-4xl font-extrabold text-center">Edit User</h2>
        <hr class="border border-black mb-4">

        @if ($errors->any())
            <div style="color: red;">
            <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
                <label for="name" class="text-xl font-semibold">Nama</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                    class="mt-1 w-full p-3 border border-black rounded-lg mb-3">

                <label for="email" class="text-xl font-semibold">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                    class="mt-1 w-full p-3 border border-black rounded-lg mb-3">

                <label for="password" class="text-xl font-semibold">Password (Opsional)</label>
                <input type="password" id="password" name="password"
                    class="mt-1 w-full p-3 border border-black rounded-lg">
                <p class="italic text-red-500 mb-3">*Kosongkan jika tidak ingin mengubah password.*</p>

                <label for="role" class="text-xl font-semibold">Role</label>
                <select id="role" name="role"
                    class="mt-1 w-full p-3 border border-black rounded-lg mb-3">
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="wadir1" {{ $user->role === 'wadir1' ? 'selected' : '' }}>Wadir 1</option>
                    <option value="tim" {{ $user->role === 'tim' ? 'selected' : '' }}>tim</option>
                    <option value="kaprodi" {{ $user->role === 'kaprodi' ? 'selected' : '' }}>kaprodi</option>
                </select>

                <label for="kode_prodi" class="text-xl font-semibold">Prodi</label>
                <select name="kode_prodi" id="kode_prodi"
                    class="w-full p-3 border border-black rounded-lg mb">
                    <option value="">Pilih Prodi</option>
                    @foreach ($prodis as $prodi)
                        <option value="{{ $prodi->kode_prodi }}" @if(old('kode_prodi', $user->kode_prodi) == $prodi->kode_prodi) selected @endif>{{ $prodi->nama_prodi }}</option>
                    @endforeach
                </select>
                <p class="italic text-red-500 mb-3">*kosongkan bila user admin/wadir1, jika tetap dipilih prodi tetap dinull kan</p>

                <label for="status" class="text-xl font-semibold">Status User</label>
                <select name="status" id="status" class="w-full p-3 border border-black rounded-lg mb-3" required>
                    <option value="" disabled {{ old('status', $user->status) == '' ? 'selected' : '' }}>Pilih Status</option>
                    <option value="approved" {{ old('status', $user->status) == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="pending" {{ old('status', $user->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                </select>

                <button type="submit" class="bg-blue-600 px-5 py-2 rounded-lg hover:bg-blue-800 mt-4 text-white font-bold">
                    Simpan
                </button>
                <a href="{{ route('admin.users.index') }}" class="ml-2 bg-gray-600 inline-flex px-5 py-2 rounded-lg hover:bg-gray-700 mt-4 text-white font-bold">
                    Kembali
                </a>
        </form>
    </div>
@endsection