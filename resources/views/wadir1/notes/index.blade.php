@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">

    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Catatan Wadir</h1>
        <hr class="border-t-4 border-black my-4 mx-auto mb-4">
    </div>

    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('wadir1.notes.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md">
            Tambah Catatan
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-green-800 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left font-medium uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left font-medium uppercase tracking-wider">Prodi</th>
                        <th class="px-6 py-3 text-left font-medium uppercase tracking-wider">Dibuat Oleh</th>
                        <th class="px-6 py-3 text-left font-medium uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left font-medium uppercase tracking-wider">Catatan</th>
                        <th class="px-6 py-3 text-left font-medium uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($notes as $index => $note)
                    <tr class="{{ $index % 2 == 0 ? 'bg-gray-50' : 'bg-white' }} hover:bg-gray-100">
                        <td class="px-6 py-4">{{ $notes->firstItem() + $index }}</td>
                        <td class="px-6 py-4">{{ $note->prodi->nama_prodi }}</td>
                        <td class="px-6 py-4">{{ $note->author->name }}</td>
                        <td class="px-6 py-4">{{ $note->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-6 py-4 whitespace-pre-line">{{ $note->note }}</td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-2">
                                <a href="{{ route('wadir.notes.edit', $note->id) }}" 
                                   class="bg-blue-600 hover:bg-blue-700 text-white p-2 rounded-md"
                                   title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                    </svg>
                                </a>
                                <form action="{{ route('wadir.notes.destroy', $note->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-red-600 hover:bg-red-700 text-white p-2 rounded-md"
                                            title="Hapus"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus catatan ini?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
            {{ $notes->links() }}
        </div>
    </div>
</div>
@endsection