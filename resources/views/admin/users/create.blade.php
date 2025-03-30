@extends('layouts.app')

@section('content')
<div class=" ml-20  mr-20 container w-full">
    <h2 class="font-extrabold text-4xl mb-6">Tambah User</h2>
    <hr class="w-full border border-black mb-4">
<div class="">
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="text-2xl">Nama</label>
            <input type="text" class="mt-1 w-full p-3 border border-black rounded-lg focus:ring-blue-500 focus:border-blue-500" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="text-2xl">Email</label>
            <input type="email" class="mt-1 w-full p-3 border border-black rounded-lg focus:ring-blue-500 focus:border-blue-500" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="text-2xl">Password</label>
            <input type="password" class="mt-1 w-full p-3 border border-black rounded-lg focus:ring-blue-500 focus:border-blue-500" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="role" class="block font-medium mb-2 text-2xl">Role</label>
            <select id="role" name="role" required
                class="w-full p-3 border border-black rounded-lg focus:ring-blue-500 focus:border-blue-500">
                <option value="admin">Admin</option>
                <option value="wadir1">Wadir 1</option>
                <option value="kaprodi">Kaprodi</option>
                <option value="tim">Tim</option>
            </select>
        </div>        
        <button type="submit" class="btn btn-primary bg-green-400 hover:bg-green-800 mt-3 px-5 py-2 rounded-lg">Simpan</button>
    </form>
</div>
</div>
@endsection