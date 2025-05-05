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
            <input type="text" class="mt-1 w-full p-3 border border-black rounded-lg focus:ring-blue-500 focus:border-blue-500 mb-3" id="name" name="name" required value="{{ old('name') }}">

            <label for="email" class="text-2xl">Email</label>
            <input type="email" class="mt-1 w-full p-3 border border-black rounded-lg focus:ring-blue-500 focus:border-blue-500 mb-3" id="email" name="email" required value="{{ old('email') }}">


            <label for="password" class="text-2xl">Password</label>
            <input type="password" class="mt-1 w-full p-3 border border-black rounded-lg focus:ring-blue-500 focus:border-blue-500 mb-3" id="password" name="password" required value="{{ old('password') }}">

            <label for="role" class="text-2xl">Role</label>
            <select name="role" id="role" class="w-full p-3 border border-black rounded-lg mb-3" required>
                <option value="" disabled selected {{ old('role') ? '' : 'selected' }}>Pilih Role</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="wadir1" {{ old('role') == 'wadir1' ? 'selected' : '' }}>Wadir 1</option>
                <option value="kaprodi" {{ old('role') == 'kaprodi' ? 'selected' : '' }}>Kaprodi</option>
                <option value="tim" {{ old('role') == 'tim' ? 'selected' : '' }}>Tim</option>
            </select>     

            <label for="role" class="text-2xl">Status User</label>
            <select name="status" id="status" class="w-full p-3 border border-black rounded-lg mb-3" required>
                <option value="" disabled selected {{ old('status') ? '' : 'selected' }}>Pilih Status</option>
                <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            </select>     

            <label for="kode_prodi" class="text-2xl">Prodi</label>
            <select name="kode_prodi" id="kode_prodi"
                class="w-full p-3 border border-black rounded-lg mb">
                <option value="">Pilih Prodi</option>
                @foreach ($prodis as $prodi)
                    <option value="{{ $prodi->kode_prodi }}">{{ $prodi->nama_prodi }}</option>
                @endforeach
            </select>
            <p class="italic text-red-500">*kosongkan bila user admin/wadir1, jika tetap dipilih prodi tetap dinull kan</p>

        <button type="submit" class="bg-green-400 hover:bg-green-800 mt-3 px-5 py-2 rounded-lg">Simpan</button>
        <a href="{{ route('admin.users.index') }}" class="bg-blue-400 hover:bg-blue-800 mt-3 px-5 py-2 rounded-lg">Kembali</a>
    </form>
</div>
</div>
@endsection