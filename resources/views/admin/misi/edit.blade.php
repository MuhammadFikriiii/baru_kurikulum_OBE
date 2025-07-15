@extends('layouts.app')

@section('content')
    <div class="mx-20 mt-6">
        <h2 class="font-extrabold text-3xl mb-5 text-center">Edit Misi</h2>
        <hr class="border-t-2 md:border-t-4 border-black my-3 md:my-4 mx-auto">

        <div class="bg-white px-6 pb-6 pt-2 rounded-lg shadow-md">
            @if ($errors->any())
                <div class="mb-4 text-red-600">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.misi.update', $misi->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="visi_id" class="block text-lg font-semibold mb-2 text-gray-700">Visi Terkait</label>
                    <select name="visi_id" id="visi_id" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                        @foreach ($visis as $visi)
                            <option value="{{ $visi->id }}" {{ $misi->visi_id == $visi->id ? 'selected' : '' }}>
                                {{ $visi->visi }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="misi" class="block text-lg font-semibold mb-2 text-gray-700">Misi</label>
                    <textarea id="misi" name="misi" rows="4" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">{{ old('misi', $misi->misi) }}</textarea>
                </div>

                <div class="flex justify-end space-x-5 pt-6">
                    <a href="{{ route('admin.misi.index') }}"
                        class="px-6 py-2 bg-blue-600 hover:bg-blue-900 text-white font-semibold rounded-lg transition duration-200">
                        Kembali
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-green-600 hover:bg-green-800 text-white font-semibold rounded-lg transition duration-200">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
