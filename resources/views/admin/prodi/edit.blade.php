@extends('layouts.app')

@section('title', 'Edit Prodi')

@section('content')
<div class="mx-20">
    <h2 class="mb-6 text-4xl font-extrabold text-center">Edit Prodi</h2>
    <hr class="border border-black mb-4">

    <div class="bg-white p-6 rounded-lg shadow-md">

        @if ($errors->any())
            <div class="text-red-600 mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.prodi.update', $prodi->kode_prodi) }}" method="POST" class="space-y-6 pt-4">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
               
                <div>
                    <label for="kode_jurusan" class="block text-lg font-semibold mb-2 text-gray-700">Jurusan</label>
                    <select name="kode_jurusan" id="kode_jurusan"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]" required>
                        @foreach ($jurusans as $jurusan)
                            <option value="{{ $jurusan->kode_jurusan }}" {{ $prodi->kode_jurusan == $jurusan->kode_jurusan ? 'selected' : '' }}>
                                {{ $jurusan->nama_jurusan }}
                            </option>
                        @endforeach
                    </select>
                </div>

              
                <div>
                    <label class="block text-lg font-semibold mb-2 text-gray-700">Kode Prodi</label>
                    <input type="text" name="kode_prodi" value="{{ old('kode_prodi', $prodi->kode_prodi) }}"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]" required>
                </div>

    
                <div>
                    <label class="block text-lg font-semibold mb-2 text-gray-700">Nama Prodi</label>
                    <input type="text" name="nama_prodi" value="{{ old('nama_prodi', $prodi->nama_prodi) }}"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]" required>
                </div>

                
                <div>
                    <label class="block text-lg font-semibold mb-2 text-gray-700">Perguruan Tinggi</label>
                    <input type="text" name="pt_prodi" value="{{ old('pt_prodi', $prodi->pt_prodi) }}"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]" required>
                </div>

                <div>
                    <label class="block text-lg font-semibold mb-2 text-gray-700">Tanggal Berdiri</label>
                    <input type="date" name="tgl_berdiri_prodi" value="{{ old('tgl_berdiri_prodi', $prodi->tgl_berdiri_prodi) }}"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]" required>
                </div>

  
                <div>
                    <label class="block text-lg font-semibold mb-2 text-gray-700">Tanggal Penyelenggaraan</label>
                    <input type="date" name="penyelenggaraan_prodi" value="{{ old('penyelenggaraan_prodi', $prodi->penyelenggaraan_prodi) }}"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]" required>
                </div>

                <div>
                    <label class="block text-lg font-semibold mb-2 text-gray-700">Nomor SK</label>
                    <input type="text" name="nomor_sk" value="{{ old('nomor_sk', $prodi->nomor_sk) }}"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]" required>
                </div>

           
                <div>
                    <label class="block text-lg font-semibold mb-2 text-gray-700">Tanggal SK</label>
                    <input type="date" name="tanggal_sk" value="{{ old('tanggal_sk', $prodi->tanggal_sk) }}"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]" required>
                </div>

              
                <div>
                    <label class="block text-lg font-semibold mb-2 text-gray-700">Peringkat Akreditasi</label>
                    <input type="text" name="peringkat_akreditasi" value="{{ old('peringkat_akreditasi', $prodi->peringkat_akreditasi) }}"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]" required>
                </div>

           
                <div>
                    <label class="block text-lg font-semibold mb-2 text-gray-700">Nomor SK BAN-PT</label>
                    <input type="text" name="nomor_sk_banpt" value="{{ old('nomor_sk_banpt', $prodi->nomor_sk_banpt) }}"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]" required>
                </div>

 
                <div>
                    <label class="block text-lg font-semibold mb-2 text-gray-700">Jenjang Pendidikan</label>
                    <input type="text" name="jenjang_pendidikan" value="{{ old('jenjang_pendidikan', $prodi->jenjang_pendidikan) }}"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]" required>
                </div>


                <div>
                    <label class="block text-lg font-semibold mb-2 text-gray-700">Gelar/Sebutan Lulusan</label>
                    <input type="text" name="gelar_lulusan" value="{{ old('gelar_lulusan', $prodi->gelar_lulusan) }}"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]" required>
                </div>

     
                <div>
                    <label class="block text-lg font-semibold mb-2 text-gray-700">No. Telepon</label>
                    <input type="text" name="telepon_prodi" value="{{ old('telepon_prodi', $prodi->telepon_prodi) }}"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                </div>

 
                <div>
                    <label class="block text-lg font-semibold mb-2 text-gray-700">No. Faksimili</label>
                    <input type="text" name="faksimili_prodi" value="{{ old('faksimili_prodi', $prodi->faksimili_prodi) }}"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                </div>

           
                <div>
                    <label class="block text-lg font-semibold mb-2 text-gray-700">Website</label>
                    <input type="text" name="website_prodi" value="{{ old('website_prodi', $prodi->website_prodi) }}"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                </div>

           
                <div>
                    <label class="block text-lg font-semibold mb-2 text-gray-700">Email</label>
                    <input type="email" name="email_prodi" value="{{ old('email_prodi', $prodi->email_prodi) }}"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-end space-x-5 mt-[50px]">
                <a href="{{ route('admin.prodi.index') }}"
                   class="px-6 py-2 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg transition duration-200">
                    Kembali
                </a>
                <button type="submit"
                        class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition duration-200">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
