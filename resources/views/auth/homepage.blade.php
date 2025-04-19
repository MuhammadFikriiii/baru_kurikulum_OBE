<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Poliban | Kurikulum</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body class="bg-gray-100 text-gray-800">
  
<header class="bg-white shadow-md w-full fixed top-0 z-50" x-data="{ open: false }">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16">
      <!-- Logo -->
      <a href="index.html" class="flex items-center">
        <img src="/image/Logo.png" alt="Logo" class="h-10">
      </a>
      <!-- Desktop Menu -->
      <nav class="hidden md:flex space-x-6 items-center">
        <a href="#top" class="text-gray-700 font-medium hover:text-blue-800">Beranda</a>
        <a href="#services" class="text-gray-700 hover:text-blue-600">Profil</a>
        <a href="#about" class="text-gray-700 hover:text-blue-600">Program Studi</a>
        <a href="#portfolio" class="text-gray-700 hover:text-blue-600">Mata Kuliah</a>
        <a href="#video" class="text-gray-700 hover:text-blue-600">Akademik</a>
        <a href="#contact" class="text-gray-700 hover:text-blue-600">Contact Us</a>
        <a href="{{ route('login') }}" class="bg-[#5460B5] text-white px-4 py-2 rounded hover:bg-blue-600 transition">
          <i class="bi bi-person"></i>
          <span class="ml-1">Login</span>
        </a>
      </nav>

      <!-- Toggle Button (Mobile Only) -->
      <button class="md:hidden text-gray-700 focus:outline-none" @click="open = !open">
        <svg class="w-6 h-6 transition-all duration-2500 transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <!-- Garis Menu (Hanya muncul ketika open = false) -->
          <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M4 6h16M4 12h16M4 18h16" />
          <!-- Ikon X (Hanya muncul ketika open = true) -->
          <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
      
    </div>

    <!-- Mobile Menu -->
    <div class="md:hidden mt-2" x-show="open" @click.away="open = false" x-transition>
      <nav class="flex flex-col space-y-2">
        <a href="#top" class="text-blue-600 font-medium">Beranda</a>
        <a href="#services" class="text-gray-700">Profil</a>
        <a href="#about" class="text-gray-700">Program Studi</a>
        <a href="#portfolio" class="text-gray-700">Mata Kuliah</a>
        <a href="#video" class="text-gray-700">Akademik</a>
        <a href="#contact" class="text-gray-700">Contact Us</a>
        <a href="{{ route('login') }}" class="bg-[#5460B5] text-white px-4 py-2 rounded hover:bg-blue-600 transition">
          <i class="bi bi-person"></i>
          <span class="ml-1">Login</span>
        </a>
      </nav>
    </div>
  </div>
</header>


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
 
  <footer class="bg-gray-800 text-white py-10">
    <div class="container mx-auto px-6">
      <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- About Section -->
        <div class="footer-item">
          <div class="logo mb-4">
            <a href="#"><img src="/image/Logo.png" class="h-24" alt="Onix Digital TemplateMo" class="w-32 h-auto"></a>
            <a href="mailto:info@company.com" class="block mb-2 mt-5 text-sm">info@poliban.ac.id</a>
          </div>
          
          <div>
            <ul class="flex space-x-4">
              <li><a href="https://www.facebook.com/poliban.ac.id" class="text-gray-400 hover:text-white text-xl"><i class="fab fa-facebook"></i></a></li>
              <li><a href="https://twitter.com/humaspoliban" class="text-gray-400 hover:text-white text-xl"><i class="fab fa-twitter"></i></a></li>
              <li><a href="https://www.instagram.com/poliban_official/" class="text-gray-400 hover:text-white text-xl"><i class="fab fa-instagram"></i></a></li>
              <li><a href="https://www.youtube.com/channel/UC5CfzvUTqEUPXhwwSLvP53Q" class="text-gray-400 hover:text-white text-xl"><i class="fab fa-youtube"></i></a></li>
            </ul>
          </div>
        </div>
        
        <!-- Services Section -->
        <div class="footer-item">
          <h4 class="font-semibold text-lg mb-6">Services</h4>
          <ul class="space-y-2">
            <li><a href="#" class="text-gray-400 hover:text-white">SEO Development</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white">Business Growth</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white">Social Media Management</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white">Website Optimization</a></li>
          </ul>
        </div>
        
        <!-- Community Section -->
        <div class="footer-item">
          <h4 class="font-semibold text-lg mb-6">Community</h4>
          <ul class="space-y-2">
            <li><a href="#" class="text-gray-400 hover:text-white">Digital Marketing</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white">Business Ideas</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white">Website Checkup</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white">Page Speed Test</a></li>
          </ul>
        </div>
        
        <!-- Subscribe -->
        <div class="footer-item">
          <h4 class="font-semibold text-lg mb-6">Subscribe Newsletters</h4>
          <p class="text-gray-400 mb-4">Get our latest news and ideas delivered to your inbox.</p>
          <form action="#" method="get" class="flex items-center space-x-2">
            <input type="email" name="email" id="email" placeholder="Your Email"
                   class="px-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#5460B5] w-full" required>
            <button type="submit"
                    class="bg-[#5460B5] text-white px-4 py-2 rounded-full hover:bg-blue-700 transition">
              <i class="fas fa-paper-plane"></i>
            </button>
          </form>
          
        </div>
  
      </div>
      
      <hr class="mt-7">
      <!-- Copyright Section -->
      <div class="text-center text-sm text-gray-400 mt-8">
        <p>Copyright &copy; 2025 Fikri & Habibie., All Rights Reserved.</p>
      </div>
    </div>
  </footer>
  
</body>
</html>
