@extends('layouts.app')

@section('content')
    <div class="mx-5 md:mx-20 my-10">
        <h2 class="text-4xl font-extrabold text-center mb-4">Pemetaan CPL - CPMK - MK Per Semester</h2>
        <hr class="border border-black mb-4">
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
        <div class="overflow-auto border">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-green-500 text-white">
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
                            {{-- Jika tidak ada CPMK, tetap tampilkan CPL --}}
                            <tr>
                                <td class="border px-4 py-2">{{ $kode_cpl }}</td>
                                <td class="border px-4 py-2 text-center text-gray-400 italic">{{ null }}</td>
                                @for ($i = 1; $i <= 8; $i++)
                                    <td class="border px-4 py-2"></td>
                                @endfor
                            </tr>
                        @else
                            @foreach ($cpmks as $kode_cpmk => $cpmk)
                                <tr>
                                    @if ($first)
                                        <td class="border px-4 py-2" rowspan="{{ $rowspan }}">{{ $kode_cpl }}</td>
                                        @php $first = false; @endphp
                                    @endif
                                    <td class="border px-4 py-2">{{ $kode_cpmk }}</td>
                                    @for ($i = 1; $i <= 8; $i++)
                                        <td class="border px-4 py-2 whitespace-pre-line">
                                            @if (!empty($cpmk['semester'][$i]))
                                                {!! implode('<br>', $cpmk['semester'][$i]) !!}
                                            @endif
                                        </td>
                                    @endfor
                                </tr>
                            @endforeach
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
