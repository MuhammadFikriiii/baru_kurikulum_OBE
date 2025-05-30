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

  <!-- Swiper CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  
  <!-- Swiper homepage  -->
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

  <!-- Swiper -->
  <script>
    const carousel = document.getElementById('carousel');
    const indicators = document.querySelectorAll('#indicators button');
    let currentSlide = 0;
    const totalSlides = indicators.length;

    function goToSlide(index) {
      currentSlide = index;
      carousel.style.transform = `translateX(-${index * 100}%)`;
      updateIndicators();
    }

    function updateIndicators() {
      indicators.forEach((btn, idx) => {
        btn.classList.remove('bg-orange-500', 'w-6');
        btn.classList.add('bg-gray-300', 'w-2');
        if (idx === currentSlide) {
          btn.classList.add('bg-orange-500', 'w-6');
          btn.classList.remove('bg-gray-300', 'w-2');
        }
      });
    }

    indicators.forEach((btn, index) => {
      btn.addEventListener('click', () => {
        goToSlide(index);
      });
    });

    setInterval(() => {
      currentSlide = (currentSlide + 1) % totalSlides;
      goToSlide(currentSlide);
    }, 5000); // Auto slide setiap 5 detik
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
        <a href="#video" class="relative text-gray-700 font-medium hover:text-blue-600 transition duration-300 
        before:content-[''] before:absolute before:-bottom-1 before:left-0 before:w-0 before:h-[2px] 
        before:bg-blue-600 before:transition-all before:duration-300 hover:before:w-full">
        Akademik</a>
        <a href="#about" class="relative text-gray-700 font-medium hover:text-blue-600 transition duration-300 
        before:content-[''] before:absolute before:-bottom-1 before:left-0 before:w-0 before:h-[2px] 
        before:bg-blue-600 before:transition-all before:duration-300 hover:before:w-full">
        Team</a>
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
        </i><span>Akademik</span>
        </a>
        <a href="#" class="w-full flex justify-center items-center gap-2 p-3 hover:bg-[#586da7] rounded-2xl border-b border-[#5067a5]">
        </i><span>Team</span>
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

  
<!-- Daftar Kurikulum dan Program Studi -->
<!-- Jurusan -->
 <style>
  .program-slider {
      scroll-behavior: smooth;
      transition: transform 0.5s ease-in-out;
  }
  .program-card {
      transition: all 0.3s ease;
      cursor: pointer;
  }
  .program-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
  }
  .program-tab.active {
      background-color: #2563eb;
      color: white;
  }
  .indicator-dot.active {
      background-color: #2563eb;
  }
</style>

