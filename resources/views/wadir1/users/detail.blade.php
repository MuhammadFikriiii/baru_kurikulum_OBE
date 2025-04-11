@extends('layouts.wadir1.app')

@section('content')
<div class="mr-20 ml-20">
    <h2 class="text-4xl font-extrabold text-center mb-4">Detail User</h2>
    <hr class="w-full border border-black mb-4">

    <label for="name" class="block text-xl font-semibold">Nama</label>
    <input type="text" name="name" id="name" value="{{ $user->name }}" readonly
        class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">

    <label for="email" class="block text-xl font-semibold">Email</label>
    <input type="text" name="email" id="email" value="{{ $user->email }}" readonly
        class="w-full p-3 border border-black rounded-lg mb-4 bg-gray-100">

    <label for="role" class="block text-xl font-semibold">Role</label>
    <input type="text" name="role" id="role" value="{{ $user->role }}" readonly
        class="w-full p-3 border border-black rounded-lg mb-8 bg-gray-100">

    <a href="{{ route('wadir1.users.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
        Kembali
    </a>
</div>
@endsection