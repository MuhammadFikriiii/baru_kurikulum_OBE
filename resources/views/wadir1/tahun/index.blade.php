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
            <!-- Search -->
            <div class="sm:min-w-[250px] w-full sm:w-auto">
                <div class="flex items-center border border-gray-300 rounded-md focus-within:ring-2 focus-within:ring-green-500 bg-white">
                    <span class="pl-3 text-gray-400">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" id="search" placeholder="Search..."
                        class="px-3 py-2 w-full focus:outline-none bg-transparent" />
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
