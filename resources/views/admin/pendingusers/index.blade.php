@extends('layouts.app')

@section('content')
<div class="bg-white p-4 md:p-6 lg:p-8 rounded-lg shadow-md mx-2 md:mx-0">
    <!-- Header Section -->
    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Pengguna Register</h1>
        <hr class="border-t-4 border-black my-4 mx-auto mb-4">
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
    <div id="alert" class="bg-green-500 text-white px-4 py-2 rounded-md mb-6 text-center relative max-w-4xl mx-auto">
        <span class="font-bold">{{ session('success') }}</span>
        <button onclick="document.getElementById('alert').style.display='none'"
            class="absolute top-1 right-3 text-white font-bold text-lg">
            &times;
        </button>
    </div>
    @endif

    @if(session('sukses'))
    <div id="alert" class="bg-red-500 text-white px-4 py-2 rounded-md mb-6 text-center relative max-w-4xl mx-auto">
        <span class="font-bold">{{ session('sukses') }}</span>
        <button onclick="document.getElementById('alert').style.display='none'"
            class="absolute top-1 right-3 text-white font-bold text-lg">
            &times;
        </button>
    </div>
    @endif

    <!-- Table Container -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 border border-gray-200">
            <thead class="bg-green-800 text-white">
                <tr>
                    <th class="px-6 py-3 text-center font-medium uppercase tracking-wider border border-gray-200">Nama</th>
                    <th class="px-6 py-3 text-center font-medium uppercase tracking-wider border border-gray-200">Email</th>
                    <th class="px-6 py-3 text-center font-medium uppercase tracking-wider border border-gray-200">Role</th>
                    <th class="px-6 py-3 text-center font-medium uppercase tracking-wider border border-gray-200">Prodi</th>
                    <th class="px-6 py-3 text-center font-medium uppercase tracking-wider border border-gray-200">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($pendingUsers as $user)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-center border border-gray-200">{{ $user->name }}</td>
                    <td class="px-6 py-4 text-center border border-gray-200">{{ $user->email }}</td>
                    <td class="px-6 py-4 text-center border border-gray-200">{{ ucfirst($user->role) }}</td>
                    <td class="px-6 py-4 text-center border border-gray-200">{{ $user->prodi->nama_prodi ?? '-' }}</td>
                    <td class="px-6 py-4 text-center border border-gray-200">
                        <div class="flex justify-center space-x-2">
                            <form action="{{ route('admin.pendingusers.approve', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" 
                                    class="bg-green-600 hover:bg-green-800 text-white p-2 rounded-md transition-colors duration-200"
                                    title="Setujui">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </form>
                            <form action="{{ route('admin.pendingusers.reject', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-600 hover:bg-red-800 text-white p-2 rounded-md transition-colors duration-200"
                                    title="Tolak"
                                    onclick="return confirm('Tolak pendaftaran pengguna ini?')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500 border border-gray-200">
                        Tidak ada pengguna yang menunggu persetujuan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection