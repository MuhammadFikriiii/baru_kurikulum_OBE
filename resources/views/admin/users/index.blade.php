@extends('layouts.app')

@section('content')
<div class="ml-20 mr-20">
    <h1 class="text-2xl font-bold text-gray-700 mb-4 text-center">DATA PENGGUNA</h1>

    <hr class="border-t-4 border-black my-8">
        @if(session('success'))
        <div id="alert" class="bg-green-500 text-white px-4 py-2 rounded-md mb-4 text-center relative">
            <span class="font-bold">{{ session('success') }}</span>
            <button onclick="document.getElementById('alert').style.display='none'"
                class="absolute top-1 right-3 text-white font-bold text-lg">
                &times;
            </button>
        </div>
        @endif

        @if(session('sukses'))
        <div id="alert" class="bg-red-500 text-white px-4 py-2 rounded-md mb-4 text-center relative">
            <span class="font-bold">{{ session('sukses') }}</span>
            <button onclick="document.getElementById('alert').style.display='none'"
                class="absolute top-1 right-3 text-white font-bold text-lg">
                &times;
            </button>
        </div>
        @endif

    <div class="flex justify-between mb-4">
        <div class="space-x-2">
            <a href="{{ route('admin.users.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-md font-bold inline-flex  hover:bg-green-800">
                Tambah
            </a>
        </div>
        <div class="ml-auto justify-between">
            <input type="text" id="search" placeholder="Search..." 
                class="border border-black px-3 py-2 rounded-md">
        </div>
    </div>

    <div class="bg-white shadow-lg overflow-hidden">
        <table class="w-full border border-gray-300 shadow-md rounded-lg overflow-hidden">
            <thead class="bg-green-800 text-white border-b">
                <tr>
                    <th class="py-3 px-6 text-center min-w-[10px] font-bold uppercase ">No.</th>
                    <th class="py-3 px-6 text-center min-w-[10px] font-bold uppercase">Nama</th>
                    <th class="py-3 px-6 text-center min-w-[10px] font-bold uppercase">Email</th>
                    <th class="py-3 px-6 text-center min-w-[10px] font-bold uppercase">Prodi</th>
                    <th class="py-3 px-6 text-center min-w-[10px] font-bold uppercase">Role</th>
                    <th class="py-3 px-6 text-center min-w-[10px] font-bold uppercase">Status</th>
                    <th class="py-3 px-6 min-w-[10px] font-bold uppercase text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $index => $user)
                <tr class="{{ $index % 2 == 0 ? 'bg-gray-100' : 'bg-white' }} hover:bg-gray-200 border-b">
                    <td class="py-3 px-6 min-w-[10px] text-center">{{ $index + 1 }}</td>
                    <td class="py-3 px-6 min-w-[10px] text-center">{{ $user->name }}</td>
                    <td class="py-3 px-6 min-w-[10px] text-center">{{ $user->email }}</td>
                    <td class="py-3 px-6 min-w-[10px] text-center">{{ $user->prodi->nama_prodi ?? '-' }}</td>
                    <td class="py-3 px-6 min-w-[10px] text-center">{{ $user->status }}</td>
                    <td class="py-3 px-6 min-w-[10px] text-center">{{ ucfirst($user->role) }}</td>
                    <td class="py-3 px-6 flex justify-center items-center space-x-2">
                        <a href="{{ route('admin.users.detail',$user->id) }}" class="bg-gray-600 font-bold text-white px-5 py-2 rounded-md hover:bg-gray-700">
                         🛈 
                        </a>
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="bg-blue-600 text-white font-bold px-5 py-2 rounded-md hover:bg-blue-800">
                        ✏️ 
                        </a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="bg-red-500 text-white px-5 py-2 rounded-md hover:bg-red-600" onclick="return confirm('Hapus user ini?')">
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
@endsection