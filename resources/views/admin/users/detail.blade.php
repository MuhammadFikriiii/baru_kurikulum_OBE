@extends('layouts.app')

@section('content')
    <div class="mx-20 mt-6">
        <h2 class="font-extrabold text-3xl mb-5 text-center">Detail User</h2>
        <hr class="border-t-2 md:border-t-4 border-black my-3 md:my-4 mx-auto">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-6 bg-white p-6 rounded-lg shadow-md">
            <!-- Kolom Pertama -->
            <div class="space-y-4">
                <div>
                    <label for="name" class="text-lg font-semibold mb-2">Nama</label>
                    <input type="text" id="name" name="name" value="{{ $user->name }}" readonly
                        class="w-full p-3 border border-black rounded-lg focus:outline-none">
                </div>

                <div>
                    <label for="nip" class="text-lg font-semibold mb-2">NIP</label>
                    <input type="text" id="nip" name="nip" value="{{ $user->nip }}" readonly
                        class="w-full p-3 border border-black rounded-lg focus:outline-none">
                </div>

                <div>
                    <label for="nohp" class="text-lg font-semibold mb-2">NOHP</label>
                    <input type="text" id="nohp" name="nohp" value="{{ $user->nohp }}" readonly
                        class="w-full p-3 border border-black rounded-lg focus:outline-none">
                </div>

                <div>
                    <label for="email" class="text-lg font-semibold mb-2">Email</label>
                    <input type="text" id="email" name="email" value="{{ $user->email }}" readonly
                        class="w-full p-3 border border-black rounded-lg focus:outline-none">
                </div>
            </div>

            <!-- Kolom Kedua -->
            <div class="space-y-4">
                <div class="">
                    <label for="role" class="text-lg font-semibold mb-2">Role</label>
                    <input type="text" id="role" name="role" value="{{ $user->role }}" readonly
                        class="w-full p-3 border border-black rounded-lg focus:outline-none">
                </div>

                <div>
                    <label for="prodi" class="text-lg font-semibold">Prodi</label>
                    <input type="text" id="prodi" name="prodi" value="{{ $user->prodi->nama_prodi ?? '' }}"
                        readonly class="w-full p-3 border border-black rounded-lg focus:outline-none">
                </div>

                <div>
                    <label for="status" class="text-lg font-semibold">Status</label>
                    <input type="text" id="status" name="status" value="{{ $user->status }}" readonly
                        class="w-full p-3 border border-black rounded-lg focus:outline-none">
                </div>

            </div>

            <div class="flex justify-start pt-6">
                <a href="{{ route('admin.users.index') }}"
                    class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition duration-200">
                    Kembali
                </a>
            </div>
        </div>
    </div>
@endsection
