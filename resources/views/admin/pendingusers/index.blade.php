@extends('layouts.app')

@section('content')
<div class="mr-20 ml-20">
<div class="w-full">
    <h1 class="text-2xl font-bold mb-4 text-center">Daftar Pengguna Register</h1>
    <hr class="border-t-4 border-black my-8">
    <table class="w-full border border-gray-300">
        <thead>
            <tr class="bg-green-600 uppercase text-white">
                <th class="p-2 py-3 px-4 min-w-[10px] text-center font-bold uppercase">Nama</th>
                <th class="p-2 py-3 px-4 min-w-[10px] text-center font-bold uppercase">Email</th>
                <th class="p-2 py-3 px-4 min-w-[10px] text-center font-bold uppercase">Role</th>
                <th class="p-2 py-3 px-4 min-w-[10px] text-center font-bold uppercase">Prodi</th>
                <th class="p-2 py-3 px-4 min-w-[10px] text-center font-bold uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pendingUsers as $user)
                <tr>
                    <td class="p-2 py-3 px-4 min-w-[10px] text-center font-bold uppercase">{{ $user->name }}</td>
                    <td class="p-2 py-3 px-4 min-w-[10px] text-center font-bold uppercase">{{ $user->email }}</td>
                    <td class="p-2 py-3 px-4 min-w-[10px] text-center font-bold uppercase">{{ ucfirst($user->role) }}</td>
                    <td class="p-2 py-3 px-4 min-w-[10px] text-center font-bold uppercase">{{ $user->prodi->nama_prodi ?? '-' }}</td>
                    <td class="p-2 py-3 px-4 min-w-[10px] text-center font-bold uppercase">
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
</div>
@endsection