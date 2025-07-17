@extends('layouts.wadir1.app')

@section('content')

    <div class="mx-20 mt-6">
        <h2 class="text-3xl font-extrabold text-center mb-4">Detail Bahan Kajian</h2>
        <hr class="border-t-2 md:border-t-4 border-black my-3 md:my-4 mx-auto">
        @if ($selectedCapaianProfilLulusans)
            <h3 class="text-xl font-semibold mb-2">Capaian Profil Lulusan Terkait:</h3>
            <ul class="w-full p-3 border border-black rounded-lg mb-4">
                @foreach ($selectedCapaianProfilLulusans as $id_cpl)
                    @php
                        $cplDetail = $capaianprofillulusans->firstWhere('id_cpl', $id_cpl);
                    @endphp
                    @if ($cplDetail)
                        <li><strong>{{ $cplDetail->kode_cpl }}</strong>: {{ $cplDetail->deskripsi_cpl }}</li>
                    @endif
                @endforeach
            </ul>
        @endif

        <div>
            <label for="kode_bk" class="block text-xl font-semibold">Kode BK</label>
            <input type="text" id="kode_bk" value="{{ $id_bk->kode_bk }}" readonly
                class="w-full p-3 border border-black rounded-lg mb-4">
        </div>

        <div>
            <label for="nama_bk" class="block text-xl font-semibold">Nama BK</label>
            <input type="text" id="nama_bk" value="{{ $id_bk->nama_bk }}" readonly
                class="w-full p-3 border border-black rounded-lg mb-4">
        </div>

        <div>
            <label for="referensi_bk" class="block text-xl font-semibold">Referensi BK</label>
            <input type="text" id="referensi_bk" value="{{ $id_bk->referensi_bk }}" readonly
                class="w-full p-3 border border-black rounded-lg mb-4">
        </div>

        <div>
            <label for="status_bk" class="block text-xl font-semibold">Status BK</label>
            <input type="text" id="status_bk" value="{{ $id_bk->status_bk }}" readonly
                class="w-full p-3 border border-black rounded-lg mb-4">
        </div>


        <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="deskripsi_bk" class="block text-xl font-semibold">Deskripsi BK</label>
                <textarea id="deskripsi_bk" readonly class="w-full p-3 border border-black rounded-lg h-24 resize-none">{{ $id_bk->deskripsi_bk }}</textarea>
            </div>

            <div>
                <label for="knowledge_area" class="block text-xl font-semibold">Knowledge Area</label>
                <textarea id="knowledge_area" readonly class="w-full p-3 border border-black rounded-lg h-24 resize-none">{{ $id_bk->knowledge_area }}</textarea>
            </div>
        </div>


        {{-- <div class="md:col-span-2 flex justify-end items-end pt-6 space-x-4">
            <a href="{{ route('wadir1.bahankajian.edit', $id_bk->id_bk) }}"
               class="px-5 py-2 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold rounded-lg transition duration-200">
                Edit
            </a>
            <form action="{{ route('wadir1.bahankajian.destroy', $id_bk->id_bk) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"
                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"
                    class="px-4 py-2 bg-red-600 hover:bg-red-800 text-white font-semibold rounded-lg transition duration-200">
                    Hapus
                </button>
            </form>
        </div> --}}


        <div class="flex justify-start pt-6">
            <a href="{{ route('wadir1.bahankajian.index') }}"
                class="px-6 py-2 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg transition duration-200">
                Kembali
            </a>
        </div>
    </div>

@endsection
