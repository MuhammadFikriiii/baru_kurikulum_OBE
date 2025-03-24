@extends('layouts.app')

@section('title', 'Daftar Pengguna')

@section('content')
    <h1 class="text-2xl font-bold text-gray-700 mb-4">Daftar Pengguna</h1>

    <a href="{{ route('admin.users.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
        Tambah User
    </a>

    <div class="mt-4 bg-white shadow-sm rounded-lg overflow-hidden">
        <table class="w-full border-collapse">
            <thead class="bg-gray-100 text-gray-700 border-b">
                <tr>
                    <th class="py-3 px-6 text-left">Nama</th>
                    <th class="py-3 px-6 text-left">Email</th>
                    <th class="py-3 px-6 text-left">Role</th>
                    <th class="py-3 px-6 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-3 px-6">{{ $user->name }}</td>
                    <td class="py-3 px-6">{{ $user->email }}</td>
                    <td class="py-3 px-6">{{ ucfirst($user->role) }}</td>
                    <td class="py-3 px-6 text-center flex justify-center space-x-2">
                        <a href="{{ route('admin.users.edit', $user->id) }}" 
                            class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600">
                             Edit
                         </a>                                             
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
@endsection