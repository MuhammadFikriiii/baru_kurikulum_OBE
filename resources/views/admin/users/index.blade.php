@extends('layouts.app')

@section('title', 'Daftar Pengguna')

@section('content')
    <h1 class="text-2xl font-bold text-gray-700 mb-4">Daftar Pengguna</h1>

    <a href="{{ route('admin.users.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
        Tambah User
    </a>

    <div class="mt-4 bg-white shadow-sm overflow-hidden ml-16 mr-16">
        <table class="w-full border-collapse">
            <thead class="bg-green-800 text-white border-b">
                <tr>
                    <th class="py-3 px-6 w-1/5 text-left">Nama</th>
                    <th class="py-3 px-6 w-1/5 text-left">Email</th>
                    <th class="py-3 px-6 w-1/5 text-left">Role</th>
                    <th class="py-3 px-6 w-1/5 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $index => $user)
                <tr class="{{ $index % 2 == 0 ? 'bg-gray-100 opacity-90' : 'bg-white' }} hover:bg-gray-200 transition border-black">
                    <td class="py-3 px-6">{{ $user->name }}</td>
                    <td class="py-3 px-6">{{ $user->email }}</td>
                    <td class="py-3 px-6">{{ ucfirst($user->role) }}</td>
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
@endsection