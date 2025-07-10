@extends('layouts.app')

@section('title', 'Edit Prodi')

@section('content')
    <div class="mx-20 mt-6">
        <h2 class="text-3xl font-extrabold mb-5 text-center">Edit Prodi</h2>
        <hr class="border-t-2 md:border-t-4 border-black my-3 md:my-4 mx-auto">

        <div class="bg-white px-6 pb-6 rounded-lg shadow-md">
            @if ($errors->any())
                <div class="text-red-600 mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.prodi.update', $prodi->kode_prodi) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-6">
                    <div class="space-y-4">
                        <!-- Jurusan -->
                        <div>
                            <label for="id_jurusan" class="block text-lg font-semibold mb-2 text-gray-700">Jurusan</label>
                            <select name="id_jurusan" id="id_jurusan" class="w-full p-3 border border-gray-300 rounded-lg"
                                required>
                                @foreach ($jurusans as $jurusan)
                                    <option value="{{ $jurusan->id_jurusan }}"
                                        {{ $prodi->id_jurusan == $jurusan->id_jurusan ? 'selected' : '' }}>
                                        {{ $jurusan->nama_jurusan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Kode Prodi -->
                        <div>
                            <label class="block text-lg font-semibold mb-2 text-gray-700">Kode Prodi</label>
                            <input type="text" name="kode_prodi" value="{{ old('kode_prodi', $prodi->kode_prodi) }}"
                                class="w-full p-3 border border-gray-300 rounded-lg" required>
                        </div>

                        <!-- Nama Prodi -->
                        <div>
                            <label class="block text-lg font-semibold mb-2 text-gray-700">Nama Prodi</label>
                            <input type="text" name="nama_prodi" value="{{ old('nama_prodi', $prodi->nama_prodi) }}"
                                class="w-full p-3 border border-gray-300 rounded-lg" required>
                        </div>

                        <!-- Nama Prodi -->
                        <div>
                            <label class="block text-lg font-semibold mb-2 text-gray-700">Nama Kaprodi</label>
                            <input type="text" name="nama_kaprodi"
                                value="{{ old('nama_kaprodi', $prodi->nama_kaprodi) }}"
                                class="w-full p-3 border border-gray-300 rounded-lg" required>
                        </div>

                        <!-- Nama Prodi -->
                        <div>
                            <label class="block text-lg font-semibold mb-2 text-gray-700">Visi Keilmuan</label>
                            <input type="text" name="visi_prodi" value="{{ old('visi_prodi', $prodi->visi_prodi) }}"
                                class="w-full p-3 border border-gray-300 rounded-lg" required>
                        </div>

                        <!-- Tanggal Berdiri -->
                        <div>
                            <label class="block text-lg font-semibold mb-2 text-gray-700">Tanggal Berdiri</label>
                            <input type="date" name="tgl_berdiri_prodi"
                                value="{{ old('tgl_berdiri_prodi', $prodi->tgl_berdiri_prodi) }}"
                                class="w-full p-3 border border-gray-300 rounded-lg" required>
                        </div>

                        <!-- Tanggal Penyelenggaraan -->
                        <div>
                            <label class="block text-lg font-semibold mb-2 text-gray-700">Tanggal Penyelenggaraan</label>
                            <input type="date" name="penyelenggaraan_prodi"
                                value="{{ old('penyelenggaraan_prodi', $prodi->penyelenggaraan_prodi) }}"
                                class="w-full p-3 border border-gray-300 rounded-lg" required>
                        </div>

                        <!-- Nomor SK -->
                        <div>
                            <label class="block text-lg font-semibold mb-2 text-gray-700">Nomor SK</label>
                            <input type="text" name="nomor_sk" value="{{ old('nomor_sk', $prodi->nomor_sk) }}"
                                class="w-full p-3 border border-gray-300 rounded-lg" required>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <!-- Peringkat Akreditasi -->
                        <div>
                            <label class="block text-lg font-semibold mb-2 text-gray-700">Peringkat Akreditasi</label>
                            <select name="peringkat_akreditasi" class="w-full p-3 border border-gray-300 rounded-lg"
                                required>
                                <option value="A" {{ $prodi->peringkat_akreditasi == 'A' ? 'selected' : '' }}>A
                                </option>
                                <option value="B" {{ $prodi->peringkat_akreditasi == 'B' ? 'selected' : '' }}>B
                                </option>
                                <option value="C" {{ $prodi->peringkat_akreditasi == 'C' ? 'selected' : '' }}>C
                                </option>
                            </select>
                        </div>

                        <!-- Nomor SK BAN-PT -->
                        <div>
                            <label class="block text-lg font-semibold mb-2 text-gray-700">Nomor SK BAN-PT</label>
                            <input type="text" name="nomor_sk_banpt"
                                value="{{ old('nomor_sk_banpt', $prodi->nomor_sk_banpt) }}"
                                class="w-full p-3 border border-gray-300 rounded-lg" required>
                        </div>

                        <!-- Jenjang Pendidikan -->
                        <div>
                            <label class="block text-lg font-semibold mb-2 text-gray-700">Jenjang Pendidikan</label>
                            <select name="jenjang_pendidikan" class="w-full p-3 border border-gray-300 rounded-lg" required>
                                <option value="D3" {{ $prodi->jenjang_pendidikan == 'D3' ? 'selected' : '' }}>D3
                                </option>
                                <option value="D4" {{ $prodi->jenjang_pendidikan == 'D4' ? 'selected' : '' }}>D4
                                </option>
                            </select>
                        </div>

                        <!-- Gelar Lulusan -->
                        <div>
                            <label class="block text-lg font-semibold mb-2 text-gray-700">Gelar/Sebutan Lulusan</label>
                            <input type="text" name="gelar_lulusan"
                                value="{{ old('gelar_lulusan', $prodi->gelar_lulusan) }}"
                                class="w-full p-3 border border-gray-300 rounded-lg" required>
                        </div>

                        <!-- Telepon -->
                        <div>
                            <label class="block text-lg font-semibold mb-2 text-gray-700">No. Telepon</label>
                            <input type="text" name="telepon_prodi"
                                value="{{ old('telepon_prodi', $prodi->telepon_prodi) }}"
                                class="w-full p-3 border border-gray-300 rounded-lg">
                        </div>

                        <!-- Website -->
                        <div>
                            <label class="block text-lg font-semibold mb-2 text-gray-700">Website</label>
                            <input type="text" name="website_prodi"
                                value="{{ old('website_prodi', $prodi->website_prodi) }}"
                                class="w-full p-3 border border-gray-300 rounded-lg">
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-lg font-semibold mb-2 text-gray-700">Email</label>
                            <input type="email" name="email_prodi" value="{{ old('email_prodi', $prodi->email_prodi) }}"
                                class="w-full p-3 border border-gray-300 rounded-lg">
                        </div>

                        <!-- Tanggal SK -->
                        <div>
                            <label class="block text-lg font-semibold mb-2 text-gray-700">Tanggal SK</label>
                            <input type="date" name="tanggal_sk" value="{{ old('tanggal_sk', $prodi->tanggal_sk) }}"
                                class="w-full p-3 border border-gray-300 rounded-lg" required>
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-end space-x-5 pt-6">
                    <a href="{{ route('admin.prodi.index') }}"
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