<div class="container mx-auto px-4 py-12">
  <h1 class="text-3xl text-center font-bold text-indigo-800 mb-2">Program Studi</h1>
  <p class="text-lg text-center text-gray-600 mb-8">Temukan program studi yang sesuai dengan minat Anda</p>
  
  <!-- Navigation Tabs -->
  <div class="flex flex-wrap justify-center mb-8 gap-2">
      <button onclick="showSlide(0)" class="program-tab px-6 py-3 rounded-lg bg-blue-600 text-white font-medium shadow-md transition active hover:bg-blue-700">Teknik Sipil</button>
      <button onclick="showSlide(1)" class="program-tab px-6 py-3 rounded-lg bg-gray-100 font-medium shadow-md transition hover:bg-gray-200">Teknik Mesin</button>
      <button onclick="showSlide(2)" class="program-tab px-6 py-3 rounded-lg bg-gray-100 font-medium shadow-md transition hover:bg-gray-200">Teknik Elektro</button>
      <button onclick="showSlide(3)" class="program-tab px-6 py-3 rounded-lg bg-gray-100 font-medium shadow-md transition hover:bg-gray-200">Akutansi</button>
      <button onclick="showSlide(4)" class="program-tab px-6 py-3 rounded-lg bg-gray-100 font-medium shadow-md transition hover:bg-gray-200">Administrasi Bisnis</button>
  </div>
  
  <!-- Slider Content -->
  <div class="relative">
      <!-- Previous Button -->
      <button onclick="prevSlide()" class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 z-10 bg-white p-3 rounded-full shadow-md hover:bg-gray-100 transition">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
      </button>
      
      <!-- Slides -->
      <div class="overflow-hidden">
          <div id="program-slider" class="program-slider flex" style="width: 500%;">
              <!-- Teknik Sipil -->
              <div class="w-full px-4">
                  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                      <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition cursor-pointer" onclick="window.location.href='#'">
                          <div class="flex items-center mb-4">
                              <div class="bg-blue-100 p-3 rounded-lg mr-4">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                  </svg>
                              </div>
                              <h3 class="text-xl font-bold text-gray-800">D3 Teknik Sipil</h3>
                          </div>
                          <p class="text-gray-600 mb-4">Program studi yang mempelajari perencanaan, perancangan, konstruksi, dan pemeliharaan infrastruktur.</p>
                          <div class="flex justify-between items-center">
                              <span class="text-sm text-gray-500">Jenjang: D3</span>
                              <button class="text-blue-600 font-medium hover:text-blue-800">Lihat Detail →</button>
                          </div>
                      </div>
                      
                      <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition cursor-pointer" onclick="window.location.href='#'">
                          <div class="flex items-center mb-4">
                              <div class="bg-blue-100 p-3 rounded-lg mr-4">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                                  </svg>
                              </div>
                              <h3 class="text-xl font-bold text-gray-800">D4 Teknik Bangunan Rawa</h3>
                          </div>
                          <p class="text-gray-600 mb-4">Spesialisasi dalam konstruksi bangunan di daerah rawa dengan pendekatan berkelanjutan.</p>
                          <div class="flex justify-between items-center">
                              <span class="text-sm text-gray-500">Jenjang: D4</span>
                              <button class="text-blue-600 font-medium hover:text-blue-800">Lihat Detail →</button>
                          </div>
                      </div>
                      
                      <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition cursor-pointer" onclick="window.location.href='#'">
                          <div class="flex items-center mb-4">
                              <div class="bg-blue-100 p-3 rounded-lg mr-4">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                  </svg>
                              </div>
                              <h3 class="text-xl font-bold text-gray-800">D3 Teknik Geodesi</h3>
                          </div>
                          <p class="text-gray-600 mb-4">Mempelajari pengukuran dan pemetaan permukaan bumi untuk berbagai keperluan konstruksi.</p>
                          <div class="flex justify-between items-center">
                              <span class="text-sm text-gray-500">Jenjang: D3</span>
                              <button class="text-blue-600 font-medium hover:text-blue-800">Lihat Detail →</button>
                          </div>
                      </div>
                  </div>
              </div>
              
              <!-- Teknik Mesin -->
              <div class="w-full px-4">
                  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                      <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition cursor-pointer" onclick="window.location.href='#'">
                          <div class="flex items-center mb-4">
                              <div class="bg-blue-100 p-3 rounded-lg mr-4">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                  </svg>
                              </div>
                              <h3 class="text-xl font-bold text-gray-800">D3 Teknik Mesin</h3>
                          </div>
                          <p class="text-gray-600 mb-4">Program studi yang berfokus pada perancangan, analisis, dan pemeliharaan sistem mekanik.</p>
                          <div class="flex justify-between items-center">
                              <span class="text-sm text-gray-500">Jenjang: D3</span>
                              <button class="text-blue-600 font-medium hover:text-blue-800">Lihat Detail →</button>
                          </div>
                      </div>
                      
                      <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition cursor-pointer" onclick="window.location.href='#'">
                          <div class="flex items-center mb-4">
                              <div class="bg-blue-100 p-3 rounded-lg mr-4">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                                  </svg>
                              </div>
                              <h3 class="text-xl font-bold text-gray-800">D3 Teknik Mesin Otomotif</h3>
                          </div>
                          <p class="text-gray-600 mb-4">Spesialisasi dalam teknologi otomotif, perawatan, dan perbaikan kendaraan bermotor.</p>
                          <div class="flex justify-between items-center">
                              <span class="text-sm text-gray-500">Jenjang: D3</span>
                              <button class="text-blue-600 font-medium hover:text-blue-800">Lihat Detail →</button>
                          </div>
                      </div>
                      
                      <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition cursor-pointer" onclick="window.location.href='#'">
                          <div class="flex items-center mb-4">
                              <div class="bg-blue-100 p-3 rounded-lg mr-4">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                  </svg>
                              </div>
                              <h3 class="text-xl font-bold text-gray-800">D3 Alat Berat</h3>
                          </div>
                          <p class="text-gray-600 mb-4">Mempelajari operasi, perawatan, dan manajemen alat berat untuk konstruksi dan pertambangan.</p>
                          <div class="flex justify-between items-center">
                              <span class="text-sm text-gray-500">Jenjang: D3</span>
                              <button class="text-blue-600 font-medium hover:text-blue-800">Lihat Detail →</button>
                          </div>
                      </div>
                  </div>
              </div>
              
              <!-- Teknik Elektro -->
              <div class="w-full px-4">
                  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                      <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition cursor-pointer" onclick="window.location.href='#'">
                          <div class="flex items-center mb-4">
                              <div class="bg-blue-100 p-3 rounded-lg mr-4">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                  </svg>
                              </div>
                              <h3 class="text-xl font-bold text-gray-800">D3 Teknik Listrik</h3>
                          </div>
                          <p class="text-gray-600 mb-4">Program studi yang mempelajari sistem tenaga listrik, instalasi, dan distribusi daya.</p>
                          <div class="flex justify-between items-center">
                              <span class="text-sm text-gray-500">Jenjang: D3</span>
                              <button class="text-blue-600 font-medium hover:text-blue-800">Lihat Detail →</button>
                          </div>
                      </div>
                      
                      <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition cursor-pointer" onclick="window.location.href='#'">
                          <div class="flex items-center mb-4">
                              <div class="bg-blue-100 p-3 rounded-lg mr-4">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                                  </svg>
                              </div>
                              <h3 class="text-xl font-bold text-gray-800">D3 Elektronika</h3>
                          </div>
                          <p class="text-gray-600 mb-4">Mempelajari komponen elektronika, rangkaian digital, dan sistem kendali elektronik.</p>
                          <div class="flex justify-between items-center">
                              <span class="text-sm text-gray-500">Jenjang: D3</span>
                              <button class="text-blue-600 font-medium hover:text-blue-800">Lihat Detail →</button>
                          </div>
                      </div>
                      
                      <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition cursor-pointer" onclick="window.location.href='#'">
                          <div class="flex items-center mb-4">
                              <div class="bg-blue-100 p-3 rounded-lg mr-4">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                  </svg>
                              </div>
                              <h3 class="text-xl font-bold text-gray-800">D3 Teknik Informatika</h3>
                          </div>
                          <p class="text-gray-600 mb-4">Berfokus pada pengembangan perangkat lunak, jaringan komputer, dan basis data.</p>
                          <div class="flex justify-between items-center">
                              <span class="text-sm text-gray-500">Jenjang: D3</span>
                              <button class="text-blue-600 font-medium hover:text-blue-800">Lihat Detail →</button>
                          </div>
                      </div>
                  </div>
              </div>
              
              <!-- Akutansi -->
              <div class="w-full px-4">
                  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                      <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition cursor-pointer" onclick="window.location.href='#'">
                          <div class="flex items-center mb-4">
                              <div class="bg-blue-100 p-3 rounded-lg mr-4">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                  </svg>
                              </div>
                              <h3 class="text-xl font-bold text-gray-800">D3 Akuntansi</h3>
                          </div>
                          <p class="text-gray-600 mb-4">Program studi yang mempelajari pencatatan, pengklasifikasian, dan pelaporan transaksi keuangan.</p>
                          <div class="flex justify-between items-center">
                              <span class="text-sm text-gray-500">Jenjang: D3</span>
                              <button class="text-blue-600 font-medium hover:text-blue-800">Lihat Detail →</button>
                          </div>
                      </div>
                      
                      <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition cursor-pointer" onclick="window.location.href='#'">
                          <div class="flex items-center mb-4">
                              <div class="bg-blue-100 p-3 rounded-lg mr-4">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                  </svg>
                              </div>
                              <h3 class="text-xl font-bold text-gray-800">D3 Komputerisasi Akuntansi</h3>
                          </div>
                          <p class="text-gray-600 mb-4">Mengintegrasikan ilmu akuntansi dengan teknologi informasi untuk sistem akuntansi digital.</p>
                          <div class="flex justify-between items-center">
                              <span class="text-sm text-gray-500">Jenjang: D3</span>
                              <button class="text-blue-600 font-medium hover:text-blue-800">Lihat Detail →</button>
                          </div>
                      </div>
                      
                      <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition cursor-pointer" onclick="window.location.href='#'">
                          <div class="flex items-center mb-4">
                              <div class="bg-blue-100 p-3 rounded-lg mr-4">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                  </svg>
                              </div>
                              <h3 class="text-xl font-bold text-gray-800">D4 Akuntansi Lembaga Keuangan Syariah</h3>
                          </div>
                          <p class="text-gray-600 mb-4">Spesialisasi akuntansi untuk lembaga keuangan yang beroperasi berdasarkan prinsip syariah.</p>
                          <div class="flex justify-between items-center">
                              <span class="text-sm text-gray-500">Jenjang: D4</span>
                              <button class="text-blue-600 font-medium hover:text-blue-800">Lihat Detail →</button>
                          </div>
                      </div>
                  </div>
              </div>
              
              <!-- Administrasi Bisnis -->
              <div class="w-full px-4">
                  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                      <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition cursor-pointer" onclick="window.location.href='#'">
                          <div class="flex items-center mb-4">
                              <div class="bg-blue-100 p-3 rounded-lg mr-4">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                  </svg>
                              </div>
                              <h3 class="text-xl font-bold text-gray-800">D3 Administrasi Bisnis</h3>
                          </div>
                          <p class="text-gray-600 mb-4">Program studi yang mempelajari manajemen perkantoran, korespondensi bisnis, dan administrasi.</p>
                          <div class="flex justify-between items-center">
                              <span class="text-sm text-gray-500">Jenjang: D3</span>
                              <button class="text-blue-600 font-medium hover:text-blue-800">Lihat Detail →</button>
                          </div>
                      </div>
                      
                      <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition cursor-pointer" onclick="window.location.href='#'">
                          <div class="flex items-center mb-4">
                              <div class="bg-blue-100 p-3 rounded-lg mr-4">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                  </svg>
                              </div>
                              <h3 class="text-xl font-bold text-gray-800">D3 Manajemen Informatika</h3>
                          </div>
                          <p class="text-gray-600 mb-4">Mengintegrasikan ilmu manajemen dengan teknologi informasi untuk kebutuhan bisnis.</p>
                          <div class="flex justify-between items-center">
                              <span class="text-sm text-gray-500">Jenjang: D3</span>
                              <button class="text-blue-600 font-medium hover:text-blue-800">Lihat Detail →</button>
                          </div>
                      </div>
                      
                      <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition cursor-pointer" onclick="window.location.href='#'">
                          <div class="flex items-center mb-4">
                              <div class="bg-blue-100 p-3 rounded-lg mr-4">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                                  </svg>
                              </div>
                              <h3 class="text-xl font-bold text-gray-800">D4 Bisnis Digital</h3>
                          </div>
                          <p class="text-gray-600 mb-4">Mempelajari transformasi digital bisnis, e-commerce, dan strategi pemasaran digital.</p>
                          <div class="flex justify-between items-center">
                              <span class="text-sm text-gray-500">Jenjang: D4</span>
                              <button class="text-blue-600 font-medium hover:text-blue-800">Lihat Detail →</button>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      
      <!-- Next Button -->
      <button onclick="nextSlide()" class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 z-10 bg-white p-3 rounded-full shadow-md hover:bg-gray-100 transition">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
          </svg>
      </button>
  </div>
  
  <!-- Slide Indicators -->
  <div class="flex justify-center mt-8 gap-2">
      <button onclick="showSlide(0)" class="w-3 h-3 rounded-full bg-blue-600 indicator-dot active"></button>
      <button onclick="showSlide(1)" class="w-3 h-3 rounded-full bg-gray-300 indicator-dot"></button>
      <button onclick="showSlide(2)" class="w-3 h-3 rounded-full bg-gray-300 indicator-dot"></button>
      <button onclick="showSlide(3)" class="w-3 h-3 rounded-full bg-gray-300 indicator-dot"></button>
      <button onclick="showSlide(4)" class="w-3 h-3 rounded-full bg-gray-300 indicator-dot"></button>
  </div>
