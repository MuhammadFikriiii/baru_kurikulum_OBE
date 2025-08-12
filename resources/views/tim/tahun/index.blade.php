@extends('layouts.tim.app')

@section('content')
    <div class="bg-white p-4 md:p-6 lg:p-8 rounded-lg shadow-md mx-2 md:mx-0">

        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Daftar Tahun Kurikulum</h1>
            <hr class="border-t-2 md:border-t-4 border-black my-3 md:my-4 mx-auto">
        </div>

        @if (session('success'))
            <div id="alert"
                class="bg-green-500 text-white px-4 py-2 rounded-md mb-6 text-center relative max-w-4xl mx-auto">
                <span class="font-bold">{{ session('success') }}</span>
                <button onclick="document.getElementById('alert').style.display='none'"
                    class="absolute top-1 right-3 text-white font-bold text-lg">&times;</button>
            </div>
        @endif

        @if (session('sukses'))
            <div id="alert" class="bg-red-500 text-white px-4 py-2 rounded-md mb-4 text-center relative">
                <span class="font-bold">{{ session('sukses') }}</span>
                <button onclick="document.getElementById('alert').style.display='none'"
                    class="absolute top-1 right-3 text-white font-bold text-lg">
                    &times;
                </button>
            </div>
        @endif

        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('tim.tahun.create') }}"
                class="bg-green-600 hover:bg-green-800 text-white font-bold px-5 py-2 rounded-md inline-flex items-center">
                Tambah
            </a>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            @if ($tahuns->isEmpty())
                <div class="p-8 text-center text-gray-600">
                    Data Tahun Ajaran belum tersedia.
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-green-800 text-white">
                            <tr>
                                <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider">No</th>
                                <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider">Tahun Ajaran
                                </th>
                                <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider">Nama
                                    Kurikulum</th>
                                <th class="px-4 py-3 text-center text-xs font-medium uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($tahuns as $index => $tahun)
                                <tr class="{{ $index % 2 == 0 ? 'bg-gray-100' : 'bg-white' }} hover:bg-gray-100">
                                    <td class="px-4 py-4 text-center text-sm">{{ $tahuns->firstItem() + $index }}</td>
                                    <td class="px-4 py-4 text-center text-sm">{{ $tahun->tahun }}</td>
                                    <td class="px-4 py-4 text-center text-sm">{{ ucfirst($tahun->nama_kurikulum) }}</td>
                                    <td class="px-4 py-4 text-center">
                                        <div class="flex justify-center space-x-2">
                                            <a href="{{ route('tim.tahun.edit', $tahun->id_tahun) }}"
                                                class="bg-blue-600 hover:bg-blue-800 text-white p-2 rounded-md"
                                                title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                    fill="currentColor">
                                                    <path
                                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                </svg></a>
                                            <form action="{{ route('tim.tahun.destroy', $tahun->id_tahun) }}" method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus tahun ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-md"
                                                    title="Hapus" onclick="return confirm('Hapus tahun ini?')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                            clip-rule="evenodd" />
                                                    </svg></button>
                                            </form>
                                        </div>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $tahuns->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
