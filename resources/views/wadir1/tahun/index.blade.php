@extends('layouts.wadir1.app')

@section('content')
    <div class="bg-white p-4 md:p-6 lg:p-8 rounded-lg shadow-md mx-2 md:mx-0">
        <div class="text-center mb-6 md:mb-8">
            <h1 class="text-xl md:text-3xl font-bold text-gray-700">Daftar Tahun Kurikulum</h1>
            <hr class="border-t-2 md:border-t-4 border-black my-3 md:my-4 mx-auto">
        </div>

        @if (session('success'))
            <div id="alert"
                class="bg-green-500 text-white px-4 py-2 rounded-md mb-4 text-center relative max-w-4xl mx-auto">
                <span class="font-bold">{{ session('success') }}</span>
                <button onclick="document.getElementById('alert').style.display='none'"
                    class="absolute top-1 right-3 text-white font-bold text-lg">
                    &times;
                </button>
            </div>
        @endif

        @if (session('sukses'))
            <div id="alert"
                class="bg-red-500 text-white px-4 py-2 rounded-md mb-4 text-center relative max-w-4xl mx-auto">
                <span class="font-bold">{{ session('sukses') }}</span>
                <button onclick="document.getElementById('alert').style.display='none'"
                    class="absolute top-1 right-3 text-white font-bold text-lg">
                    &times;
                </button>
            </div>
        @endif

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 md:mb-6 gap-3 md:gap-4">
            <div class="w-full md:w-auto">
                <div class="relative">
                    <input type="text" id="search" placeholder="Search..."
                        class="w-full md:w-64 border border-gray-300 px-4 py-2 rounded-md pl-10 focus:outline-none focus:ring-2 focus:ring-green-500">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            @if ($tahuns->isEmpty())
                <div class="p-8 text-center text-gray-600">
                    Data Tahun Ajaran belum tersedia.
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-300 rounded-lg overflow-hidden shadow-md">
                        <thead class="bg-green-800 text-white">
                            <tr>
                                <th
                                    class="px-3 py-2 md:px-6 md:py-3 text-center text-xs md:text-sm font-medium uppercase border-r border-gray-200">
                                    No</th>
                                <th
                                    class="px-3 py-2 md:px-6 md:py-3 text-center text-xs md:text-sm font-medium uppercase border-r border-gray-200">
                                    Tahun Ajaran</th>
                                <th
                                    class="px-3 py-2 md:px-6 md:py-3 text-center text-xs md:text-sm font-medium uppercase border-r border-gray-200">
                                    Nama Kurikulum</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tahuns as $index => $tahun)
                                <tr class="{{ $index % 2 == 0 ? 'bg-gray-50' : 'bg-white' }} hover:bg-gray-100">
                                    <td
                                        class="px-3 py-2 md:px-6 md:py-4 text-center border border-gray-200 text-xs md:text-sm">
                                        {{ $tahuns->firstItem() + $index }}</td>
                                    <td
                                        class="px-3 py-2 md:px-6 md:py-4 text-center border border-gray-200 text-xs md:text-sm">
                                        {{ $tahun->tahun }}</td>
                                    <td
                                        class="px-3 py-2 md:px-6 md:py-4 text-center border border-gray-200 text-xs md:text-sm">
                                        {{ ucfirst($tahun->nama_kurikulum) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 px-4 py-2">
                    {{ $tahuns->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
