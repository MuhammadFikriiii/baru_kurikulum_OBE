@extends('layouts.app')

@section('content')
    <div class="mx-20">
        <h2 class="font-extrabold text-4xl mb-6 text-center">Tambah Prodi</h2>
        <hr class="w-full border border-black mb-4">

<<<<<<< HEAD
=======
    <div class="bg-white p-6 rounded-lg shadow-md">
>>>>>>> f29bc42dcb447412a22f2346a79a04e7b4bbe78d
        @if ($errors->any())
            <div class="text-red-600 mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

<<<<<<< HEAD
        <form action="{{ route('admin.prodi.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                <div>
                    <label for="id_jurusan" class="text-xl font-semibold">Jurusan:</label>
                    <select name="id_jurusan" id="id_jurusan" required
                        class="w-full mt-1 p-3 border border-black rounded-lg focus:ring-blue-500 focus:border-blue-500">
=======
        <form action="{{ route('admin.prodi.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
             
                <div>
                    <label for="id_jurusan" class="block text-lg font-semibold mb-2 text-gray-700">Jurusan</label>
                    <select name="id_jurusan" id="id_jurusan" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
>>>>>>> f29bc42dcb447412a22f2346a79a04e7b4bbe78d
                        <option value="" selected disabled>Pilih Jurusan</option>
                        @foreach ($jurusans as $jurusan)
                            <option value="{{ $jurusan->id_jurusan }}">{{ $jurusan->nama_jurusan }}</option>
                        @endforeach
                    </select>
                </div>

<<<<<<< HEAD
                <div>
                    <label for="kode_prodi" class="text-xl font-semibold">Kode Prodi:</label>
                    <input type="text" name="kode_prodi" id="kode_prodi" required
                        class="w-full mt-1 p-3 border border-black rounded-lg">
                </div>

                <div>
                    <label for="nama_prodi" class="text-xl font-semibold">Nama Prodi:</label>
                    <input type="text" name="nama_prodi" id="nama_prodi" required
                        class="w-full mt-1 p-3 border border-black rounded-lg">
                </div>

                <div>
                    <label class="text-xl font-semibold">Tanggal Berdiri:</label>
                    <input type="date" name="tgl_berdiri_prodi" required
                        class="w-full p-3 border border-black rounded-lg">
                </div>

                <div>
                    <label class="text-xl font-semibold">Tanggal Penyelenggaraan:</label>
                    <input type="date" name="penyelenggaraan_prodi" required
                        class="w-full p-3 border border-black rounded-lg">
                </div>

                <div>
                    <label class="text-xl font-semibold">Nomor SK:</label>
                    <input type="text" name="nomor_sk" required class="w-full p-3 border border-black rounded-lg">
                </div>

                <div>
                    <label class="text-xl font-semibold">Tanggal SK:</label>
                    <input type="date" name="tanggal_sk" required class="w-full p-3 border border-black rounded-lg">
                </div>

                <div>
                    <label class="text-xl font-semibold">Peringkat Akreditasi:</label>
                    <select name="peringkat_akreditasi" required class="w-full p-3 border border-black rounded-lg">
                        <option value="" disabled selected>Pilih Akreditasi</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                    </select>
                </div>

                <div>
                    <label class="text-xl font-semibold">Nomor SK BAN-PT:</label>
                    <input type="text" name="nomor_sk_banpt" required class="w-full p-3 border border-black rounded-lg">
                </div>

                <div>
                    <label class="text-xl font-semibold">Jenjang Pendidikan:</label>
                    <select name="jenjang_pendidikan" required class="w-full p-3 border border-black rounded-lg">
                        <option value="" disabled selected>Pilih Jenjang</option>
                        <option value="D3">D3</option>
                        <option value="D4">D4</option>
                    </select>
                </div>

                <div>
                    <label class="text-xl font-semibold">Gelar/Sebutan Lulusan:</label>
                    <input type="text" name="gelar_lulusan" class="w-full p-3 border border-black rounded-lg">
                </div>

                <div>
                    <label class="text-xl font-semibold">No. Telepon:</label>
                    <input type="text" name="telepon_prodi" class="w-full p-3 border border-black rounded-lg">
                </div>

                <div>
                    <label class="text-xl font-semibold">No. Faksimili:</label>
                    <input type="text" name="faksimili_prodi" class="w-full p-3 border border-black rounded-lg">
                </div>

                <div>
                    <label class="text-xl font-semibold">Website:</label>
                    <input type="text" name="website_prodi" class="w-full p-3 border border-black rounded-lg">
                </div>

                <div>
                    <label class="text-xl font-semibold">Email:</label>
                    <input type="email" name="email_prodi" class="w-full p-3 border border-black rounded-lg">
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white px-6 py-2 rounded-lg">
                    Simpan
                </button>
                <a href="{{ route('admin.prodi.index') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white px-6 py-2 rounded-lg ml-4">
                    Kembali
                </a>
            </div>
        </form>
    </div>
