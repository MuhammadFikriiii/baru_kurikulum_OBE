@extends('layouts.app')

@section('title', 'Edit Pengguna')

@section('content')
    <div class="mx-20 mt-6">
        <h2 class="mb-5 text-3xl font-extrabold text-center">Edit User</h2>
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

            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-6">
                    <!-- Kolom Pertama -->
                    <div class="space-y-4">
                        <div>
                            <label for="name" class="block text-lg font-semibold mb-2">Nama</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                                required
                                class="w-full p-3 border border-black rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                        </div>

                        <div>
                            <label for="nip" class="block text-lg font-semibold mb-2">NIP</label>
                            <input type="text" id="nip" name="nip" value="{{ old('nip', $user->nip) }}"
                                required
                                class="w-full p-3 border border-black rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                        </div>

                        <div>
                            <label for="nohp" class="block text-lg font-semibold mb-2">No. HP</label>
                            <input type="number" id="nohp" name="nohp" value="{{ old('nohp', $user->nohp) }}"
                                required
                                class="w-full p-3 border border-black rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                        </div>

                        <div>
                            <label for="email" class="block text-lg font-semibold mb-2">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                                required
                                class="w-full p-3 border border-black rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                        </div>
                    </div>

                    <!-- Kolom Kedua -->
                    <div class="space-y-4">
                        <div>
                            <label for="role" class="block text-lg font-semibold mb-2">Role</label>
                            <select id="role" name="role" required
                                class="w-full p-3 border border-black rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin
                                </option>
                                <option value="wadir1" {{ old('role', $user->role) == 'wadir1' ? 'selected' : '' }}>Wadir 1
                                </option>
                                <option value="tim" {{ old('role', $user->role) == 'tim' ? 'selected' : '' }}>Tim
                                </option>
                                <option value="kaprodi" {{ old('role', $user->role) == 'kaprodi' ? 'selected' : '' }}>
                                    Kaprodi</option>
                                <option value="kajur" {{ old('role', $user->role) == 'kajur' ? 'selected' : '' }}>Kajur
                                </option>
                            </select>
                        </div>

                        <div id="prodi-container" style="display: none;">
                            <label for="kode_prodi" class="block text-lg font-semibold mb-2">Prodi</label>
                            <select name="kode_prodi" id="kode_prodi"
                                class="w-full p-3 border border-black rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                                <option value="">Pilih Prodi</option>
                                @foreach ($prodis as $prodi)
                                    <option value="{{ $prodi->kode_prodi }}"
                                        {{ old('kode_prodi', $user->kode_prodi) == $prodi->kode_prodi ? 'selected' : '' }}>
                                        {{ $prodi->nama_prodi }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div id="jurusan-container" style="display: none;">
                            <label for="id_jurusan" class="block text-lg font-semibold mb-2">Jurusan</label>
                            <select name="id_jurusan" id="id_jurusan"
                                class="w-full p-3 border border-black rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                                <option value="">Pilih Jurusan</option>
                                @foreach ($jurusans as $jurusan)
                                    <option value="{{ $jurusan->id_jurusan }}"
                                        {{ old('id_jurusan', $user->id_jurusan) == $jurusan->id_jurusan ? 'selected' : '' }}>
                                        {{ $jurusan->nama_jurusan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="status" class="block text-lg font-semibold">Status User</label>
                            <select name="status" id="status" required
                                class="w-full p-3 border border-black rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                                <option value="" disabled {{ old('status', $user->status) == '' ? 'selected' : '' }}>
                                    Pilih Status</option>
                                <option value="approved"
                                    {{ old('status', $user->status) == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="pending" {{ old('status', $user->status) == 'pending' ? 'selected' : '' }}>
                                    Pending</option>
                            </select>
                        </div>

                        <div>
                            <label for="password" class="block text-lg font-semibold">Password (Opsional)</label>
                            <input type="password" id="password" name="password"
                                class="w-full p-3 border border-black rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                            <p class="mt-2 text-sm text-gray-500 italic">*Kosongkan jika tidak ingin mengubah password*</p>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-5 pt-6">
                    <a href="{{ route('admin.users.index') }}"
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function toggleDropdowns() {
                let role = $('#role').val();

                $('#prodi-container').hide();
                $('#jurusan-container').hide();
                $('#kode_prodi').prop('required', false);
                $('#id_jurusan').prop('required', false);

                if (role === 'tim' || role === 'kaprodi') {
                    $('#prodi-container').show();
                    $('#kode_prodi').prop('required', true);
                } else if (role === 'kajur') {
                    $('#jurusan-container').show();
                    $('#id_jurusan').prop('required', true);
                }
            }

            toggleDropdowns();

            $('#role').change(function() {
                toggleDropdowns();
            });
        });
    </script>
@endsection