</div>

<script>
  let currentSlide = 0;
  const totalSlides = 5;
  let autoSlideInterval;
  
  function updateSlider() {
      const slider = document.getElementById('program-slider');
      slider.style.transform = `translateX(-${currentSlide * 100}%)`;
      
      // Update tab buttons
      document.querySelectorAll('.program-tab').forEach((tab, index) => {
          if (index === currentSlide) {
              tab.classList.remove('bg-gray-100');
              tab.classList.add('bg-blue-600', 'text-white', 'hover:bg-blue-700');
          } else {
              tab.classList.remove('bg-blue-600', 'text-white', 'hover:bg-blue-700');
              tab.classList.add('bg-gray-100', 'hover:bg-gray-200');
          }
      });
      
      // Update indicator dots
      document.querySelectorAll('.indicator-dot').forEach((dot, index) => {
          if (index === currentSlide) {
              dot.classList.add('bg-blue-600');
              dot.classList.remove('bg-gray-300');
          } else {
              dot.classList.remove('bg-blue-600');
              dot.classList.add('bg-gray-300');
          }
      });
  }
  
  function nextSlide() {
      currentSlide = (currentSlide + 1) % totalSlides;
      updateSlider();
      resetAutoSlide();
  }
  
  function prevSlide() {
      currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
      updateSlider();
      resetAutoSlide();
  }
  
  function showSlide(index) {
      currentSlide = index;
      updateSlider();
      resetAutoSlide();
  }
  
  function startAutoSlide() {
      autoSlideInterval = setInterval(nextSlide, 5000); // Change slide every 5 seconds
  }
  
  function resetAutoSlide() {
      clearInterval(autoSlideInterval);
      startAutoSlide();
  }
  
  // Initialize
  document.addEventListener('DOMContentLoaded', () => {
      updateSlider();
      startAutoSlide();
      
      // Make entire cards clickable
      document.querySelectorAll('.program-card').forEach(card => {
          card.style.cursor = 'pointer';
      });
  });
</script>

<!-- Team -->
<div class="p-6 max-w-7xl mx-auto">
  <!-- Header: Judul dan Indikator -->
  <div class="flex justify-between items-center mb-4">
      <h2 class="text-2xl font-bold text-indigo-800">Team Kurikulum</h2>
     <!-- Indicators -->
     <div class="flex items-center space-x-2" id="indicators">
      <button class="h-2 w-6 rounded-full bg-gray-300 focus:outline-none transition-all duration-300" data-slide="0"></button>
      <button class="h-2 w-2 rounded-full bg-gray-300 focus:outline-none transition-all duration-300" data-slide="1"></button>
      <button class="h-2 w-2 rounded-full bg-gray-300 focus:outline-none transition-all duration-300" data-slide="2"></button>
    </div>
  </div>

  <!-- Carousel wrapper -->
  <div class="relative overflow-hidden">
    <div id="carousel" class="flex transition-transform duration-500 ease-in-out" style="gap: 1.75rem;">
      <!-- Card 1 - Kurikulum MBKM -->
      <div class="bg-white rounded-xl overflow-hidden shadow-lg flex-shrink-0 w-[calc((100% - (3*1.75rem))/4)] transform hover:scale-[1.03] hover:shadow-xl transition-all duration-300">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-purple-400 to-pink-500"></div>
        <div class="p-4">
          <span class="text-xs bg-green-600 text-white px-3 py-1 rounded-full shadow-sm">KURIKULUM</span>
          <h3 class="font-bold text-lg text-gray-800 mt-2">Kurikulum MBKM 2024</h3>
          <p class="text-gray-600 text-sm">Program Studi Teknik Informatika</p>
          <div class="mt-4 pt-4 border-t border-gray-100">
            <div class="flex flex-wrap gap-2">
              <span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded">#MerdekaBelajar</span>
              <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">#KampusMerdeka</span>
            </div>
            <p class="text-gray-500 text-sm mt-3">Update terbaru: Jan 2024</p>
          </div>
        </div>
      </div>

      <!-- Card 2 - Dosen Profesor -->
      <div class="bg-white rounded-xl overflow-hidden shadow-lg flex-shrink-0 w-[calc((100% - (3*1.75rem))/4)] transform hover:scale-[1.03] hover:shadow-xl transition-all duration-300">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-400 to-indigo-500"></div>
        <div class="p-4">
          <span class="text-xs bg-indigo-600 text-white px-3 py-1 rounded-full shadow-sm">PROFESOR</span>
          <h3 class="font-bold text-lg text-gray-800 mt-2">Prof. Dr. Putri Sari, M.Sc.</h3>
          <p class="text-gray-600 text-sm">Fakultas Teknologi Informasi</p>
          <div class="mt-4 pt-4 border-t border-gray-100">
            <p class="text-gray-700 text-sm font-medium">Spesialisasi:</p>
            <p class="text-gray-500 text-sm mt-1">Kecerdasan Buatan</p>
          </div>
        </div>
      </div>

      <!-- Card 3 - Dosen Doktor -->
      <div class="bg-white rounded-xl overflow-hidden shadow-lg flex-shrink-0 w-[calc((100% - (3*1.75rem))/4)] transform hover:scale-[1.03] hover:shadow-xl transition-all duration-300">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-green-400 to-teal-500"></div>
        <div class="p-4">
          <span class="text-xs bg-teal-600 text-white px-3 py-1 rounded-full shadow-sm">DOKTOR</span>
          <h3 class="font-bold text-lg text-gray-800 mt-2">Dr. Ahmad Fauzi, M.Kom.</h3>
          <p class="text-gray-600 text-sm">Fakultas Ilmu Komputer</p>
          <div class="mt-4 pt-4 border-t border-gray-100">
            <p class="text-gray-700 text-sm font-medium">Spesialisasi:</p>
            <p class="text-gray-500 text-sm mt-1">Data Science</p>
          </div>
        </div>
      </div>

      <!-- Card 4 - Guru Besar -->
      <div class="bg-white rounded-xl overflow-hidden shadow-lg flex-shrink-0 w-[calc((100% - (3*1.75rem))/4)] transform hover:scale-[1.03] hover:shadow-xl transition-all duration-300">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-purple-400 to-indigo-500"></div>
        <div class="p-4">
          <span class="text-xs bg-purple-600 text-white px-3 py-1 rounded-full shadow-sm">GURU BESAR</span>
          <h3 class="font-bold text-lg text-gray-800 mt-2">Prof. Dr. Siti Rahayu, Ph.D</h3>
          <p class="text-gray-600 text-sm">Fakultas Kedokteran</p>
          <div class="mt-4 pt-4 border-t border-gray-100">
            <p class="text-gray-700 text-sm font-medium">Spesialisasi:</p>
            <p class="text-gray-500 text-sm mt-1">Neurologi</p>
          </div>
        </div>
      </div>
      
  
    </div>
  </div>
</div>

<script>
 document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.getElementById('carousel');
    const cards = document.querySelectorAll('#carousel > div');
    const indicators = document.querySelectorAll('#indicators button');
    
    const cardWidth = cards[0].offsetWidth + 28; // width + gap
    let currentIndex = 0;
    const maxVisibleCards = 4;
    const totalSlides = Math.ceil(cards.length / maxVisibleCards);
    let autoSlideInterval;
    let isAnimating = false;
    
    // Initialize carousel
    function initCarousel() {
      updateCarousel();
      startAutoSlide();
    }
    
    // Update carousel position
    function updateCarousel() {
      if (isAnimating) return;
      isAnimating = true;
      
      carousel.style.transition = 'transform 0.5s ease-in-out';
      carousel.style.transform = `translateX(-${currentIndex * cardWidth}px)`;
      
      setTimeout(() => {
        isAnimating = false;
      }, 500);
      
      updateIndicators();
    }
    
    // Update indicators
    function updateIndicators() {
      const activeIndicator = Math.floor(currentIndex / maxVisibleCards);
      indicators.forEach((indicator, index) => {
        if (index === activeIndicator) {
          // Active indicator
          indicator.classList.remove('w-2', 'bg-gray-300', 'hover:bg-indigo-600');
          indicator.classList.add('w-6', 'bg-indigo-600');
        } else {
          // Inactive indicator
          indicator.classList.remove('w-6', 'bg-indigo-600');
          indicator.classList.add('w-2', 'bg-gray-300', 'hover:bg-indigo-600');
        }
      });
    }
    
    // Go to specific slide (showing 4 cards at a time)
    function goToSlide(slideIndex) {
      currentIndex = slideIndex * maxVisibleCards;
      if (currentIndex > cards.length - maxVisibleCards) {
        currentIndex = cards.length - maxVisibleCards;
      }
      updateCarousel();
      resetAutoSlide();
    }
    
    // Next card (single card movement)
    function nextCard() {
      if (currentIndex < cards.length - maxVisibleCards) {
        currentIndex++;
      } else {
        // If at end, loop back to start with animation
        currentIndex = 0;
      }
      updateCarousel();
      resetAutoSlide();
    }
    
    // Previous card (single card movement)
    function prevCard() {
      if (currentIndex > 0) {
        currentIndex--;
      } else {
        // If at start, loop to end with animation
        currentIndex = cards.length - maxVisibleCards;
      }
      updateCarousel();
      resetAutoSlide();
    }
    
    // Auto slide
    function startAutoSlide() {
      autoSlideInterval = setInterval(nextCard, 3000); // Slide every 3 seconds
    }
    
    function resetAutoSlide() {
      clearInterval(autoSlideInterval);
      startAutoSlide();
    }
    
    // Event listeners for indicators with animation
    indicators.forEach((indicator, index) => {
      indicator.addEventListener('click', () => {
        if (isAnimating) return;
        
        // Add click animation
        indicator.classList.add('transform', 'scale-125');
        setTimeout(() => {
          indicator.classList.remove('transform', 'scale-125');
        }, 300);
        
        goToSlide(index);
      });
    });
    
    // Initialize
    initCarousel();
    
    // Pause on hover
    carousel.addEventListener('mouseenter', () => {
      clearInterval(autoSlideInterval);
    });
    
    carousel.addEventListener('mouseleave', () => {
      resetAutoSlide();
    });
    
    // Touch events for mobile
    let touchStartX = 0;
    let touchEndX = 0;
    
    carousel.addEventListener('touchstart', (e) => {
      touchStartX = e.changedTouches[0].screenX;
      clearInterval(autoSlideInterval);
    });
    
    carousel.addEventListener('touchend', (e) => {
      touchEndX = e.changedTouches[0].screenX;
      handleSwipe();
      resetAutoSlide();
    });
    
    function handleSwipe() {
      const threshold = 50;
      if (touchEndX < touchStartX - threshold) {
        nextCard();
      } else if (touchEndX > touchStartX + threshold) {
        prevCard();
      }
    }
    
    // Responsive adjustments
    function handleResize() {
      const newCardWidth = cards[0].offsetWidth + 28;
      carousel.style.transform = `translateX(-${currentIndex * newCardWidth}px)`;
    }
    
    window.addEventListener('resize', handleResize);
  });
</script>


  <!-- Footer -->
 <footer class="bg-gray-800 text-white py-12 mt-20">
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