=======
                
                <div>
                    <label for="kode_prodi" class="block text-lg font-semibold mb-2 text-gray-700">Kode Prodi</label>
                    <input type="text" name="kode_prodi" id="kode_prodi" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                </div>

                
                <div>
                    <label for="nama_prodi" class="block text-lg font-semibold mb-2 text-gray-700">Nama Prodi</label>
                    <input type="text" name="nama_prodi" id="nama_prodi" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                </div>

              
                <div>
                    <label class="block text-lg font-semibold mb-2 text-gray-700">Perguruan Tinggi</label>
                    <input type="text" name="pt_prodi" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                </div>

                
                <div>
                    <label class="block text-lg font-semibold mb-2 text-gray-700">Tanggal Berdiri</label>
                    <input type="date" name="tgl_berdiri_prodi" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                </div>

                <div>
                    <label class="block text-lg font-semibold mb-2 text-gray-700">Tanggal Penyelenggaraan</label>
                    <input type="date" name="penyelenggaraan_prodi" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                </div>

                <div>
                    <label class="block text-lg font-semibold mb-2 text-gray-700">Nomor SK</label>
                    <input type="text" name="nomor_sk" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                </div>


                <div>
                    <label class="block text-lg font-semibold mb-2 text-gray-700">Tanggal SK</label>
                    <input type="date" name="tanggal_sk" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                </div>

                <div>
                    <label class="block text-lg font-semibold mb-2 text-gray-700">Peringkat Akreditasi</label>
                    <input type="text" name="peringkat_akreditasi"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                </div>

 
                <div>
                    <label class="block text-lg font-semibold mb-2 text-gray-700">Nomor SK BAN-PT</label>
                    <input type="text" name="nomor_sk_banpt" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                </div>

                <div>
                    <label class="block text-lg font-semibold mb-2 text-gray-700">Jenjang Pendidikan</label>
                    <input type="text" name="jenjang_pendidikan"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                </div>

       
                <div>
                    <label class="block text-lg font-semibold mb-2 text-gray-700">Gelar/Sebutan Lulusan</label>
                    <input type="text" name="gelar_lulusan"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                </div>

 
                <div>
                    <label class="block text-lg font-semibold mb-2 text-gray-700">No. Telepon</label>
                    <input type="text" name="telepon_prodi"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                </div>

                <div>
                    <label class="block text-lg font-semibold mb-2 text-gray-700">No. Faksimili</label>
                    <input type="text" name="faksimili_prodi"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                </div>

     
                <div>
                    <label class="block text-lg font-semibold mb-2 text-gray-700">Website</label>
                    <input type="text" name="website_prodi"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                </div>

                <div>
                    <label class="block text-lg font-semibold mb-2 text-gray-700">Email</label>
                    <input type="email" name="email_prodi"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-end space-x-5 pt-6">
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
>>>>>>> f29bc42dcb447412a22f2346a79a04e7b4bbe78d
@endsection
