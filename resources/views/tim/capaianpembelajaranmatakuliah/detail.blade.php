@extends('layouts.tim.app')

@section('content')
    <div class="mr-20 ml-20">
        <h2 class="text-3xl font-extrabold text-center mb-6">Detail Capaian Pembelajaran Mata Kuliah</h2>
        <hr class="border border-black mb-8">

        <div class="mb-3">
            <label class="text-xl font-semibold">CPL Terkait</label>
            <div class="w-full bg-gray-100 border border-black rounded-lg px-4 py-2 space-y-2 mt-1">
                @forelse ($cpls as $cpl)
                    <div>{{ $cpl->kode_cpl }}: {{ $cpl->deskripsi_cpl }}</div>
                @empty
                    <div class="text-gray-500 italic">Tidak ada CPL terkait.</div>
                @endforelse
            </div>
        </div>

        <div class="mb-4">
            <label class="text-xl font-semibold">MK Terkait</label>
            <div class="w-full bg-gray-100 border border-black rounded-lg px-4 py-2 space-y-2 mt-1">
                @forelse ($mks as $mk)
                    <div>{{ $mk->kode_mk }}: {{ $mk->nama_mk }}</div>
                @empty
                    <div class="text-gray-500 italic">Tidak ada mata kuliah terkait.</div>
                @endforelse
            </div>
        </div>

        <div>
            <label class="text-xl font-semibold">Kode CPMK</label>
            <input type="text" value="{{ $cpmk->kode_cpmk }}" readonly
                class="mt-1 mb-3 w-full bg-gray-100 border border-black rounded-lg px-4 py-2">
        </div>
        <div>
            <label class="font-semibold text-xl">Deskripsi CPMK</label>
            <textarea readonly class="mt-1 w-full mb-5 bg-gray-100 border border-black rounded-lg px-3 py-2">{{ $cpmk->deskripsi_cpmk }}</textarea>
        </div>

        <a href="{{ route('tim.capaianpembelajaranmatakuliah.index') }}"
            class="px-5 py-2 bg-gray-600 text-white font-bold rounded-lg hover:bg-gray-700">
            kembali
        </a>
    </div>
@endsection
