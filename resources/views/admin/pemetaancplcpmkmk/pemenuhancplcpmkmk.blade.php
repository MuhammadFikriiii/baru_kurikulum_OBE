@extends('layouts.app')
@section('content')

    <div class="mx-5 md:mx-20 my-10">

        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-800">Pemetaan CPL - CPMK - MK Per Semester</h2>
             <hr class="border-t-4 border-black my-4 mx-auto mb-4">
        </div>

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <form method="GET" action="{{ route('admin.pemetaancplcpmkmk.pemenuhancplcpmkmk') }}" class="w-full md:w-64">
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
            @if(empty($matrix))
                <div class="text-center bg-white rounded-lg shadow">
                    <p class="p-8 text-center text-gray-600">Tidak ada data pemetaan untuk program studi yang dipilih.</p>
                </div>
            @else
                <div class="overflow-auto border">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-green-800 text-white">
                            <tr>
                                <th class="border px-4 py-2">CPL</th>
                                <th class="border px-4 py-2">CPMK</th>
                                @for ($i = 1; $i <= 8; $i++)
                                    <th class="border px-4 py-2">Semester {{ $i }}</th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody class="bg-white text-gray-700">
                            @foreach ($matrix as $kode_cpl => $cpl)
                            @php
                                $cpmks = $cpl['cpmk'];
                                $rowspan = max(1, count($cpmks));
                                $first = true;
                            @endphp
                        
                            @if (count($cpmks) === 0)
                                <tr>
                                    <td class="border px-4 py-2 text-center align-middle">{{ $kode_cpl }}</td>
                                    <td class="border px-4 py-2 text-center align-middle text-gray-400 italic">-</td>
                                    @for ($i = 1; $i <= 8; $i++)
                                        <td class="border px-4 py-2 text-center align-middle">-</td>
                                    @endfor
                                </tr>
                            @else
                                @foreach ($cpmks as $kode_cpmk => $cpmk)
                                    <tr class="hover:bg-gray-50">
                                        @if ($first)
                                            <td class="border px-4 py-2 text-center align-middle" rowspan="{{ $rowspan }}">{{ $kode_cpl }}</td>
                                            @php $first = false; @endphp
                                        @endif
                                        <td class="border px-4 py-2 text-center align-middle">{{ $kode_cpmk }}</td>
                                        @for ($i = 1; $i <= 8; $i++)
                                            <td class="border px-4 py-2 text-center align-middle">
                                                <div class="flex flex-col justify-center min-h-[3rem]">
                                                    @if (!empty($cpmk['semester'][$i]))
                                                        @foreach ($cpmk['semester'][$i] as $item)
                                                            <span class="py-1">{{ $item }}</span>
                                                        @endforeach
                                                    @else
                                                        <span class="text-gray-400 italic">-</span>
                                                    @endif
                                                </div>
                                            </td>
                                        @endfor
                                    </tr>
                                @endforeach
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        @endif
    </div>
@endsection