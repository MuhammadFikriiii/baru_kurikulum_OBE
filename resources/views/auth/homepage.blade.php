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
<div class="container mx-auto px-4 py-12">
  <h1 class="text-2xl text-center font-bold text-indigo-800 mb-2">Program Studi</h1>
  <p class=" font-bold text-center text-gray-600 mb-8 ">Macam-macam program studi</p>
  
  <!-- Navigation -->
  <div class="flex flex-wrap justify-center mb-8 gap-2">
      <button onclick="showSlide(0)" class="program-tab px-4 py-2 rounded-lg bg-blue-600 text-white font-medium transition active">Teknik Sipil</button>
      <button onclick="showSlide(1)" class="program-tab px-4 py-2 rounded-lg bg-gray-200 font-medium transition">Teknik Mesin</button>
      <button onclick="showSlide(2)" class="program-tab px-4 py-2 rounded-lg bg-gray-200 font-medium transition">Teknik Elektro</button>
      <button onclick="showSlide(3)" class="program-tab px-4 py-2 rounded-lg bg-gray-200 font-medium transition">Akutansi</button>
      <button onclick="showSlide(4)" class="program-tab px-4 py-2 rounded-lg bg-gray-200 font-medium transition">Administrasi Bisnis</button>
  </div>
  
  <!-- Slider -->
  <div class="relative">
      <!-- Previous -->
      <button onclick="prevSlide()" class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 z-10 bg-white p-3 rounded-full shadow-md hover:bg-gray-100 transition">
          <i class="fas fa-chevron-left text-blue-600"></i>
      </button>
      
      <!-- Slides -->
      <div class="overflow-hidden">
          <div id="program-slider" class="program-slider flex" style="width: 500%;">
              <!-- Teknik Elektro -->
              <div class="w-full px-4">
                  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                      <div class="program-card bg-white rounded-xl shadow-md overflow-hidden" onclick="window.location.href='#'">
                          <img src="https://images.unsplash.com/photo-1508514177221-188b1cf16e9d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1472&q=80" alt="Teknik Listrik" class="w-full h-48 object-cover">
                          <div class="p-6">
                              <h3 class="text-xl font-bold text-gray-800 mb-2">D3 Teknik Listrik</h3>
                              <p class="text-gray-600 mb-4">Program studi yang mempelajari sistem tenaga listrik, instalasi, dan distribusi daya.</p>
                              <div class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg">Kunjungi Website</div>
                          </div>
                      </div>
                      
                      <div class="program-card bg-white rounded-xl shadow-md overflow-hidden" onclick="window.location.href='#'">
                          <img src="https://images.unsplash.com/photo-1551269901-5c5e14c25df7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1469&q=80" alt="Elektronika" class="w-full h-48 object-cover">
                          <div class="p-6">
                              <h3 class="text-xl font-bold text-gray-800 mb-2">D3 Elektronika</h3>
                              <p class="text-gray-600 mb-4">Mempelajari komponen elektronika, rangkaian digital, dan sistem kendali elektronik.</p>
                              <div class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg">Kunjungi Website</div>
                          </div>
                      </div>
                      
                      <div class="program-card bg-white rounded-xl shadow-md overflow-hidden" onclick="window.location.href='#'">
                          <img src="https://images.unsplash.com/photo-1518770660439-4636190af475?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Teknik Informatika" class="w-full h-48 object-cover">
                          <div class="p-6">
                              <h3 class="text-xl font-bold text-gray-800 mb-2">D3 Teknik Informatika</h3>
                              <p class="text-gray-600 mb-4">Berfokus pada pengembangan perangkat lunak, jaringan komputer, dan basis data.</p>
                              <div class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg">Kunjungi Website</div>
                          </div>
                      </div>
                  </div>
              </div>

              <!-- Teknik Sipil -->
              <div class="w-full px-4">
                  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                      <div class="program-card bg-white rounded-xl shadow-md overflow-hidden" onclick="window.location.href='#'">
                          <img src="https://images.unsplash.com/photo-1605152276897-4f618f831968?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Teknik Sipil" class="w-full h-48 object-cover">
                          <div class="p-6">
                              <h3 class="text-xl font-bold text-gray-800 mb-2">D3 Teknik Sipil</h3>
                              <p class="text-gray-600 mb-4">Program studi yang mempelajari perencanaan, perancangan, konstruksi, dan pemeliharaan infrastruktur.</p>
                              <div class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg">Kunjungi Website</div>
                          </div>
                      </div>
                      
                      <div class="program-card bg-white rounded-xl shadow-md overflow-hidden" onclick="window.location.href='#'">
                          <img src="https://images.unsplash.com/photo-1581093450021-4a7360e9a7e6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Teknik Bangunan Rawa" class="w-full h-48 object-cover">
                          <div class="p-6">
                              <h3 class="text-xl font-bold text-gray-800 mb-2">D4 Teknik Bangunan Rawa</h3>
                              <p class="text-gray-600 mb-4">Spesialisasi dalam konstruksi bangunan di daerah rawa dengan pendekatan berkelanjutan.</p>
                              <div class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg">Kunjungi Website</div>
                          </div>
                      </div>
                      
                      <div class="program-card bg-white rounded-xl shadow-md overflow-hidden" onclick="window.location.href='#'">
                          <img src="https://images.unsplash.com/photo-1500382017468-9049fed747ef?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Teknik Geodesi" class="w-full h-48 object-cover">
                          <div class="p-6">
                              <h3 class="text-xl font-bold text-gray-800 mb-2">D3 Teknik Geodesi</h3>
                              <p class="text-gray-600 mb-4">Mempelajari pengukuran dan pemetaan permukaan bumi untuk berbagai keperluan konstruksi.</p>
                              <div class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg">Kunjungi Website</div>
                          </div>
                      </div>
                  </div>
              </div>
              
              <!-- Teknik Mesin -->
              <div class="w-full px-4">
                  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                      <div class="program-card bg-white rounded-xl shadow-md overflow-hidden" onclick="window.location.href='#'">
                          <img src="https://images.unsplash.com/photo-1518998053901-5348d3961a04?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80" alt="Teknik Mesin" class="w-full h-48 object-cover">
                          <div class="p-6">
                              <h3 class="text-xl font-bold text-gray-800 mb-2">D3 Teknik Mesin</h3>
                              <p class="text-gray-600 mb-4">Program studi yang berfokus pada perancangan, analisis, dan pemeliharaan sistem mekanik.</p>
                              <div class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg">Kunjungi Website</div>
                          </div>
                      </div>
                      
                      <div class="program-card bg-white rounded-xl shadow-md overflow-hidden" onclick="window.location.href='#'">
                          <img src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1583&q=80" alt="Teknik Mesin Otomotif" class="w-full h-48 object-cover">
                          <div class="p-6">
                              <h3 class="text-xl font-bold text-gray-800 mb-2">D3 Teknik Mesin Otomotif</h3>
                              <p class="text-gray-600 mb-4">Spesialisasi dalam teknologi otomotif, perawatan, dan perbaikan kendaraan bermotor.</p>
                              <div class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg">Kunjungi Website</div>
                          </div>
                      </div>
                      
                      <div class="program-card bg-white rounded-xl shadow-md overflow-hidden" onclick="window.location.href='#'">
                          <img src="https://images.unsplash.com/photo-1592155931584-901ac15763e3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Alat Berat" class="w-full h-48 object-cover">
                          <div class="p-6">
                              <h3 class="text-xl font-bold text-gray-800 mb-2">D3 Alat Berat</h3>
                              <p class="text-gray-600 mb-4">Mempelajari operasi, perawatan, dan manajemen alat berat untuk konstruksi dan pertambangan.</p>
                              <div class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg">Kunjungi Website</div>
                          </div>
                      </div>
                  </div>
              </div>
              
              
              
              <!-- Akutansi -->
              <div class="w-full px-4">
                  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                      <div class="program-card bg-white rounded-xl shadow-md overflow-hidden" onclick="window.location.href='#'">
                          <img src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1511&q=80" alt="Akuntansi" class="w-full h-48 object-cover">
                          <div class="p-6">
                              <h3 class="text-xl font-bold text-gray-800 mb-2">D3 Akuntansi</h3>
                              <p class="text-gray-600 mb-4">Program studi yang mempelajari pencatatan, pengklasifikasian, dan pelaporan transaksi keuangan.</p>
                              <div class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg">Kunjungi Website</div>
                          </div>
                      </div>
                      
                      <div class="program-card bg-white rounded-xl shadow-md overflow-hidden" onclick="window.location.href='#'">
                          <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Komputerisasi Akuntansi" class="w-full h-48 object-cover">
                          <div class="p-6">
                              <h3 class="text-xl font-bold text-gray-800 mb-2">D3 Komputerisasi Akuntansi</h3>
                              <p class="text-gray-600 mb-4">Mengintegrasikan ilmu akuntansi dengan teknologi informasi untuk sistem akuntansi digital.</p>
                              <div class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg">Kunjungi Website</div>
                          </div>
                      </div>
                      
                      <div class="program-card bg-white rounded-xl shadow-md overflow-hidden" onclick="window.location.href='#'">
                          <img src="https://images.unsplash.com/photo-1601597111158-2fceff292cdc?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Akuntansi Syariah" class="w-full h-48 object-cover">
                          <div class="p-6">
                              <h3 class="text-xl font-bold text-gray-800 mb-2">D4 Akuntansi Lembaga Keuangan Syariah</h3>
                              <p class="text-gray-600 mb-4">Spesialisasi akuntansi untuk lembaga keuangan yang beroperasi berdasarkan prinsip syariah.</p>
                              <div class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg">Kunjungi Website</div>
                          </div>
                      </div>
                  </div>
              </div>
              
              <!-- Administrasi Bisnis -->
              <div class="w-full px-4">
                  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                      <div class="program-card bg-white rounded-xl shadow-md overflow-hidden" onclick="window.location.href='#'">
                          <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Administrasi Bisnis" class="w-full h-48 object-cover">
                          <div class="p-6">
                              <h3 class="text-xl font-bold text-gray-800 mb-2">D3 Administrasi Bisnis</h3>
                              <p class="text-gray-600 mb-4">Program studi yang mempelajari manajemen perkantoran, korespondensi bisnis, dan administrasi.</p>
                              <div class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg">Kunjungi Website</div>
                          </div>
                      </div>
                      
                      <div class="program-card bg-white rounded-xl shadow-md overflow-hidden" onclick="window.location.href='#'">
                          <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Manajemen Informatika" class="w-full h-48 object-cover">
                          <div class="p-6">
                              <h3 class="text-xl font-bold text-gray-800 mb-2">D3 Manajemen Informatika</h3>
                              <p class="text-gray-600 mb-4">Mengintegrasikan ilmu manajemen dengan teknologi informasi untuk kebutuhan bisnis.</p>
                              <div class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg">Kunjungi Website</div>
                          </div>
                      </div>
                      
                      <div class="program-card bg-white rounded-xl shadow-md overflow-hidden" onclick="window.location.href='#'">
                          <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1415&q=80" alt="Bisnis Digital" class="w-full h-48 object-cover">
                          <div class="p-6">
                              <h3 class="text-xl font-bold text-gray-800 mb-2">D4 Bisnis Digital</h3>
                              <p class="text-gray-600 mb-4">Mempelajari transformasi digital bisnis, e-commerce, dan strategi pemasaran digital.</p>
                              <div class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg">Kunjungi Website</div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      
      <!-- Next Button -->
      <button onclick="nextSlide()" class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 z-10 bg-white p-3 rounded-full shadow-md hover:bg-gray-100 transition">
          <i class="fas fa-chevron-right text-blue-600"></i>
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
              tab.classList.add('active');
          } else {
              tab.classList.remove('active');
          }
      });
      
      // Update indicator dots
      document.querySelectorAll('.indicator-dot').forEach((dot, index) => {
          if (index === currentSlide) {
              dot.classList.add('active');
              dot.classList.remove('bg-gray-300');
          } else {
              dot.classList.remove('active');
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
    <!-- Indicators (3 tombol untuk 7 card dengan geser 1 card) -->
    <div class="flex items-center space-x-2" id="indicators">
      <button class="h-2 w-6 rounded-full bg-indigo-600 focus:outline-none transition-all duration-300" data-slide="0"></button>
      <button class="h-2 w-2 rounded-full bg-gray-300 focus:outline-none transition-all duration-300" data-slide="1"></button>
      <button class="h-2 w-2 rounded-full bg-gray-300 focus:outline-none transition-all duration-300" data-slide="2"></button>
    </div>
  </div>

  <!-- Carousel wrapper -->
  <div class="relative overflow-hidden">
    <div id="carousel" class="flex transition-transform duration-700 ease-in-out" style="gap: 1.75rem;">

    <div class="bg-white rounded-xl overflow-hidden shadow-lg flex-shrink-0 w-[calc((100% - (3*1.75rem))/4)] transform hover:scale-[1.03] hover:shadow-xl transition-all duration-300 relative group">
      <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 z-10 rounded-xl"></div>
      <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-purple-400 to-pink-500"></div>
      
      <div class="relative">
        <div class="w-32 h-32 mx-auto mt-6 rounded-full overflow-hidden border-4 border-white shadow-md bg-gray-100 flex items-center justify-center group-hover:bg-gray-50 transition-all duration-300">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-purple-500 group-hover:scale-110 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
          </svg>
        </div>
        <span class="absolute top-28 left-1/2 transform -translate-x-1/2 text-xs bg-green-600 text-white px-3 py-1 rounded-full shadow-sm group-hover:scale-105 transition-transform duration-300">KURIKULUM</span>
      </div>
      
      <div class="p-4 pt-6 text-center">
        <h3 class="font-bold text-lg text-gray-800 group-hover:text-green-700 transition-colors duration-300">Kurikulum MBKM 2024</h3>
        <p class="text-gray-600 text-sm mt-1">Program Studi Teknik Informatika</p>
        
        <div class="mt-4 pt-4 border-t border-gray-100 group-hover:border-gray-200 transition-colors duration-300">
          <div class="flex justify-center space-x-2">
            <span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded group-hover:scale-105 transition-transform duration-300">#MerdekaBelajar</span>
            <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded group-hover:scale-105 transition-transform duration-300">#KampusMerdeka</span>
          </div>
          <p class="text-gray-500 text-sm mt-3">Update terbaru: Jan 2024</p>
        </div>
      </div>
    </div>

    <!-- Card 2 - Dosen Profesor -->
    <div class="bg-white rounded-xl overflow-hidden shadow-lg flex-shrink-0 w-[calc((100% - (3*1.75rem))/4)] transform hover:scale-[1.03] hover:shadow-xl transition-all duration-300 relative group">
      <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 z-10 rounded-xl"></div>
      <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-400 to-indigo-500"></div>
      
      <div class="relative">
        <div class="w-32 h-32 mx-auto mt-6 rounded-full overflow-hidden border-4 border-white shadow-md group-hover:border-blue-100 transition-all duration-300">
          <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80" alt="Dosen" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
        </div>
        <span class="absolute top-28 left-1/2 transform -translate-x-1/2 text-xs bg-indigo-600 text-white px-3 py-1 rounded-full shadow-sm group-hover:scale-105 transition-transform duration-300">PROFESOR</span>
      </div>
      
      <div class="p-4 pt-6 text-center">
        <h3 class="font-bold text-lg text-gray-800 group-hover:text-indigo-700 transition-colors duration-300">Prof. Dr. Putri Sari, M.Sc.</h3>
        <p class="text-gray-600 text-sm mt-1">Fakultas Teknologi Informasi</p>
        
        <div class="mt-4 pt-4 border-t border-gray-100 group-hover:border-gray-200 transition-colors duration-300">
          <p class="text-gray-700 text-sm font-medium">Spesialisasi:</p>
          <p class="text-gray-500 text-sm mt-1">Kecerdasan Buatan</p>
        </div>
      </div>
    </div>

    <!-- Card 3 - Dosen Doktor -->
    <div class="bg-white rounded-xl overflow-hidden shadow-lg flex-shrink-0 w-[calc((100% - (3*1.75rem))/4)] transform hover:scale-[1.03] hover:shadow-xl transition-all duration-300 relative group">
      <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 z-10 rounded-xl"></div>
      <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-green-400 to-teal-500"></div>
      
      <div class="relative">
        <div class="w-32 h-32 mx-auto mt-6 rounded-full overflow-hidden border-4 border-white shadow-md group-hover:border-green-100 transition-all duration-300">
          <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=400&q=80" alt="Dosen" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
        </div>
        <span class="absolute top-28 left-1/2 transform -translate-x-1/2 text-xs bg-teal-600 text-white px-3 py-1 rounded-full shadow-sm group-hover:scale-105 transition-transform duration-300">DOKTOR</span>
      </div>
      
      <div class="p-4 pt-6 text-center">
        <h3 class="font-bold text-lg text-gray-800 group-hover:text-teal-700 transition-colors duration-300">Dr. Ahmad Fauzi, M.Kom.</h3>
        <p class="text-gray-600 text-sm mt-1">Fakultas Ilmu Komputer</p>
        
        <div class="mt-4 pt-4 border-t border-gray-100 group-hover:border-gray-200 transition-colors duration-300">
          <p class="text-gray-700 text-sm font-medium">Spesialisasi:</p>
          <p class="text-gray-500 text-sm mt-1">Data Science</p>
        </div>
      </div>
    </div>

    <!-- Card 4 - Guru Besar -->
    <div class="bg-white rounded-xl overflow-hidden shadow-lg flex-shrink-0 w-[calc((100% - (3*1.75rem))/4)] transform hover:scale-[1.03] hover:shadow-xl transition-all duration-300 relative group">
      <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 z-10 rounded-xl"></div>
      <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-purple-400 to-indigo-500"></div>
      
      <div class="relative">
        <div class="w-32 h-32 mx-auto mt-6 rounded-full overflow-hidden border-4 border-white shadow-md group-hover:border-purple-100 transition-all duration-300">
          <img src="https://images.unsplash.com/photo-1542190891-2093d38760f2?auto=format&fit=crop&w=400&q=80" alt="Dosen" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
        </div>
        <span class="absolute top-28 left-1/2 transform -translate-x-1/2 text-xs bg-purple-600 text-white px-3 py-1 rounded-full shadow-sm group-hover:scale-105 transition-transform duration-300">GURU BESAR</span>
      </div>
      
      <div class="p-4 pt-6 text-center">
        <h3 class="font-bold text-lg text-gray-800 group-hover:text-purple-700 transition-colors duration-300">Prof. Dr. Siti Rahayu, Ph.D</h3>
        <p class="text-gray-600 text-sm mt-1">Fakultas Kedokteran</p>
        
        <div class="mt-4 pt-4 border-t border-gray-100 group-hover:border-gray-200 transition-colors duration-300">
          <p class="text-gray-700 text-sm font-medium">Spesialisasi:</p>
          <p class="text-gray-500 text-sm mt-1">Neurologi</p>
        </div>
      </div>
    </div>

    <!-- Card 5 - NEW: Kurikulum Internasional -->
    <div class="bg-white rounded-xl overflow-hidden shadow-lg flex-shrink-0 w-[calc((100% - (3*1.75rem))/4)] transform hover:scale-[1.03] hover:shadow-xl transition-all duration-300 relative group">
      <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 z-10 rounded-xl"></div>
      <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-red-400 to-orange-500"></div>
      
      <div class="relative">
        <div class="w-32 h-32 mx-auto mt-6 rounded-full overflow-hidden border-4 border-white shadow-md bg-gray-100 flex items-center justify-center group-hover:bg-gray-50 transition-all duration-300">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-red-500 group-hover:scale-110 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
        </div>
        <span class="absolute top-28 left-1/2 transform -translate-x-1/2 text-xs bg-orange-600 text-white px-3 py-1 rounded-full shadow-sm group-hover:scale-105 transition-transform duration-300">INTERNASIONAL</span>
      </div>
      
      <div class="p-4 pt-6 text-center">
        <h3 class="font-bold text-lg text-gray-800 group-hover:text-orange-700 transition-colors duration-300">Kurikulum Internasional</h3>
        <p class="text-gray-600 text-sm mt-1">Program Studi Kedokteran</p>
        
        <div class="mt-4 pt-4 border-t border-gray-100 group-hover:border-gray-200 transition-colors duration-300">
          <div class="flex justify-center space-x-2">
            <span class="inline-block bg-red-100 text-red-800 text-xs px-2 py-1 rounded group-hover:scale-105 transition-transform duration-300">#AkreditasiA</span>
            <span class="inline-block bg-orange-100 text-orange-800 text-xs px-2 py-1 rounded group-hover:scale-105 transition-transform duration-300">#Global</span>
          </div>
          <p class="text-gray-500 text-sm mt-3">Mulai berlaku: Agustus 2024</p>
        </div>
      </div>
    </div>

    <!-- Card 6 - NEW: Dosen Ahli -->
    <div class="bg-white rounded-xl overflow-hidden shadow-lg flex-shrink-0 w-[calc((100% - (3*1.75rem))/4)] transform hover:scale-[1.03] hover:shadow-xl transition-all duration-300 relative group">
      <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 z-10 rounded-xl"></div>
      <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-yellow-400 to-amber-500"></div>
      
      <div class="relative">
        <div class="w-32 h-32 mx-auto mt-6 rounded-full overflow-hidden border-4 border-white shadow-md group-hover:border-yellow-100 transition-all duration-300">
          <img src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?auto=format&fit=crop&w=400&q=80" alt="Dosen" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
        </div>
        <span class="absolute top-28 left-1/2 transform -translate-x-1/2 text-xs bg-amber-600 text-white px-3 py-1 rounded-full shadow-sm group-hover:scale-105 transition-transform duration-300">AHLI</span>
      </div>
      
      <div class="p-4 pt-6 text-center">
        <h3 class="font-bold text-lg text-gray-800 group-hover:text-amber-700 transition-colors duration-300">Dr. Rina Wijayanti, M.Eng</h3>
        <p class="text-gray-600 text-sm mt-1">Fakultas Teknik Elektro</p>
        
        <div class="mt-4 pt-4 border-t border-gray-100 group-hover:border-gray-200 transition-colors duration-300">
          <p class="text-gray-700 text-sm font-medium">Spesialisasi:</p>
          <p class="text-gray-500 text-sm mt-1">Robotika</p>
        </div>
      </div>
    </div>

    <!-- Card 7 - NEW: Tim Pengajar -->
    <div class="bg-white rounded-xl overflow-hidden shadow-lg flex-shrink-0 w-[calc((100% - (3*1.75rem))/4)] transform hover:scale-[1.03] hover:shadow-xl transition-all duration-300 relative group">
      <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 z-10 rounded-xl"></div>
      <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-pink-400 to-rose-500"></div>
      
      <div class="relative">
        <div class="w-32 h-32 mx-auto mt-6 rounded-full overflow-hidden border-4 border-white shadow-md bg-gray-100 flex items-center justify-center group-hover:bg-gray-50 transition-all duration-300">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-pink-500 group-hover:scale-110 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
          </svg>
        </div>
        <span class="absolute top-28 left-1/2 transform -translate-x-1/2 text-xs bg-rose-600 text-white px-3 py-1 rounded-full shadow-sm group-hover:scale-105 transition-transform duration-300">TIM PENGAJAR</span>
      </div>
      
      <div class="p-4 pt-6 text-center">
        <h3 class="font-bold text-lg text-gray-800 group-hover:text-rose-700 transition-colors duration-300">Tim Pengajar Berprestasi</h3>
        <p class="text-gray-600 text-sm mt-1">Fakultas Ekonomi & Bisnis</p>
        
        <div class="mt-4 pt-4 border-t border-gray-100 group-hover:border-gray-200 transition-colors duration-300">
          <div class="flex justify-center space-x-2">
            <span class="inline-block bg-pink-100 text-pink-800 text-xs px-2 py-1 rounded group-hover:scale-105 transition-transform duration-300">#JuaraNasional</span>
            <span class="inline-block bg-rose-100 text-rose-800 text-xs px-2 py-1 rounded group-hover:scale-105 transition-transform duration-300">#Inovasi</span>
          </div>
          <p class="text-gray-500 text-sm mt-3">Penghargaan: Mei 2024</p>
        </div>
      </div>
    </div>

    <!-- Card 8 - NEW: Kurikulum Industri -->
    <div class="bg-white rounded-xl overflow-hidden shadow-lg flex-shrink-0 w-[calc((100% - (3*1.75rem))/4)] transform hover:scale-[1.03] hover:shadow-xl transition-all duration-300 relative group">
      <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 z-10 rounded-xl"></div>
      <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-cyan-400 to-blue-500"></div>
      
      <div class="relative">
        <div class="w-32 h-32 mx-auto mt-6 rounded-full overflow-hidden border-4 border-white shadow-md bg-gray-100 flex items-center justify-center group-hover:bg-gray-50 transition-all duration-300">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-cyan-500 group-hover:scale-110 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
          </svg>
        </div>
        <span class="absolute top-28 left-1/2 transform -translate-x-1/2 text-xs bg-blue-600 text-white px-3 py-1 rounded-full shadow-sm group-hover:scale-105 transition-transform duration-300">INDUSTRI</span>
      </div>
      
      <div class="p-4 pt-6 text-center">
        <h3 class="font-bold text-lg text-gray-800 group-hover:text-blue-700 transition-colors duration-300">Kurikulum Link & Match</h3>
        <p class="text-gray-600 text-sm mt-1">Program Studi Teknik Industri</p>
        
        <div class="mt-4 pt-4 border-t border-gray-100 group-hover:border-gray-200 transition-colors duration-300">
          <div class="flex justify-center space-x-2">
            <span class="inline-block bg-cyan-100 text-cyan-800 text-xs px-2 py-1 rounded group-hover:scale-105 transition-transform duration-300">#Kerjasama</span>
            <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded group-hover:scale-105 transition-transform duration-300">#Industri</span>
          </div>
          <p class="text-gray-500 text-sm mt-3">Mulai berlaku: September 2024</p>
        </div>
      </div>
    </div>
     
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
  const carousel = document.querySelector('#carousel');
  const cards = carousel.children;
  const cardsPerView = 4; // Tampilkan 4 card sekaligus
  const totalCards = cards.length;
  const gap = 28; // px, sesuai gap-7
  const cardWidth = cards[0].offsetWidth;
  const slideDistance = cardWidth + gap; // Geser per 1 card
  
  let currentSlide = 0;
  const indicators = document.querySelectorAll('#indicators button');
  let slideInterval;

  function updateCarousel() {
    const moveX = currentSlide * slideDistance;
    carousel.style.transform = `translateX(-${moveX}px)`;

    // Update indikator
    indicators.forEach((btn, index) => {
      const isActive = index === Math.floor(currentSlide / cardsPerView);
      btn.classList.toggle('bg-blue-600', isActive);
      btn.classList.toggle('bg-gray-300', !isActive);
      btn.classList.toggle('w-6', isActive);
      btn.classList.toggle('w-2', !isActive);
    });
  }

  function startAutoSlide() {
    slideInterval = setInterval(() => {
      currentSlide = (currentSlide + 1) % totalCards;
      if (currentSlide >= totalCards) currentSlide = 0;
      updateCarousel();
    }, 3000);
  }

  // Event klik indikator
  indicators.forEach((btn, index) => {
    btn.addEventListener('click', function() {
      clearInterval(slideInterval);
      currentSlide = index * cardsPerView;
      updateCarousel();
      startAutoSlide();
    });
  });

  // Inisialisasi
  updateCarousel();
  startAutoSlide();
});
</script>

  <!-- Footer -->
  <footer class="bg-gray-800 text-white py-14 mt-20">
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
