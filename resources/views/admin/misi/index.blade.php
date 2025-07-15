@extends('layouts.app')

@section('content')
    <div class="bg-white p-4 md:p-6 lg:p-8 rounded-lg shadow-md mx-2 md:mx-0">

        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Data Misi</h1>
            <hr class="border-t-2 md:border-t-4 border-black my-3 md:my-4 mx-auto">
        </div>

        @if (session('success'))
            <div id="alert" class="bg-green-500 text-white px-4 py-2 rounded-md mb-6 text-center w-full relative mx-auto">
                <span class="font-bold">{{ session('success') }}</span>
                <button onclick="document.getElementById('alert').style.display='none'"
                    class="absolute top-1 right-3 text-white font-bold text-lg">
                    &times;
                </button>
            </div>
        @endif

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <div>
                <a href="{{ route('admin.misi.create') }}"
                    class="bg-green-600 hover:bg-green-800 text-white font-bold px-4 py-2 rounded-md inline-flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Tambah
                </a>
            </div>
            <div class="sm:min-w-[250px] w-full sm:w-auto">
                <div
                    class="flex items-center border border-black rounded-md focus-within:ring-2 focus-within:ring-green-500 bg-white">
                    <span class="pl-3 text-gray-400">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" id="search" placeholder="Search..."
                        class="px-3 py-2 w-full focus:outline-none bg-transparent" />
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            @if ($misis->isEmpty())
                <div class="p-8 text-center text-gray-600">
                    Data misi belum tersedia.
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full border border-black rounded-lg overflow-hidden shadow-md">
                        <thead class="bg-green-800 text-white">
                            <tr>
                                <th class="px-6 py-3 text-center font-medium uppercase border-r border-gray-200">No</th>
                                <th class="px-6 py-3 text-center font-medium uppercase border-r border-gray-200">Misi</th>
                                <th class="px-6 py-3 text-center font-medium uppercase border-r border-gray-200">Visi
                                    Terkait</th>
                                <th class="px-6 py-3 text-center font-medium uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($misis as $index => $misi)
                                <tr class="{{ $index % 2 == 0 ? 'bg-gray-50' : 'bg-white' }} hover:bg-gray-100">
                                    <td class="px-6 py-4 text-center border border-gray-200">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 border border-gray-200">{{ $misi->misi }}</td>
                                    <td class="px-6 py-4 border border-gray-200 text-center">
                                        {{ $misi->visi->visi ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 border border-gray-200">
                                        <div class="flex justify-center space-x-2">
                                            <a href="{{ route('admin.misi.edit', $misi->id) }}"
                                                class="bg-blue-600 hover:bg-blue-800 text-white p-2 rounded-md inline-flex items-center justify-center"
                                                title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                                    fill="currentColor">
                                                    <path
                                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('admin.misi.destroy', $misi->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus misi ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="bg-red-600 hover:bg-red-800 text-white p-2 rounded-md inline-flex items-center justify-center"
                                                    title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
