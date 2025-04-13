@extends('layouts.app')

@section('content')
<div class=" ml-20  mr-20 container w-full">
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
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
            <label for="name" class="text-2xl">Nama</label>
            <input type="text" class="mt-1 w-full p-3 border border-black rounded-lg focus:ring-blue-500 focus:border-blue-500 mb-3" id="name" name="name" required>

            <label for="email" class="text-2xl">Email</label>
            <input type="email" class="mt-1 w-full p-3 border border-black rounded-lg focus:ring-blue-500 focus:border-blue-500 mb-3" id="email" name="email" required>


            <label for="password" class="text-2xl">Password</label>
            <input type="password" class="mt-1 w-full p-3 border border-black rounded-lg focus:ring-blue-500 focus:border-blue-500 mb-3" id="password" name="password" required>

            <label for="role" class=" text-2xl">Role</label>
            <select id="role" name="role" required
                class="w-full p-3 border border-black rounded-lg focus:ring-blue-500 focus:border-blue-500 mb-3">
                <option value="" selected disabled>Pilih Role</option>
                <option value="admin">Admin</option>
                <option value="wadir1">Wadir 1</option>
            </select>      
        <button type="submit" class="bg-green-400 hover:bg-green-800 mt-3 px-5 py-2 rounded-lg">Simpan</button>
        <a href="{{ route('admin.users.index') }}" class="bg-blue-400 hover:bg-blue-800 mt-3 px-5 py-2 rounded-lg">Kembali</a>
    </form>
</div>
</div>
@endsection