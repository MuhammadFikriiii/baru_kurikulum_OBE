@extends('layouts.app')

@section('content')

<div class="mr-20 ml-20">
    <h2 class="text-4xl font-extrabold text-center mb-4">Daftar Capaian Pembelajaran Matakuliah</h2>
    <hr class="w-full border border-black mb-4">

    <!-- Link untuk menambah data -->
    <a href="{{ route('admin.capaianpembelajaranmatakuliah.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg mb-4 inline-block">
        Tambah Capaian Pembelajaran Matakuliah
    </a>

    <!-- Tabel data Capaian Pembelajaran Mata Kuliah -->
    <table class="w-full border-collapse">
        <thead>
            <tr>
                <th class="border px-4 py-2">Kode CPMK</th>
                <th class="border px-4 py-2">Deskripsi CPMK</th>
                <th class="border px-4 py-2">Profil Lulusan Terkait</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cpmks as $cpmk)
                <tr>
                    <td class="border px-4 py-2">{{ $cpmk->kode_cpmk }}</td>
                    <td class="border px-4 py-2">{{ $cpmk->deskripsi_cpmk }}</td>
                    <td class="border px-4 py-2">
                        @foreach($cpmk->capaianProfilLulusan as $cpl)
                            <p>{{ $cpl->kode_cpl }} - {{ $cpl->deskripsi_cpl }}</p>
                        @endforeach
                    </td>
                    <td class="border px-4 py-2">
                        <!-- Aksi seperti Edit dan Hapus bisa ditambahkan di sini -->
                        <a href="{{ route('admin.capaianpembelajaranmatakuliah.edit', $cpmk->id) }}" class="text-blue-500">Edit</a> |
                        <form action="{{ route('admin.capaianpembelajaranmatakuliah.destroy', $cpmk->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
