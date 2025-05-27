@extends('layouts.wadir1.app')

@section('content')
    <div class="mr-20 ml-20">
        <h2 class="text-3xl font-extrabold text-center mb-6">Detail Capaian Pembelajaran Mata Kuliah</h2>
        <hr class="border border-black mb-8">
        <div class="mb-8">
            <h3 class="text-xl font-semibold mb-2 text-gray-800">Capaian Profil Lulusan Terkait</h3>
            <ul class="w-full bg-gray-100 border border-gray-300 rounded-lg px-4 py-2">
                @forelse ($cpls as $cpl)
                    <li><span class="font-semibold">{{ $cpl->kode_cpl }}</span>: {{ $cpl->deskripsi_cpl }}</li>
                @empty
                    <li><em>Tidak ada CPL terkait.</em></li>
                @endforelse
            </ul>
        </div>

        <div class="mb-8">
            <h3 class="text-xl font-semibold mb-2 text-gray-800">Mata Kuliah Terkait</h3>
            <ul class="w-full bg-gray-100 border border-gray-300 rounded-lg px-4 py-2">
                @forelse ($mks as $mk)
                    <li>{{ $mk->kode_mk }} - {{ $mk->nama_mk }}</li>
                @empty
                    <li><em>Tidak ada mata kuliah terkait.</em></li>
                @endforelse
            </ul>
        </div>
        <div>
            <label class="block text-gray-700 font-semibold mb-1">Kode CPMK</label>
            <input type="text" value="{{ $cpmk->kode_cpmk }}" readonly
                class="w-full bg-gray-100 border border-gray-300 rounded-lg px-4 py-2">
        </div>
        <div>
            <label class="block text-gray-700 font-semibold mb-1">Deskripsi CPMK</label>
            <textarea readonly class="w-full bg-gray-100 border border-gray-300 rounded-lg px-4 py-2">{{ $cpmk->deskripsi_cpmk }}</textarea>
        </div>
        <a href="{{ route('wadir1.capaianpembelajaranmatakuliah.index') }}"
            class="mt-5 px-5 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700">
            kembali
        </a>
    </div>
@endsection
