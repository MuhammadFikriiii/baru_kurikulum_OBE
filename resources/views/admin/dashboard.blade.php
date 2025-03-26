@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h1 class="text-4xl font-extrabold text-gray-800 font ml-28 mr-10 mb-10">Dashboard</h1>
<p class="ml-28 mb-3 text-black font-extrabold">TABEL USERS</p>
<div class="overflow-x-auto text-center ml-28 mr-28">
    <div class="overflow-x-auto shadow-lg">
        <table class="min-w-full border text-left border-black text-sm bg-white rounded-lg">
            <thead class="bg-green-800 text-white">
                <tr class=>
                    <th class="py-3 px-4 w-1/5">Nama</th>
                    <th class="py-3 px-4 w-1/5">Email</th>
                    <th class="py-3 px-4 w-1/5">Role</th>
                    <th class="py-3 px-4 w-1/5 pl-12">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $index => $user)
                <tr class="{{ $index % 2 == 0 ? 'bg-gray-100 opacity-90' : 'bg-white' }} hover:bg-gray-200 transition border-black">
                    <td class="py-3 px-4">{{ $user->name }}</td>
                    <td class="py-3 px-4">{{ $user->email }}</td>
                    <td class="py-3 px-4 font-medium text-blue-600">{{ ucfirst($user->role) }}</td>
                    <td class="py-3 px-6 flex space-x-2">
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="bg-green-500 text-white px-3 py-1 rounded-md hover:bg-green-600">
                            ✏️
                        </a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600" onclick="return confirm('Hapus user ini?')">
                                🗑️
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3 text-right">
    <a href="{{ route('admin.users.index') }}" class="text-blue-600 hover:underline text-sm mr-28">
        ➜ Lihat Semua Pengguna
    </a>
</div>

    <p class="mb-3 ml-28 text-black font-extrabold">TABEL JURUSAN</p>
        <div class="overflow-x-auto ml-28 mr-28">
            <table class="min-w-full border border-black text-sm">
                <thead class="bg-green-800 text-white text-left">
                    <tr>
                        <th class="py-2 px-4 w-1/5">Kode Jurusan</th>
                        <th class="py-2 px-4 w-1/5">Nama Jurusan</th>
                        <th class="py-2 px-4 w-1/5"></th>
                        <th class="py-2 px-4 w-1/5 pl-12">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jurusans as $index => $jurusan)
                    <tr class="{{ $index % 2 == 0 ? 'bg-gray-100 opacity-90' : 'bg-white' }} hover:bg-gray-300 transition">
                        <td class="py-2 px-4">{{ $jurusan->kode_jurusan }}</td>
                        <td class="py-2 px-4">{{ $jurusan->nama_jurusan }}</td>
                        <td class="py-2 px-4"></td>
                        <td class="py-3 px-6 text-center flex space-x-2">
                            <a href="{{ route('admin.jurusan.edit', $jurusan->kode_jurusan) }}" class="bg-green-500 text-white px-3 py-1 rounded-md hover:bg-green-600">
                                ✏️
                            </a>
                            <form action="{{ route('admin.jurusan.destroy', $jurusan->kode_jurusan) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600" onclick="return confirm('Hapus user ini?')">
                                    🗑️
                                </button>
                            </form>
                        </td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    
    <div class="mt-3 text-right">
        <a href="{{ route('admin.jurusan.index') }}" class="text-blue-600 hover:underline text-sm mr-28">
            ➜ Lihat Semua Jurusan
        </a>
    </div>

    <p class="mb-3 ml-28 text-black font-extrabold">TABEL PRODI</p>
        <div class="overflow-x-auto ml-28 mr-28">
            <table class="min-w-full border border-black text-sm">
                <thead class="bg-green-800 text-white text-left">
                    <tr>
                        <th class="py-2 px-4 w-1/5">Kode Jurusan</th>
                        <th class="py-2 px-4 w-1/5">Kode Prodi</th>
                        <th class="py-2 px-4 w-1/5">Nama Prodi</th>
                        <th class="py-2 px-4 w-1/5">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($prodis as $index => $prodi)
                    <tr class="{{ $index % 2 == 0 ? 'bg-gray-100 opacity-90' : 'bg-white' }} hover:bg-gray-300 transition">
                        <td class="py-2 px-4">{{ $prodi->kode_jurusan }}</td>
                        <td class="py-2 px-4">{{ $prodi->kode_prodi }}</td>
                        <td class="py-2 px-4">{{ $prodi->nama_prodi }}</td>
                        <td class="py-3 px-6 text-center flex space-x-2">
                            <a href="{{ route('admin.prodi.edit', $prodi->kode_prodi) }}" class="bg-green-500 text-white px-3 py-1 rounded-md hover:bg-green-600">
                                ✏️
                            </a>
                            <form action="{{ route('admin.jurusan.destroy', $jurusan->kode_jurusan) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600" onclick="return confirm('Hapus user ini?')">
                                    🗑️
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    <div class="mt-3 text-right">
        <a href="{{ route('admin.prodi.index') }}" class="text-blue-600 hover:underline text-sm">
            ➜ Lihat Semua Prodi
        </a>
    </div>
@endsection