@extends('layouts.app')
@section('content')
    <div class="mx-5 md:mx-20 my-10">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-800">Pemetaan MK - CPMK - SUBCPMK</h2>
            <hr class="border-t-4 border-black my-4 mx-auto mb-4">
        </div>
        
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <form method="GET" action="{{ route('admin.pemetaanmkcpmksubcpmk.index') }}" class="w-full md:w-64">
                <select name="kode_prodi" id="kode_prodi"
                    class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                    onchange="this.form.submit()">
                    <option value="">Pilih Prodi</option>
                    @foreach ($prodis as $prodi)
                        <option value="{{ $prodi->kode_prodi }}" {{ $kode_prodi == $prodi->kode_prodi ? 'selected' : '' }}>
                            {{ $prodi->nama_prodi }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

        @if(empty($kode_prodi))
            <div class="text-center bg-white rounded-lg shadow">
                <p class="p-8 text-center text-gray-600">Silakan pilih prodi terlebih dahulu.</p>
            </div>
        @else
            @if($data->isEmpty())
                <div class="text-center bg-white rounded-lg shadow">
                    <p class="p-8 text-center text-gray-600">Tidak ada data pemetaan untuk program studi yang dipilih.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-300 rounded-lg overflow-hidden shadow-md">
                        <thead class="bg-green-800">
                            <tr class="text-white uppercase text-center">
                                <th class="p-3 border-r border-gray-200 font-bold">No</th>
                                <th class="p-3 border-r border-gray-200 font-bold">Kode MK</th>
                                <th class="p-3 border-r border-gray-200 font-bold">Nama MK</th>
                                <th class="p-3 border-r border-gray-200 font-bold">Kode CPMK</th>
                                <th class="p-3 border-r border-gray-200 font-bold">Nama CPMK</th>
                                <th class="p-3 border-r border-gray-200 font-bold">Kode Sub CPMK</th>
                                <th class="p-3 font-bold">Nama Sub CPMK</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $index => $row)
                                <tr class="{{ $index % 2 == 0 ? 'bg-gray-100' : 'bg-white' }} hover:bg-gray-200">
                                    <td class="p-3 border border-gray-200 text-center">{{ $index + 1 }}</td>
                                    <td class="p-3 border border-gray-200 text-center">{{ $row->kode_mk }}</td>
                                    <td class="p-3 border border-gray-200 whitespace-normal break-words">
                                        <div class="flex items-center h-full">
                                            {{ $row->nama_mk }}
                                        </div>
                                    </td>
                                    <td class="p-3 border border-gray-200 text-center">{{ $row->kode_cpmk }}</td>
                                    <td class="p-3 border border-gray-200">{{ $row->deskripsi_cpmk }}</td>
                                    <td class="p-3 border border-gray-200 text-center">{{ $row->sub_cpmk }}</td>
                                    <td class="p-3 border border-gray-200">{{ $row->uraian_cpmk }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        @endif
    </div>
@endsection