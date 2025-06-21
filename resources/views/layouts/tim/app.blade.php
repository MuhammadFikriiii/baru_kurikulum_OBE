<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kurikulum OBE')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    @vite(['resources/js/app.js'])
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        }
    </script>
    <!-- JS drop done download -->
    <script>
        function toggleDropdown() {
        const menu = document.getElementById("dropdownMenu");
        menu.classList.toggle("hidden");
        }
    
        document.addEventListener("click", function (e) {
        const button = e.target.closest("button");
        const dropdown = document.getElementById("dropdownMenu");
        if (!button && !e.target.closest("#dropdownMenu")) {
            dropdown.classList.add("hidden");
        }
        });
    </script>

    <!-- JS drop done profil -->
    <script>
        function toggleDropdownProfil() {
        const dropdown = document.getElementById("userDropdown");
        dropdown.classList.toggle("hidden");
        }
    
        document.addEventListener("click", function (event) {
        const button = event.target.closest("button");
        const dropdown = document.getElementById("userDropdown");
        if (!button && !event.target.closest("#userDropdown")) {
            dropdown.classList.add("hidden");
        }
        });
    </script>
</head>
<body class="">

    <!-- Navbar -->
    <nav class="bg-gray-900 text-white px-6 py-1 flex items-center justify-between  fixed top-0 left-0 w-full z-50 shadow">
        <div class="flex items-center space-x-6">
            <span class="font-bold text-xl uppercase">Poliban OBE</span>
        </div>
        <div class="hidden md:flex space-x-6 items-center">
            <span class="relative group text-2xl">
                {{ auth()->user()->name }}
                <span class="absolute left-0 bottom-0 block w-0 h-[2px] bg-white"></span>
            </span>
            
           <div class="relative ">
                <div id="dropdownMenu" class="absolute hidden bg-white text-gray-900 rounded-lg shadow-md mt-2 w-32 z-50 border border-gray-300">
                    <a href="#" class="block px-4 py-2 hover:bg-gray-300 rounded-lg">PDF</a>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-300 rounded-lg">DOCX</a>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-300 rounded-lg">Excel</a>
                </div>
            </div>

            <div class="relative p-4">
                <button onclick="toggleDropdownProfil()" class="flex items-center space-x-2 focus:outline-none">
                    <img src="https://i.pravatar.cc/40" alt="User" class="w-10 h-10 rounded-full">
                    <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414L10 13.414 5.293 8.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
    
                <div id="userDropdown" class="absolute right-0 mt-2  bg-white text-black rounded-md shadow-lg py-2 hidden w-48 z-50">
                    <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100">
                        <i class="fas fa-sliders-h mr-2"></i> Account
                    </a>
                    <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100">
                        <i class="fas fa-cog mr-2"></i> Settings
                    </a>
                    <div class="border-t my-1"></div>
                    <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center px-4 py-2 hover:bg-gray-100 text-red-600">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        <span class="ml-2">Logout</span>
                    </button>
                </form>
                </div>
            </div>

        </div>
    </nav>

    <!-- Sidebar -->
    <aside id="sidebar" class="w-64 bg-gray-800 text-white p-5 space-y-6 fixed top-0 left-0 h-full transform -translate-x-full md:translate-x-0 transition-transform duration-300 z-40 overflow-auto">
        <!-- Header -->
        <div class="flex items-center justify-between mb-4 pt-2 mt-16 ">
            <h2 class="text-xl font-bold">Dashboard Tim</h2>
            <button class="md:hidden" onclick="toggleSidebar()">✖</button>
        </div>

        <!-- Search bar -->
        <div>
            <input type="text" id="search-sidebar" placeholder="Search..." class="w-full p-2 rounded bg-gray-700 placeholder-gray-400 text-white focus:outline-none">
        </div>

        <!-- Navigation -->
        <ul class="space-y-1">
            <li>
                <a href="{{ route('tim.dashboard') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="ml-2">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('tim.tahun.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                    <i class="fas fa-user-graduate"></i>
                    <span class="ml-2">Tahun</span>
                </a>
            </li>
            <li>
                <a href="{{ route('tim.profillulusan.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                    <i class="fas fa-user-graduate"></i>
                    <span class="ml-2">Profil Lulusan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('tim.capaianpembelajaranlulusan.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                    <i class="fas fa-book-open"></i>
                    <span class="ml-2">CPL Prodi</span>
                </a>
            </li>
            <li>
                <a href="{{ route('tim.pemetaancplpl.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                    <i class="fas fa-project-diagram"></i>
                    <span class="ml-2">CPL - PL</span>
                </a>
            </li>
            <li>
                <a href="{{ route('tim.bahankajian.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <span class="ml-2">Bahan Kajian</span>
                </a>
            </li>
            <li>
                <a href="{{ route('tim.pemetaancplbk.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                    <i class="fas fa-link"></i>
                    <span class="ml-2">CPL - BK</span>
                </a>
            </li>
            <li>
                <a href="{{ route('tim.matakuliah.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                    <i class="fas fa-book"></i>
                    <span class="ml-2">Mata Kuliah</span>
                </a>
            </li>
            <li>
                <a href="{{ route('tim.pemetaanbkmk.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                    <i class="fas fa-share-alt"></i>
                    <span class="ml-2">BK - MK</span>
                </a>
            </li>
            <li>
                <a href="{{ route('tim.pemetaancplmk.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                    <i class="fas fa-stream"></i>
                    <span class="ml-2">CPL - MK</span>
                </a>
            </li>
            <li>
                <a href="{{ route('tim.pemetaancplmkbk.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                    <i class="fas fa-link"></i>
                    <span class="ml-2">CPL - MK - BK</span>
                </a>
            </li>
            <li>
                <a href="{{ route('tim.matakuliah.organisasimk') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <span class="ml-2">Organisasi MK</span>
                </a>
            </li>
            <li>
                <a href="{{ route('tim.capaianpembelajaranmatakuliah.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                    <i class="fas fa-sliders-h"></i>
                    <span class="ml-2">CPMK</span>
                </a>
            </li>
            <li>
                <a href="{{ route('tim.pemenuhancpl.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                    <i class="fas fa-share-alt"></i>
                    <span class="ml-2">Pemenuhan CPL</span>
                </a>
            </li>
            <li>
                <a href="{{ route('tim.pemetaancplcpmkmk.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                    <i class="fas fa-sliders-h"></i>
                    <span class="ml-2">Pemetaan CPL - CPMK - MK</span>
                </a>
            </li>
            <li>
                <a href="{{ route('tim.pemetaancplcpmkmk.pemenuhancplcpmkmk') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                    <i class="fas fa-share-alt"></i>
                    <span class="ml-2">Pemenuhan CPL - CPMK - MK</span>
                </a>
            </li>
            <li>
                <a href="{{ route('tim.pemetaancplcpmkmk.pemetaanmkcplcpmk') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                    <i class="fas fa-share-alt"></i>
                    <span class="ml-2">Pemetaan CPL - MK - CPMK</span>
                </a>
            </li>
            <li>
                <a href="{{ route('tim.subcpmk.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                    <i class="fas fa-share-alt"></i>
                    <span class="ml-2">SUB CPMK</span>
                </a>
            </li>
            <li>
                <a href="{{ route('tim.pemetaanmkcpmksubcpmk.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                    <i class="fas fa-share-alt"></i>
                    <span class="ml-2">Pemetaan MK - CPMK - SubCPMK</span>
                </a>
            </li>
            <li>
                <a href="{{ route('tim.bobot.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                    <i class="fas fa-share-alt"></i>
                    <span class="ml-2">Bobot</span>
                </a>
            </li>
            <li>
                <a href="{{ route('tim.notes.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                    <i class="fas fa-share-alt"></i>
                    <span class="ml-2">Catatan</span>
                </a>
            </li>
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center p-3 hover:bg-gray-700 rounded text-left">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="ml-2">Logout</span>
                    </button>
                </form>
            </li>            
        </ul>
    </aside>

    <!-- Konetn utama -->
    <div class="flex-1 md:ml-64 p-6 pt-28">
        <!-- Toggle Button (Mobile) -->
        <div class="md:hidden mb-4">
            <button onclick="toggleSidebar()" class="bg-gray-800 text-white px-4 py-2 rounded">☰ Menu</button>
        </div>
        @yield('content')
    </div>
@stack('scripts')
</body>
</html>