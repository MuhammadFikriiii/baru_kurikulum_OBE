@extends('layouts.app')

@section('content')

<div class="ml-20 mr-20">
    <h1 class="font-extrabold text-4xl mb-6 text-center">Daftar Penilaian</h1>
    <hr class="border border-black mb-4 p-4">

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="py-2 px-4 border-b">No</th>
                    <th class="py-2 px-4 border-b">Mata Kuliah</th>
                    <th class="py-2 px-4 border-b">CPL</th>
                    <th class="py-2 px-4 border-b">CPMK</th>
                    <th class="py-2 px-4 border-b">Kuis</th>
                    <th class="py-2 px-4 border-b">Tugas</th>
                    <th class="py-2 px-4 border-b">Presentasi</th>
                    <th class="py-2 px-4 border-b">UTS</th>
                    <th class="py-2 px-4 border-b">UAS</th>
                    <th class="py-2 px-4 border-b">Project</th>
                    <th class="py-2 px-4 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($penilaians as $index => $penilaian)
                <tr>
                    <td class="py-2 px-4 border-b text-center">{{ $index + 1 }}</td>
                    <td class="py-2 px-4 border-b">{{ $penilaian->mataKuliah->nama_mk ?? '-' }}</td>
                    <td class="py-2 px-4 border-b">{{ $penilaian->cpl->deskripsi_cpl ?? '-' }}</td>
                    <td class="py-2 px-4 border-b">{{ $penilaian->cpmk->deskripsi_cpmk ?? '-' }}</td>
                    <td class="py-2 px-4 border-b text-center">{{ $penilaian->kuis }}</td>
                    <td class="py-2 px-4 border-b text-center">{{ $penilaian->observasi }}</td>
                    <td class="py-2 px-4 border-b text-center">{{ $penilaian->presentasi }}</td>
                    <td class="py-2 px-4 border-b text-center">{{ $penilaian->uts }}</td>
                    <td class="py-2 px-4 border-b text-center">{{ $penilaian->uas }}</td>
                    <td class="py-2 px-4 border-b text-center">{{ $penilaian->project }}</td>
                    <td class="py-2 px-4 border-b text-center">
                        <a href="{{ route('admin.penilaian.edit', $penilaian->id_penilaian) }}" 
                           class="bg-blue-500 hover:bg-blue-700 text-white px-3 py-1 rounded-lg mr-2">
                            Edit
                        </a>
                        <form action="{{ route('admin.penilaian.destroy', $penilaian->id_penilaian) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-500 hover:bg-red-700 text-white px-3 py-1 rounded-lg"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus penilaian ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <a href="{{ route('admin.penilaian.create') }}" 
           class="bg-green-500 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
            Tambah
        </a>
    </div>
</div>
@endsection