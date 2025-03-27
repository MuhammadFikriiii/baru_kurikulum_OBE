@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-semibold mb-4">Daftar Profil Lulusan</h2>
    
    @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded-md mb-4">
            {{ session('success') }}
        </div>
    @endif
    
    <a href="{{ route('admin.profillulusan.create') }}">Tambah Profil Lulusan</a>
    
    <div class="">
        <table class="">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border px-4 py-2">Kode Profil Lulusan</th>
                    <th class="border px-4 py-2">Prodi</th>
                    <th class="border px-4 py-2">Deskripsi Profill Lulusan</th>
                    <th class="border px-4 py-2">Profesi</th>
                    <th class="border px-4 py-2">Unsur</th>
                    <th class="border px-4 py-2">Keterangan</th>
                    <th class="border px-4 py-2">Sumber</th>
                    <th class="border px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($profillulusans as $profillulusan)
                    <tr>
                        <td class="border px-4 py-2">{{ $profillulusan->kode_pl }}</td>
                        <td class="border px-4 py-2">{{ $profillulusan->prodi->nama_prodi }}</td>
                        <td class="border px-4 py-2">{{ $profillulusan->deskripsi_pl }}</td>
                        <td class="border px-4 py-2">{{ $profillulusan->profesi_pl }}</td>
                        <td class="border px-4 py-2">{{ $profillulusan->unsur_pl }}</td>
                        <td class="border px-4 py-2">{{ $profillulusan->keterangan_pl }}</td>
                        <td class="border px-4 py-2">{{ $profillulusan->sumber_pl }}</td>
                        <td><a href="{{ route('admin.profillulusan.edit', $profillulusan->kode_pl) }}">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection