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

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
 
  <script>
    $(document).ready(function(){
      const owl = $(".owl-banner");
  
      // Inisialisasi owl carousel
      owl.owlCarousel({
        loop: true,
        margin: 30,
        nav: false,
        dots: true,
        items: 1,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true
      });
  
      // Mengatur angka pada dots
      owl.on('initialized.owl.carousel', function(event) {
        setTimeout(function() {
          $('.owl-dot').each(function(index) {
            $(this).find('span').text(index + 1);  // Menambahkan angka pada dots
          });
        }, 100);
      });
  
      // Menambahkan klik event pada tombol (1, 2, 3) untuk berpindah slide
      $('.owl-dot').on('click', function() {
        var index = $(this).index(); // Mendapatkan indeks tombol yang diklik
        owl.trigger('to.owl.carousel', [index]); // Berpindah ke slide yang sesuai dengan indeks
      });
    });
  </script>

  <script>
 $('.weekly2-news-active').slick({
  slidesToShow: 4,
  responsive: [
    { breakpoint: 1024, settings: { slidesToShow: 3 }},
    { breakpoint: 600, settings: { slidesToShow: 2 }},
    { breakpoint: 480, settings: { slidesToShow: 1 }}
  ]
});
    </script>
  
</head>
<body class="bg-gray-100 text-gray-800">

<header class="bg-white shadow-md w-full fixed top-0 z-50" x-data="{ open: false }">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16">
      <!-- Logo -->
      <a href="index.html" class="flex items-start">
        <img src="/image/Logo.png" alt="Logo" class="h-10">
      </a>
      <!-- Desktop Menu -->
      <nav class="hidden md:flex space-x-6 items-center">
        <a href="#beranda" class="relative text-gray-700 font-medium hover:text-blue-600 transition duration-300 
        before:content-[''] before:absolute before:-bottom-1 before:left-0 before:w-0 before:h-[2px] 
        before:bg-blue-600 before:transition-all before:duration-300 hover:before:w-full">
        Beranda </a>
        <a href="#services"  class="relative text-gray-700 font-medium hover:text-blue-600 transition duration-300 
        before:content-[''] before:absolute before:-bottom-1 before:left-0 before:w-0 before:h-[2px] 
        before:bg-blue-600 before:transition-all before:duration-300 hover:before:w-full">
        Profil</a>
        <a href="#about" class="relative text-gray-700 font-medium hover:text-blue-600 transition duration-300 
        before:content-[''] before:absolute before:-bottom-1 before:left-0 before:w-0 before:h-[2px] 
        before:bg-blue-600 before:transition-all before:duration-300 hover:before:w-full">
        Program Studi</a>
        <a href="#portfolio" class="relative text-gray-700 font-medium hover:text-blue-600 transition duration-300 
        before:content-[''] before:absolute before:-bottom-1 before:left-0 before:w-0 before:h-[2px] 
        before:bg-blue-600 before:transition-all before:duration-300 hover:before:w-full">
        Mata Kuliah</a>
        <a href="#video" class="relative text-gray-700 font-medium hover:text-blue-600 transition duration-300 
        before:content-[''] before:absolute before:-bottom-1 before:left-0 before:w-0 before:h-[2px] 
        before:bg-blue-600 before:transition-all before:duration-300 hover:before:w-full">
        Akademik</a>
        <a href="#contact" class="relative text-gray-700 font-medium hover:text-blue-600 transition duration-300 
        before:content-[''] before:absolute before:-bottom-1 before:left-0 before:w-0 before:h-[2px] 
        before:bg-blue-600 before:transition-all before:duration-300 hover:before:w-full">
        Contact Us</a>
        <a href="{{ route('login') }}" class="text-[#3094c6] font-medium px-3 py-1 rounded-xl border-2 border-[#3094c6] hover:bg-[#3094c6] hover:text-white transition flex items-center">
          <i class="bi bi-person"></i>
          <span class="ml-2">Login</span>
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
    <div class="md:hidden" x-show="open" @click.away="open = false" x-transition>
      <nav class="flex flex-col bg-[#6988db] text-white p-3 mb-6 mt-1 mx-5 rounded-3xl space-y-1">
        <a href="#" class="w-full flex justify-center items-center gap-2 p-3 hover:bg-[#586da7] rounded-2xl border-b border-[#5067a5]">
          </i><span>Beranda</span>
        </a>
        <a href="#" class="w-full flex justify-center items-center gap-2 p-3 hover:bg-[#586da7] rounded-2xl border-b border-[#5067a5]">
          </i><span>Profil</span>
        </a>
        <a href="#" class="w-full flex justify-center items-center gap-2 p-3 hover:bg-[#586da7] rounded-2xl border-b border-[#5067a5]">
        </i><span>Program Studi</span>
        </a>
        <a href="#" class="w-full flex justify-center items-center gap-2 p-3 hover:bg-[#586da7] rounded-2xl border-b border-[#5067a5]">
        </i><span>Mata Kuliah</span>
        </a>
        <a href="#" class="w-full flex justify-center items-center gap-2 p-3 hover:bg-[#586da7] rounded-2xl border-b border-[#5067a5]">
        </i><span>Akademik</span>
        </a>
        <a href="#" class="w-full flex justify-center items-center gap-2 p-3 hover:bg-[#586da7] rounded-2xl border-b border-[#5067a5]">
        </i><span>Contact Us</span>
        </a>
        <a href="{{ route('login') }}" class="w-full flex justify-center items-center gap-2 p-3 hover:bg-[#586da7]rounded-2xl border-b border-[#313874]">
          <i class="bi bi-person text-white opacity-70"></i>
          <span class="ml-1">Login</span>
        </a>
      </nav>
    </div>
    
  </div>
</header>

 <!-- Page Home -->
 <section class="w-full h-[650px] bg-cover bg-center flex items-center justify-center text-white" style="background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('/image/poliban.jpeg'); background-position: center;" id="top">
  <div class="container">
    <div class="row">
      <div class="col-lg-1mn2">
        <div class="row">
          <div class="col-lg-6 align-self-center">
            <div class="owl-carousel owl-banner">
              <!-- Slide 1: Selamat Datang -->
              <div class="item header-text">
                <h6 class="text-2xl font-semibold text-white">KURIKULUM OBE</h6>
                <h2 class="text-5xl font-bold">
                  <span class="text-[#f3f3f3]">Politeknik</span>
                  <em class="text-sky-500">Negeri</em>
                  <span class="text-[#f3f3f3]">Banjarmasin</span>
                </h2>
                <p class="text-lg text-blue-100 mb-6 mt-3">
                  Selamat Datang di Website Kurikulum Berbasis Outcome-Based Education (OBE)
                </p>
                <div class="down-buttons">
                  <div class="ml-1 main-blue-button-hover bg-blue-600 text-white shadow-lg hover:bg-blue-700 transform transition-all duration-300 hover:scale-110 rounded-full inline-block">
                    <a href="#services" class="text-lg font-semibold py-2 px-10 inline-block">Mulai</a>
                  </div>
                  <div class="ml-5 call-button bg-green-600 text-white shadow-lg hover:bg-green-700 transform transition-all duration-300 hover:scale-110 rounded-full inline-block">
                    <a href="https://mail.google.com/mail/?view=cm&fs=1&to=info@poliban.ac.id" target="_blank" class="text-lg font-semibold py-2 px-8 inline-block">
                      <i class="fa fa-envelope mr-3"></i>Email
                    </a>
                  </div>
                </div>
              </div>
            
              <!-- Slide 2: Visi dan Misi -->
              <div class="item header-text">
                <h6 class="text-2xl font-semibold text-white">VISI & MISI</h6>
                <h2 class="text-4xl font-bold text-white">
                  Mewujudkan Lulusan Unggul <em class="text-sky-500">Berbasis</em> Outcome-Based Education
                </h2>
                <p class="text-lg text-blue-100 mb-6 mt-3">
                  Visi kami adalah mencetak lulusan yang siap kerja, kompeten, dan adaptif terhadap perkembangan industri.
                </p>
                <div class="down-buttons">
                  <div class="ml-1 main-blue-button-hover bg-blue-600 text-white shadow-lg hover:bg-blue-700 transform transition-all duration-300 hover:scale-110 rounded-full inline-block">
                    <a href="#visi" class="text-lg font-semibold py-2 px-10 inline-block">Lihat Visi</a>
                  </div>
                  <div class="ml-5 call-button bg-green-600 text-white shadow-lg hover:bg-green-700 transform transition-all duration-300 hover:scale-110 rounded-full inline-block">
                    <a href="kontak-poliban.vcf" download class="text-lg font-semibold py-2 px-8 inline-block bg-green-600 text-white rounded-full hover:bg-green-700">
                      <i class="fa fa-phone mr-2"></i>Kontak Kami
                    </a>
                  </div>
                </div>
              </div>
            
              <!-- Slide 3: Profil Jurusan -->
              <div class="item header-text">
                <h6 class="text-2xl font-semibold text-white">PROFIL JURUSAN</h6>
                <h2 class="text-4xl font-bold text-white">
                  Program Studi Unggulan <em class="text-sky-500">Siap</em> Meningkatkan Mutu Pendidikan
                </h2>
                <p class="text-lg text-blue-100 mb-6 mt-3">
                  Kenali lebih jauh jurusan dan program studi di Poliban yang mendukung sistem pembelajaran OBE.
                </p>
                <div class="down-buttons">
                  <div class="ml-1 main-blue-button-hover bg-blue-600 text-white shadow-lg hover:bg-blue-700 transform transition-all duration-300 hover:scale-110 rounded-full inline-block">
                    <a href="#jurusan" class="text-lg font-semibold py-2 px-10 inline-block">Lihat Jurusan</a>
                  </div>
                  <div class="ml-5 call-button bg-green-600 text-white shadow-lg hover:bg-green-700 transform transition-all duration-300 hover:scale-110 rounded-full inline-block">
                    <a href="https://wa.me/62511326179" class="text-lg font-semibold py-2 px-8 inline-block"><i class="fa fa-comment mr-2"></i>Hubungi Kami</a>
                  </div>
                </div>
              </div>
            </div>
            
              </div>
              <!-- tombol slide -->
              <div class="flex justify-left gap-2 mt-2">
                <button class="owl-dot group w-10 h-10 border-2 border-white text-white rounded-full flex justify-center items-center font-bold text-base cursor-pointer transition-all duration-300 ease-in-out">
                  <span class="group-hover:text-blue-500">1</span>
                </button>
                <button class="owl-dot group w-10 h-10 border-2 border-white text-white rounded-full flex justify-center items-center font-bold text-base cursor-pointer transition-all duration-300 ease-in-out">
                  <span class="group-hover:text-blue-500">2</span>
                </button>
                <button class="owl-dot group w-10 h-10 border-2 border-white text-white rounded-full flex justify-center items-center font-bold text-base cursor-pointer transition-all duration-300 ease-in-out">
                  <span class="group-hover:text-blue-500">3</span>
                </button>
              </div>
        
        </div>
      </div>
    </div>
  </div>
</section>

  <!-- Beranda -->
  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
  <script>
      AOS.init();
      mirror: true
  </script> 
  <div id="beranda" class="homepage pb-10">
    <div class="container mx-auto px-4">
      <div class="grid grid-cols-1 md:grid-cols-2 items-center gap-10 pt-12">
        <div data-aos="fade-right" data-aos-once="false" data-aos-duration="1000">
          <h1 class="text-4xl md:text-5xl font-semibold leading-tight mb-10">
            Profil Kurikulum OBE <span class="text-sky-500">Poliban</span>
          </h1>
          <p class="text-base text-gray-700 leading-relaxed mb-6">
            Politeknik Negeri Banjarmasin (POLIBAN) merupakan perguruan tinggi vokasi di Kalimantan Selatan 
            yang berfokus pada pendidikan terapan. Kampus ini memiliki berbagai jurusan dan program studi unggulan yang 
            mendukung perkembangan teknologi dan industri di Indonesia. POLIBAN berperan aktif dalam mendukung pertumbuhan sektor 
            industri, teknologi, dan pembangunan daerah melalui pendidikan berbasis praktik, inovasi, serta kerja sama dengan berbagai 
            mitra industri baik di dalam maupun luar negeri.
          </p>
          <a href="#" class="inline-flex items-center bg-sky-500 hover:bg-sky-700 text-white mt-4 px-5 py-3 rounded-full shadow transition">
            Tentang Website <i class="ri-eye-line ms-2"></i>
          </a>
        </div>
        <div className="flex justify-end" data-aos="fade-left" data-aos-once="false" data-aos-duration="1000">
          <img src="/image/profil.png" alt="Hero Image" className="w-full max-w-md h-auto ml-auto" />
        </div>
      </div>
    </div>
  </div>

  
<!-- Section: Profil Pengajar -->
<section id="pengajar" class="bg-gray-100 py-12">
  <div class="container mx-auto px-4">
    <h2 class="text-3xl font-bold text-center text-blue-700 mb-10">Profil Pengajar</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
      
      <!-- Pengajar 1 -->
      <div class="bg-white rounded-xl shadow-lg p-6 text-center transform transition-transform duration-300 hover:-translate-y-2 hover:shadow-2xl">
        <img src="https://duniadosen.com/wp-content/uploads/2016/04/Jadi-Dosen.jpg" alt="Dr. Andi Susanto" class="w-28 h-28 mx-auto rounded-full border-4 border-blue-200 shadow-sm">
        <h3 class="mt-4 text-xl font-semibold text-gray-800">Dr. Andi Susanto</h3>
        <p class="text-blue-600 mt-1 font-medium">Dosen Matematika & Teknologi Pendidikan</p>
        <p class="text-gray-600 mt-2 text-sm">10+ tahun pengalaman di bidang pendidikan & penelitian.</p>
      </div>

        <!-- Pengajar 2 -->
        <div class="bg-white rounded-xl shadow-lg p-6 text-center transform transition-transform duration-300 hover:-translate-y-2 hover:shadow-2xl">
          <img src="https://duniadosen.com/wp-content/uploads/2016/04/Jadi-Dosen.jpg" alt="Dr. Andi Susanto" class="w-28 h-28 mx-auto rounded-full border-4 border-blue-200 shadow-sm">
          <h3 class="mt-4 text-xl font-semibold text-gray-800">Dr. Andi Susanto</h3>
          <p class="text-blue-600 mt-1 font-medium">Dosen Matematika & Teknologi Pendidikan</p>
          <p class="text-gray-600 mt-2 text-sm">10+ tahun pengalaman di bidang pendidikan & penelitian.</p>
        </div>

          <!-- Pengajar 3 -->
      <div class="bg-white rounded-xl shadow-lg p-6 text-center transform transition-transform duration-300 hover:-translate-y-2 hover:shadow-2xl">
        <img src="https://duniadosen.com/wp-content/uploads/2016/04/Jadi-Dosen.jpg" alt="Dr. Andi Susanto" class="w-28 h-28 mx-auto rounded-full border-4 border-blue-200 shadow-sm">
        <h3 class="mt-4 text-xl font-semibold text-gray-800">Dr. Andi Susanto</h3>
        <p class="text-blue-600 mt-1 font-medium">Dosen Matematika & Teknologi Pendidikan</p>
        <p class="text-gray-600 mt-2 text-sm">10+ tahun pengalaman di bidang pendidikan & penelitian.</p>
      </div>
      
    </div>
  </div>
</section>


  <!-- Daftar Kurikulum dan Program Studi -->
  <section class="bg-gray-100 py-16">
    <div class="max-w-6xl mx-auto px-4">
      <h2 class="text-3xl font-bold text-center text-blue-700 mb-12">Jurusan & Program Studi di Poliban</h2>
  
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Teknik Sipil -->
        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition">
          <h3 class="text-2xl font-semibold text-blue-600 mb-4">🏗️ Teknik Sipil</h3>
          <ul class="list-disc pl-5 text-gray-700 mb-4 space-y-1">
            <li>D3 Teknik Sipil</li>
            <li>D4 Teknik Bangunan Rawa</li>
            <li>D3 Teknik Geodesi</li>
            <li>D3 Teknik Pertambangan</li>
            <li>D4 Rekayasa Konstruksi Jalan & Jembatan</li>
          </ul>
          <a href="https://sipil.poliban.ac.id" target="_blank" class="inline-block mt-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Kunjungi Website</a>
        </div>
  
        <!-- Teknik Mesin -->
        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition">
          <h3 class="text-2xl font-semibold text-red-600 mb-4">⚙️ Teknik Mesin</h3>
          <ul class="list-disc pl-5 text-gray-700 mb-4 space-y-1">
            <li>D3 Teknik Mesin</li>
            <li>D3 Teknik Mesin Otomotif</li>
            <li>D3 Alat Berat</li>
          </ul>
          <a href="https://mesin.poliban.ac.id" target="_blank" class="inline-block mt-2 bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">Kunjungi Website</a>
        </div>
  
        <!-- Teknik Elektro -->
        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition">
          <h3 class="text-2xl font-semibold text-yellow-600 mb-4">💡 Teknik Elektro</h3>
          <ul class="list-disc pl-5 text-gray-700 mb-4 space-y-1">
            <li>D3 Teknik Listrik</li>
            <li>D3 Elektronika</li>
            <li>D3 Teknik Informatika</li>
            <li>D4 Sistem Informasi Kota Cerdas</li>
            <li>D4 Rekayasa Pembangkit Energi</li>
          </ul>
          <a href="https://elektro.poliban.ac.id" target="_blank" class="inline-block mt-2 bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition">Kunjungi Website</a>
        </div>
  
        <!-- Akuntansi -->
        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition">
          <h3 class="text-2xl font-semibold text-green-600 mb-4">📊 Akuntansi</h3>
          <ul class="list-disc pl-5 text-gray-700 mb-4 space-y-1">
            <li>D3 Akuntansi</li>
            <li>D3 Komputerisasi Akuntansi</li>
            <li>D4 Akuntansi Lembaga Keuangan Syariah</li>
          </ul>
          <a href="https://akuntansi.poliban.ac.id" target="_blank" class="inline-block mt-2 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">Kunjungi Website</a>
        </div>
  
        <!-- Administrasi Bisnis -->
        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition">
          <h3 class="text-2xl font-semibold text-purple-600 mb-4">💼 Administrasi Bisnis</h3>
          <ul class="list-disc pl-5 text-gray-700 mb-4 space-y-1">
            <li>D3 Administrasi Bisnis</li>
            <li>D3 Manajemen Informatika</li>
            <li>D4 Bisnis Digital</li>
          </ul>
          <a href="https://bisnis.poliban.ac.id" target="_blank" class="inline-block mt-2 bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 transition">Kunjungi Website</a>
        </div>
      </div>
    </div>
  </section>
  
  
  <div class="weekly2-news-area  weekly2-pading gray-bg">
    <div class="container">
        <div class="weekly2-wrapper">
            <!-- section Tittle -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-tittle mb-30">
                        <h3>Weekly Top News</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="weekly2-news-active dot-style d-flex dot-style slick-initialized slick-slider slick-dotted">
                        <div class="slick-list draggable"><div class="slick-track" style="opacity: 1; width: 3360px; transform: translate3d(-960px, 0px, 0px);"><div class="weekly2-single slick-slide slick-cloned" data-slick-index="-4" aria-hidden="true" style="width: 210px;" tabindex="-1">
                            <div class="weekly2-img">
                                <img src="https://picsum.photos/210/140" alt="">
                            </div>
                            <div class="weekly2-caption">
                                <span class="color1">Event night</span>
                                <p>25 Jan 2020</p>
                                <h4><a href="#" tabindex="-1">Welcome To The Best Model  Winner Contest</a></h4>
                            </div>
                        </div><div class="weekly2-single slick-slide slick-cloned" data-slick-index="-3" aria-hidden="true" style="width: 210px;" tabindex="-1">
                            <div class="weekly2-img">
                                <img src="https://picsum.photos/210/140" alt="">
                            </div>
                            <div class="weekly2-caption">
                                <span class="color1">Corporate</span>
                                <p>25 Jan 2020</p>
                                <h4><a href="#" tabindex="-1">Welcome To The Best Model  Winner Contest</a></h4>
                            </div>
                        </div><div class="weekly2-single slick-slide slick-cloned" data-slick-index="-2" aria-hidden="true" style="width: 210px;" tabindex="-1">
                            <div class="weekly2-img">
                                <img src="https://picsum.photos/210/140" alt="">
                            </div>
                            <div class="weekly2-caption">
                                <span class="color1">Event time</span>
                                <p>25 Jan 2020</p>
                                <h4><a href="#" tabindex="-1">Welcome To The Best Model  Winner Contest</a></h4>
                            </div>
                        </div><div class="weekly2-single slick-slide slick-cloned" data-slick-index="-1" aria-hidden="true" style="width: 210px;" tabindex="-1">
                            <div class="weekly2-img">
                                <img src="https://picsum.photos/210/140" alt="">
                            </div>
                            <div class="weekly2-caption">
                                <span class="color1">Corporate</span>
                                <p>25 Jan 2020</p>
                                <h4><a href="#" tabindex="-1">Welcome To The Best Model  Winner Contest</a></h4>
                            </div>
                        </div><div class="weekly2-single slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false" style="width: 210px;" tabindex="0" role="tabpanel" id="slick-slide10" aria-describedby="slick-slide-control10">
                            <div class="weekly2-img">
                                <img src="https://picsum.photos/210/140" alt="">
                            </div>
                            <div class="weekly2-caption">
                                <span class="color1">Corporate</span>
                                <p>25 Jan 2020</p>
                                <h4><a href="#" tabindex="0">Welcome To The Best Model  Winner Contest</a></h4>
                            </div>
                        </div><div class="weekly2-single slick-slide slick-active" data-slick-index="1" aria-hidden="false" style="width: 210px;" tabindex="0" role="tabpanel" id="slick-slide11" aria-describedby="slick-slide-control11">
                            <div class="weekly2-img">
                                <img src="https://picsum.photos/210/140" alt="">
                            </div>
                            <div class="weekly2-caption">
                                <span class="color1">Event night</span>
                                <p>25 Jan 2020</p>
                                <h4><a href="#" tabindex="0">Welcome To The Best Model  Winner Contest</a></h4>
                            </div>
                        </div><div class="weekly2-single slick-slide slick-active" data-slick-index="2" aria-hidden="false" style="width: 210px;" tabindex="0" role="tabpanel" id="slick-slide12" aria-describedby="slick-slide-control12">
                            <div class="weekly2-img">
                                <img src="https://picsum.photos/210/140" alt="">
                            </div>
                            <div class="weekly2-caption">
                                <span class="color1">Corporate</span>
                                <p>25 Jan 2020</p>
                                <h4><a href="#" tabindex="0">Welcome To The Best Model  Winner Contest</a></h4>
                            </div>
                        </div><div class="weekly2-single slick-slide slick-active" data-slick-index="3" aria-hidden="false" style="width: 210px;" tabindex="0" role="tabpanel" id="slick-slide13" aria-describedby="slick-slide-control13">
                            <div class="weekly2-img">
                                <img src="https://picsum.photos/210/140" alt="">
                            </div>
                            <div class="weekly2-caption">
                                <span class="color1">Event time</span>
                                <p>25 Jan 2020</p>
                                <h4><a href="#" tabindex="0">Welcome To The Best Model  Winner Contest</a></h4>
                            </div>
                        </div><div class="weekly2-single slick-slide" data-slick-index="4" aria-hidden="true" style="width: 210px;" tabindex="-1" role="tabpanel" id="slick-slide14" aria-describedby="slick-slide-control14">
                            <div class="weekly2-img">
                                <img src="https://picsum.photos/210/140" alt="">
                            </div>
                            <div class="weekly2-caption">
                                <span class="color1">Corporate</span>
                                <p>25 Jan 2020</p>
                                <h4><a href="#" tabindex="-1">Welcome To The Best Model  Winner Contest</a></h4>
                            </div>
                        </div><div class="weekly2-single slick-slide slick-cloned" data-slick-index="5" aria-hidden="true" style="width: 210px;" tabindex="-1">
                            <div class="weekly2-img">
                                <img src="https://picsum.photos/210/140" alt="">
                            </div>
                            <div class="weekly2-caption">
                                <span class="color1">Corporate</span>
                                <p>25 Jan 2020</p>
                                <h4><a href="#" tabindex="-1">Welcome To The Best Model  Winner Contest</a></h4>
                            </div>
                        </div><div class="weekly2-single slick-slide slick-cloned" data-slick-index="6" aria-hidden="true" style="width: 210px;" tabindex="-1">
                            <div class="weekly2-img">
                                <img src="https://picsum.photos/210/140" alt="">
                            </div>
                            <div class="weekly2-caption">
                                <span class="color1">Event night</span>
                                <p>25 Jan 2020</p>
                                <h4><a href="#" tabindex="-1">Welcome To The Best Model  Winner Contest</a></h4>
                            </div>
                        </div><div class="weekly2-single slick-slide slick-cloned" data-slick-index="7" aria-hidden="true" style="width: 210px;" tabindex="-1">
                            <div class="weekly2-img">
                                <img src="https://picsum.photos/210/140" alt="">
                            </div>
                            <div class="weekly2-caption">
                                <span class="color1">Corporate</span>
                                <p>25 Jan 2020</p>
                                <h4><a href="#" tabindex="-1">Welcome To The Best Model  Winner Contest</a></h4>
                            </div>
                        </div><div class="weekly2-single slick-slide slick-cloned" data-slick-index="8" aria-hidden="true" style="width: 210px;" tabindex="-1">
                            <div class="weekly2-img">
                                <img src="https://picsum.photos/210/140" alt="">
                            </div>
                            <div class="weekly2-caption">
                                <span class="color1">Event time</span>
                                <p>25 Jan 2020</p>
                                <h4><a href="#" tabindex="-1">Welcome To The Best Model  Winner Contest</a></h4>
                            </div>
                        </div><div class="weekly2-single slick-slide slick-cloned" data-slick-index="9" aria-hidden="true" style="width: 210px;" tabindex="-1">
                            <div class="weekly2-img">
                                <img src="https://picsum.photos/210/140" alt="">
                            </div>
                            <div class="weekly2-caption">
                                <span class="color1">Corporate</span>
                                <p>25 Jan 2020</p>
                                <h4><a href="#" tabindex="-1">Welcome To The Best Model  Winner Contest</a></h4>
                            </div>
                        </div></div></div> 
                        
                    <ul class="slick-dots" style="display: block;" role="tablist"><li class="slick-active" role="presentation"><button type="button" role="tab" id="slick-slide-control10" aria-controls="slick-slide10" aria-label="1 of 2" tabindex="0" aria-selected="true">1</button></li><li role="presentation" class=""><button type="button" role="tab" id="slick-slide-control11" aria-controls="slick-slide11" aria-label="2 of 2" tabindex="-1">2</button></li><li role="presentation" class=""><button type="button" role="tab" id="slick-slide-control12" aria-controls="slick-slide12" aria-label="3 of 2" tabindex="-1">3</button></li><li class="" role="presentation"><button type="button" role="tab" id="slick-slide-control13" aria-controls="slick-slide13" aria-label="4 of 2" tabindex="-1">4</button></li><li role="presentation" class=""><button type="button" role="tab" id="slick-slide-control14" aria-controls="slick-slide14" aria-label="5 of 2" tabindex="-1">5</button></li></ul></div>
                </div>
            </div>
        </div>
    </div>
