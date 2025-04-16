@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-4">Daftar Pengguna Belum Disetujui</h1>
    <table class="w-full border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2 border">Nama</th>
                <th class="p-2 border">Email</th>
                <th class="p-2 border">Role</th>
                <th class="p-2 border">Prodi</th>
                <th class="p-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pendingUsers as $user)
                <tr>
                    <td class="p-2 border">{{ $user->name }}</td>
                    <td class="p-2 border">{{ $user->email }}</td>
                    <td class="p-2 border">{{ ucfirst($user->role) }}</td>
                    <td class="p-2 border">{{ $user->prodi->nama_prodi ?? '-' }}</td>
                    <td class="p-2 border">
                        <form action="{{ route('admin.pendingusers.approve', $user->id) }}" method="POST" class="inline">
                            @csrf
                            @method('PUT')
                            <button class="bg-green-500 text-white px-3 py-1 rounded">Setujui</button>
                        </form>
                        <form action="{{ route('admin.pendingusers.reject', $user->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 text-white px-3 py-1 rounded ml-2">Tolak</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center p-4">Tidak ada pengguna yang menunggu persetujuan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection