@extends('layouts.app')

@section('content')
<div class="mx-20 mt-6">
    <h2 class="font-extrabold text-3xl mb-5 text-center">Edit Capaian Pembelajaran Lulusan</h2>
    <hr class="border-t-2 md:border-t-4 border-black my-3 md:my-4 mx-auto">

        @if ($errors->any())
            <div style="color: red;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.capaianprofillulusan.update', $capaianprofillulusan->id_cpl) }}" method="POST">

            @csrf
            @method('PUT')

            <label for="id_pls" class="text-2xl font-semibold mb-2">PL Terkait:</label>
            <select id="id_pls" name="id_pls"
                class="border border-black p-3 w-full rounded-lg mt-1 mb-3 focus:outline-none focus:ring-2 focus:ring-[#5460B5] focus:bg-[#f7faff]"
                required>
                @foreach ($profilLulusans as $pl)
                    <option value="{{ $pl->id_pl }}" @if (in_array($pl->id_pl, old('id_pls', $selectedProfilLulusans ?? []))) selected @endif
                        title="{{ $pl->tahun }}: {{ $pl->kode_pl }}: {{ $pl->deskripsi_pl }}">
                        {{ $pl->tahun }}: {{ $pl->nama_prodi }}: {{ $pl->kode_pl }}: {{ $pl->deskripsi_pl }}
                    </option>
                @endforeach
            </select>

            <label class="text-2xl" for="kode_cpl">Kode Capaian Profil Lulusan:</label>
            <input type="text" name="kode_cpl" id="kode_cpl" class="border border-black w-full rounded-lg p-3 mt-1 mb-3"
                value="{{ old('kode_cpl', $capaianprofillulusan->kode_cpl) }}" required>
            <br>

            <label class="text-2xl" for="deskripsi_cpl">Deskripsi Capaian Profil Lulusan:</label>
            <textarea type="text" name="deskripsi_cpl" id="deskripsi_cpl" class="border border-black w-full rounded-lg p-3 mb-3"
                required>{{ old('deskripsi_cpl', $capaianprofillulusan->deskripsi_cpl) }}</textarea>
            <br>

            <label class="text-2xl" for="status_cpl">Status CPL:</label>
            <select name="status_cpl" id="status_cpl" class="border border-black p-3 mt-1 w-full rounded-lg mb-3" required>
                <option value="Kompetensi Utama Bidang"
                    {{ $capaianprofillulusan->status_cpl == 'Kompetensi Utama Bidang' ? 'selected' : '' }}>Kompetensi Utama
                    Bidang</option>
                <option value="Kompetensi Tambahan"
                    {{ $capaianprofillulusan->status_cpl == 'Kompetensi Tambahan' ? 'selected' : '' }}>Kompetensi Tambahan
                </option>
            </select>
            <br>
            
                <div class="flex justify-end space-x-5 mt-[50px]">
                    <a href="{{ route('admin.capaianprofillulusan.index') }}" 
                       class="px-6 py-2 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg transition duration-200">
                        Kembali
                    </a>
                    <button type="submit" 
                            class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition duration-200">
                        Simpan
                    </button>
                </div>
        </form>
    </div>
@endsection
