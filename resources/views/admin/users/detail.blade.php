@extends('layouts.app')

@section('title', 'Detail Pengguna')

@section('content')
    <div class="mx-20 mt-6">
        <h2 class="mb-5 text-3xl font-extrabold text-center">Detail User</h2>
        <hr class="border-t-2 md:border-t-4 border-black my-3 md:my-4 mx-auto">

        <div class="bg-white px-6 pb-6 rounded-lg shadow-md">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-6">
                <!-- Kolom Pertama -->
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-lg font-semibold mb-2">Nama</label>
                        <input type="text" id="name" name="name" value="{{ $user->name }}" readonly
                            class="w-full p-3 border border-black rounded-lg focus:outline-none">
                    </div>

                    <div>
                        <label for="nip" class="block text-lg font-semibold mb-2">NIP</label>
                        <input type="text" id="nip" name="nip" value="{{ $user->nip }}" readonly
                            class="w-full p-3 border border-black rounded-lg focus:outline-none">
                    </div>

                    <div>
                        <label for="nohp" class="block text-lg font-semibold mb-2">No. HP</label>
                        <input type="text" id="nohp" name="nohp" value="{{ $user->nohp }}" readonly
                            class="w-full p-3 border border-black rounded-lg focus:outline-none">
                    </div>

                    <div>
                        <label for="email" class="block text-lg font-semibold mb-2">Email</label>
                        <input type="text" id="email" name="email" value="{{ $user->email }}" readonly
                            class="w-full p-3 border border-black rounded-lg focus:outline-none">
                    </div>
                </div>

                <!-- Kolom Kedua -->
                <div class="space-y-4">
                    <div>
                        <label for="role" class="block text-lg font-semibold mb-2">Role</label>
                        <input type="text" id="role" name="role" value="{{ $user->role }}" readonly
                            class="w-full p-3 border border-black rounded-lg focus:outline-none">
                    </div>

                    @if ($user->role === 'tim' || $user->role === 'kaprodi')
                        <div>
                            <label for="prodi" class="block text-lg font-semibold mb-2">Prodi</label>
                            <input type="text" id="prodi" name="prodi" value="{{ $user->prodi->nama_prodi ?? '-' }}"
                                readonly class="w-full p-3 border border-black rounded-lg focus:outline-none">
                        </div>
                    @elseif ($user->role === 'kajur')
                        <div>
                            <label for="jurusan" class="block text-lg font-semibold mb-2">Jurusan</label>
                            <input type="text" id="jurusan" name="jurusan" value="{{ $user->jurusan->nama_jurusan ?? '-' }}"
                                readonly class="w-full p-3 border border-black rounded-lg focus:outline-none">
                        </div>
                    @endif

                    <div>
                        <label for="status" class="block text-lg font-semibold mb-2">Status User</label>
                        <input type="text" id="status" name="status" value="{{ $user->status }}" readonly
                            class="w-full p-3 border border-black rounded-lg focus:outline-none">
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-6">
                <a href="{{ route('admin.users.index') }}"
                    class="px-6 py-2 bg-blue-600 hover:bg-blue-900 text-white font-semibold rounded-lg transition duration-200">
                    Kembali
                </a>
            </div>
        </div>
    </div>
@endsection
