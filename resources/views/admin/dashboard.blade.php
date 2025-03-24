@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h1 class="text-xl font-semibold text-gray-800 ml-10 mr-10 mb-4">Dashboard</h1>
<p class="ml-12 text-black font-extrabold">tabel users</p>
    <div class="bg-white shadow-md rounded-lg overflow-hidden ml-10 mr-10 p-4">
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300 text-sm">
                <thead class="bg-white text-black text-center">
                    <tr>
                        <th class="py-2 px-4 text-left">Nama</th>
                        <th class="py-2 px-4 text-left">Email</th>
                        <th class="py-2 px-4 text-left">Role</th>
                        <th class="py-2 px-4 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $index => $user)
                    <tr class="{{ $index % 2 == 0 ? 'bg-gray-200' : 'bg-white' }} hover:bg-gray-300 transition">
                        <td class="py-2 px-4">{{ $user->name }}</td>
                        <td class="py-2 px-4">{{ $user->email }}</td>
                        <td class="py-2 px-4 font-medium text-blue-600">{{ ucfirst($user->role) }}</td>
                        <td class="py-3 px-6 text-center flex justify-center space-x-2">
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600" onclick="return confirm('Hapus user ini?')">
                                    Delete
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
        <a href="{{ route('admin.users.index') }}" class="text-blue-600 hover:underline text-sm">
            ➜ Lihat Semua Pengguna
        </a>
    </div>

    <p class="ml-12 text-black font-extrabold">Tabel Jurusan</p>
    <div class="bg-white shadow-md rounded-lg overflow-hidden ml-10 mr-10 p-4">
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300 text-sm">
                <thead class="bg-white text-black text-center">
                    <tr>
                        <th class="py-2 px-4 text-left">Kode Jurusan</th>
                        <th class="py-2 px-4 text-left">Nama Jurusan</th>
                        <th class="py-2 px-4 text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jurusans as $index => $jurusan)
                    <tr class="{{ $index % 2 == 0 ? 'bg-gray-200' : 'bg-white' }} hover:bg-gray-300 transition">
                        <td class="py-2 px-4">{{ $jurusan->kode_jurusan }}</td>
                        <td class="py-2 px-4">{{ $jurusan->nama_jurusan }}</td>
                        <td><a href="{{ route('admin.jurusan.edit', $jurusan->kode_jurusan) }}">Edit</a>
                            <form action="{{ route('admin.jurusan.destroy', $jurusan->kode_jurusan) }}" method="POST" onsubmit="return confirm('Hapus jurusan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600">
                                    Delete
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
        <a href="{{ route('admin.jurusan.index') }}" class="text-blue-600 hover:underline text-sm">
            ➜ Lihat Semua Jurusan
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden ml-10 mr-10 p-4">
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300 text-sm">
                <thead class="bg-white text-black text-center">
                    <tr>
                        <th class="py-2 px-4 text-left">Kode Jurusan</th>
                        <th class="py-2 px-4 text-left">Kode Prodi</th>
                        <th class="py-2 px-4 text-left">Nama Prodi</th>
                        <th class="py-2 px-4 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($prodis as $index => $prodi)
                    <tr class="{{ $index % 2 == 0 ? 'bg-gray-200' : 'bg-white' }} hover:bg-gray-300 transition">
                        <td class="py-2 px-4">{{ $prodi->kode_jurusan }}</td>
                        <td class="py-2 px-4">{{ $prodi->kode_prodi }}</td>
                        <td class="py-2 px-4">{{ $prodi->nama_prodi }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3 text-right">
        <a href="{{ route('admin.prodi.index') }}" class="text-blue-600 hover:underline text-sm">
            ➜ Lihat Semua Prodi
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden ml-10 mr-10 p-4">
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300 text-sm">
                <thead class="bg-white text-black text-center">
                    <tr>
                        <th class="py-2 px-4 text-left">Nama</th>
                        <th class="py-2 px-4 text-left">Email</th>
                        <th class="py-2 px-4 text-left">Role</th>
                        <th class="py-2 px-4 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $index => $user)
                    <tr class="{{ $index % 2 == 0 ? 'bg-gray-200' : 'bg-white' }} hover:bg-gray-300 transition">
                        <td class="py-2 px-4">{{ $user->name }}</td>
                        <td class="py-2 px-4">{{ $user->email }}</td>
                        <td class="py-2 px-4 font-medium text-blue-600">{{ ucfirst($user->role) }}</td>
                        <td class="py-3 px-6 text-center flex justify-center space-x-2">
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600" onclick="return confirm('Hapus user ini?')">
                                    Delete
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
        <a href="{{ route('admin.users.index') }}" class="text-blue-600 hover:underline text-sm">
            ➜ Lihat Semua Pengguna
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden ml-10 mr-10 p-4">
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300 text-sm">
                <thead class="bg-white text-black text-center">
                    <tr>
                        <th class="py-2 px-4 text-left">Nama</th>
                        <th class="py-2 px-4 text-left">Email</th>
                        <th class="py-2 px-4 text-left">Role</th>
                        <th class="py-2 px-4 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $index => $user)
                    <tr class="{{ $index % 2 == 0 ? 'bg-gray-200' : 'bg-white' }} hover:bg-gray-300 transition">
                        <td class="py-2 px-4">{{ $user->name }}</td>
                        <td class="py-2 px-4">{{ $user->email }}</td>
                        <td class="py-2 px-4 font-medium text-blue-600">{{ ucfirst($user->role) }}</td>
                        <td class="py-3 px-6 text-center flex justify-center space-x-2">
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600" onclick="return confirm('Hapus user ini?')">
                                    Delete
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
        <a href="{{ route('admin.users.index') }}" class="text-blue-600 hover:underline text-sm">
            ➜ Lihat Semua Pengguna
        </a>
    </div>
@endsection