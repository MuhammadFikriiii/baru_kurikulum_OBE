@extends('layouts.app')

@section('content')
    <div class="mx-20 mt-6">
        <h2 class="font-extrabold text-3xl mb-5 text-center">Tambah User</h2>
        <hr class="border-t-2 md:border-t-4 border-black my-3 md:my-4 mx-auto">

        <div class="bg-white px-6 pb-6 rounded-lg shadow-md">

            @if ($errors->any())
                <div style="color: red;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-6">
                    <!-- Kolom Pertama -->
                    <div class="space-y-4">
                        <div>
                            <label for="name" class="block text-lg font-semibold mb-2">Nama</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                class="w-full p-3 border border-black rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                        </div>

                        <div>
                            <label for="nip" class="block text-lg font-semibold mb-2">NIP</label>
                            <input type="text" id="nip" name="nip" value="{{ old('nip') }}" required
                                class="w-full p-3 border border-black rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                        </div>

                        <div>
                            <label for="nohp" class="block text-lg font-semibold mb-2">No. HP</label>
                            <input type="number" id="nohp" name="nohp" value="{{ old('nohp') }}" required
                                class="w-full p-3 border border-black rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                        </div>

                        <div>
                            <label for="email" class="block text-lg font-semibold mb-2">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                class="w-full p-3 border border-black rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                        </div>
                    </div>

                    <!-- Kolom Kedua -->
                    <div class="space-y-4">
                        <div>
                            <label for="role" class="block text-lg font-semibold mb-2">Role</label>
                            <select id="role" name="role" required
                                class="w-full p-3 border border-black rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                                <option value="" disabled selected>Pilih Role</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="wadir1" {{ old('role') == 'wadir1' ? 'selected' : '' }}>Wadir 1</option>
                                <option value="tim" {{ old('role') == 'tim' ? 'selected' : '' }}>Tim</option>
                                <option value="kaprodi" {{ old('role') == 'kaprodi' ? 'selected' : '' }}>Kaprodi</option>
                            </select>
                        </div>

                        <div>
                            <label for="kode_prodi" class="block text-lg font-semibold mb-2">Prodi</label>
                            <select name="kode_prodi" id="kode_prodi"
                                class="w-full p-3 border border-black rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                                <option value="">Pilih Prodi</option>
                                @foreach ($prodis as $prodi)
                                    <option value="{{ $prodi->kode_prodi }}"
                                        {{ old('kode_prodi') == $prodi->kode_prodi ? 'selected' : '' }}>
                                        {{ $prodi->nama_prodi }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="text-sm text-gray-500 italic">*Kosongkan bila user admin/wadir1*</p>
                        </div>

                        <div>
                            <label for="status" class="block text-lg font-semibold">Status User</label>
                            <select name="status" id="status" required
                                class="w-full p-3 border border-black rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                                <option value="" disabled selected>Pilih Status</option>
                                <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>Approved
                                </option>
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            </select>
                        </div>

                        <div class="">
                            <label for="password" class="block text-lg font-semibold mb-1">Password</label>
                            <input type="password" id="password" name="password" required
                                class="w-full p-3 border border-black rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-5 pt-6">
                    <a href="{{ route('admin.users.index') }}"
                        class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition duration-200">
                        Kembali
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition duration-200">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
