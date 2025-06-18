@extends('layouts.wadir1.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Catatan Wadir</h1>
        <hr class="border-t-4 border-black my-4 mx-auto mb-4">
    </div>

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <a href="{{ route('wadir1.notes.create') }}" 
           class="bg-green-600 hover:bg-green-800 text-white font-bold px-4 py-2 rounded-md inline-flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Tambah
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-green-800 text-white">
                    <tr class="text-center">
                        <th class="px-6 py-3 font-medium uppercase tracking-wider border-gray-200">No</th>
                        <th class="px-6 py-3 font-medium uppercase tracking-wider border-gray-200">Prodi</th>
                        <th class="px-6 py-3 font-medium uppercase tracking-wider border-gray-200">Dibuat Oleh</th>
                        <th class="px-6 py-3 font-medium uppercase tracking-wider border-gray-200">Catatan</th>
                        <th class="px-6 py-3 font-medium uppercase tracking-wider border-gray-200">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($notes as $index => $note)
                    <tr class="{{ $index % 2 == 0 ? 'bg-gray-50' : 'bg-white' }} hover:bg-gray-100">
                        <td class="px-6 py-4 text-center border border-gray-200">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 text-center border border-gray-200">{{ $note->prodi->nama_prodi ?? '-' }}</td>
                        <td class="px-6 py-4 text-center border border-gray-200">{{ $note->user->name ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-pre-line text-center border border-gray-200">{{ $note->note_content }}</td>
                        <td class="px-6 py-4 text-center border border-gray-200">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('wadir1.notes.detail', ['note' => $note->id_note]) }}" 
                                   class="bg-gray-600 hover:bg-gray-700 text-white p-2 rounded-md inline-flex items-center justify-center" title="Detail">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10A8 8 0 11 2 10a8 8 0 0116 0zm-9-3a1 1 0 112 0 1 1 0 01-2 0zm2 5a1 1 0 10-2 0v2a1 1 0 102 0v-2z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                                <a href="{{ route('wadir1.notes.edit', ['note' => $note->id_note]) }}" 
                                   class="bg-blue-600 hover:bg-blue-800 text-white p-2 rounded-md inline-flex items-center justify-center" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                    </svg>
                                </a> 
                                <form action="{{ route('wadir1.notes.destroy', ['note' => $note->id_note]) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Apakah Anda yakin ingin menghapus catatan ini?')" type="submit" class="bg-red-600 hover:bg-red-800 text-white p-2 rounded-md inline-flex items-center justify-center"
                                            title="Hapus" onclick="return confirm('Hapus catatan ini?')">
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


    </div>
</div>
@endsection