</div> 
  
  <!-- Footer -->
  <footer class="bg-gray-800 text-white py-14">
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
          <h4 class="font-semibold text-lg mb-6">Layanan</h4>
          <ul class="space-y-2">
            <li><a href="#" class="text-gray-400 hover:text-white">Perpustakaan Digital</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white">Portal Mahasiswa</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white">Bimbingan Akademik</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white">Pusat Karier</a></li>
          </ul>
        </div>
        
        <!-- Community Section -->
        <div class="footer-item">
          <h4 class="font-semibold text-lg mb-6">Komunitas</h4>
          <ul class="space-y-2">
            <li><a href="#" class="text-gray-400 hover:text-white">Organisasi Mahasiswa</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white">Alumni & Jejaring</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white">Forum Diskusi Akademik</a></li>
            <li><a href="#" class="text-gray-400 hover:text-white">Kegiatan Kampus</a></li>
          </ul>
        </div>
        
        <!-- Subscribe -->
        <div class="footer-item">
          <h4 class="font-semibold text-lg mb-6">Informasi Berita</h4>
          <p class="text-gray-400 mb-4">Dapatkan informasi terbaru seputar berita kampus langsung di email Anda.</p>
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
      
      <hr class="mt-10 border-gray-400">
      <!-- Copyright Section -->
      <div class="text-center text-sm text-gray-400 mt-8">
        <p>Copyright &copy; 2025 Fikri & Habibie., All Rights Reserved.</p>
      </div>
    </div>
  </footer>
  




</body>
</html>
