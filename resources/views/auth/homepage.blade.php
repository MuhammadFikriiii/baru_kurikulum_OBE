<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Poliban | Kurikulum</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

  <!-- Navbar -->
  <nav class="bg-[#5460B5] text-white shadow-md py-4 px-6 flex justify-between items-center">
    <h1 class="text-xl font-bold">Sistem Kurikulum Poliban</h1>
    <ul class="flex space-x-6">
      <li><a href="#" class="hover:text-yellow-400">Beranda</a></li>
      <li><a href="#" class="hover:text-yellow-400">Tentang</a></li>
      <li><a href="#" class="hover:text-yellow-400">Kontak</a></li>
      <li><a href="{{ route('login') }}" class="hover:text-yellow-400">Masuk</a></li>
    </ul>
  </nav>

  <section class="w-full h-[500px] bg-cover bg-center flex items-center justify-center text-white" style="background-image: url('/image/poliban.jpeg'); background-position: center;">
    <div class="bg-black bg-opacity-50 p-10 rounded-lg text-center shadow-lg transform transition-all duration-300 hover:scale-105 hover:shadow-xl">
      <h2 class="text-5xl font-bold mb-4 text-gradient bg-clip-text text-transparent bg-gradient-to-r from-yellow-400 to-red-600 animate__animated animate__fadeIn">Selamat Datang di Sistem Kurikulum</h2>
      <p class="text-xl font-light mb-5">Politeknik Negeri Banjarmasin</p>
      <a href="#daftar-prodi" class="inline-block px-6 py-3 text-lg font-semibold bg-yellow-500 rounded-full hover:bg-yellow-600 transition duration-300">Lihat Program Studi</a>
    </div>
  </section>

  <!-- Informasi Kampus -->
  <section class="py-12 px-6 md:px-20 bg-white">
    <h3 class="text-2xl font-bold text-center text-[#201F31] mb-6">Tentang Politeknik Negeri Banjarmasin</h3>
    <p class="text-center text-gray-700 max-w-3xl mx-auto">
      Politeknik Negeri Banjarmasin (POLIBAN) merupakan perguruan tinggi vokasi di Kalimantan Selatan yang berfokus pada pendidikan terapan. Kampus ini memiliki berbagai jurusan dan program studi unggulan yang mendukung perkembangan teknologi dan industri di Indonesia.
    </p>
  </section>

  <!-- Daftar Kurikulum dan Program Studi -->
  <section class="py-12 px-6 md:px-20">
    <h3 class="text-2xl font-semibold mb-8 text-center text-[#201F31]">Daftar Jurusan dan Program Studi</h3>

    <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3">
      <!-- Jurusan Teknik Informatika -->
      <div class="bg-white shadow-md rounded-lg p-4 hover:shadow-xl transition">
        <h4 class="text-lg font-bold text-[#201F31]">Jurusan Teknik Informatika</h4>
        <div class="mt-2">
          <h5 class="text-md font-semibold">Program Studi:</h5>
          <ul class="mt-2 text-sm text-gray-600 list-disc list-inside">
            <li>Teknik Informatika</li>
            <li>Sistem Informasi Kota Cerdas</li>
          </ul>
        </div>
      </div>

      <!-- Jurusan Teknik Elektronika -->
      <div class="bg-white shadow-md rounded-lg p-4 hover:shadow-xl transition">
        <h4 class="text-lg font-bold text-[#201F31]">Jurusan Teknik Elektronika</h4>
        <div class="mt-2">
          <h5 class="text-md font-semibold">Program Studi:</h5>
          <ul class="mt-2 text-sm text-gray-600 list-disc list-inside">
            <li>Teknik Elektronika</li>
            <li>Teknologi Rekayasa Elektronika</li>
          </ul>
        </div>
      </div>

      <!-- Jurusan Teknik Sipil -->
      <div class="bg-white shadow-md rounded-lg p-4 hover:shadow-xl transition">
        <h4 class="text-lg font-bold text-[#201F31]">Jurusan Teknik Sipil</h4>
        <div class="mt-2">
          <h5 class="text-md font-semibold">Program Studi:</h5>
          <ul class="mt-2 text-sm text-gray-600 list-disc list-inside">
            <li>Teknik Sipil</li>
            <li>Manajemen Rekayasa Konstruksi</li>
          </ul>
        </div>
      </div>

      <!-- Jurusan Akuntansi -->
      <div class="bg-white shadow-md rounded-lg p-4 hover:shadow-xl transition">
        <h4 class="text-lg font-bold text-[#201F31]">Jurusan Akuntansi</h4>
        <div class="mt-2">
          <h5 class="text-md font-semibold">Program Studi:</h5>
          <ul class="mt-2 text-sm text-gray-600 list-disc list-inside">
            <li>Akuntansi</li>
            <li>Keuangan dan Perbankan</li>
          </ul>
        </div>
      </div>

      <!-- Jurusan Administrasi Bisnis -->
      <div class="bg-white shadow-md rounded-lg p-4 hover:shadow-xl transition">
        <h4 class="text-lg font-bold text-[#201F31]">Jurusan Administrasi Bisnis</h4>
        <div class="mt-2">
          <h5 class="text-md font-semibold">Program Studi:</h5>
          <ul class="mt-2 text-sm text-gray-600 list-disc list-inside">
            <li>Administrasi Bisnis</li>
            <li>Manajemen Informatika</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-[#5460B5] text-white text-center py-6 mt-10">
    <p class="text-sm">© 2025 Politeknik Negeri Banjarmasin. All rights reserved.</p>
  </footer>

</body>
</html>
