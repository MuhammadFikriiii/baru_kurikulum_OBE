@extends('layouts.app')

@section('content')
    <div class="bg-white p-4 md:p-6 lg:p-8 rounded-lg shadow-md mx-2 md:mx-0">
        <h1 class="text-3xl font-bold mb-4 text-center">Catatan</h1>
        <hr class="border-t-2 md:border-t-4 border-black my-3 md:my-4 mx-auto">

        @if ($notes->isEmpty())
            <div class="bg-white rounded-lg shadow p-8 mt-8 text-center text-gray-500">
                Belum ada catatan yang diberikan.
            </div>
        @else
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-green-800 text-white">
                            <tr class="text-center">
                                <th class="px-6 py-3">No</th>
                                <th class="px-6 py-3">Judul</th>
                                <th class="px-6 py-3">Dibuat Oleh</th>
                                <th class="px-6 py-3">Catatan</th>
                                <th class="px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($notes as $index => $note)
                                <tr class="{{ $index % 2 == 0 ? 'bg-gray-50' : 'bg-white' }}">
                                    <td class="px-6 py-4 text-center">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 text-center">{{ $note->title ?? '-' }}</td>
                                    <td class="px-6 py-4 text-center">{{ $note->user->name ?? '-' }}</td>
                                    <td class="px-6 py-4 text-center">{{ Str::limit($note->note_content, 50) }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <a href="{{ route('admin.notes.detail', $note->id_note) }}"
                                            class="bg-blue-600 hover:bg-blue-800 text-white px-3 py-1 rounded-md text-sm">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection
