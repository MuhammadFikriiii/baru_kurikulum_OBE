@extends('layouts.kaprodi.app')

@section('content')
    <div class="bg-white p-4 md:p-6 lg:p-8 rounded-lg shadow-md mx-2 md:mx-0">

        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Daftar Tahun Kurikulum</h1>
            <hr class="border-t-4 border-black my-4 mx-auto mb-4">
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
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($tahuns as $index => $tahun)
                                <tr class="{{ $index % 2 == 0 ? 'bg-gray-100' : 'bg-white' }} hover:bg-gray-100">
                                    <td class="px-4 py-4 text-center text-sm">{{ $tahuns->firstItem() + $index }}</td>
                                    <td class="px-4 py-4 text-center text-sm">{{ $tahun->tahun }}</td>
                                    <td class="px-4 py-4 text-center text-sm">{{ ucfirst($tahun->nama_kurikulum) }}</td>
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
