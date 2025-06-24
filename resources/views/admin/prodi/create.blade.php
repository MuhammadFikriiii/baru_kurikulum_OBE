@extends('layouts.app')

@section('content')
<div class="mx-20">
    <h2 class="font-extrabold text-4xl mb-6 text-center">Tambah Prodi</h2>
    <hr class="w-full border border-black mb-4">

    <div class="bg-white p-6 rounded-lg shadow-md">
        @if ($errors->any())
            <div class="text-red-600 mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.prodi.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
             
                <div>
                    <label for="id_jurusan" class="block text-lg font-semibold mb-2 text-gray-700">Jurusan</label>
                    <select name="id_jurusan" id="id_jurusan" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-[#fbfffd]">
                        <option value="" selected disabled>Pilih Jurusan</option>
                        @foreach ($jurusans as $jurusan)
                            <option value="{{ $jurusan->id_jurusan }}">{{ $jurusan->nama_jurusan }}</option>
                        @endforeach
                    </select>
                </div>

                
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
@endsection
