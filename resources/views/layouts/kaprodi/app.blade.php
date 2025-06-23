<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kurikulum OBE')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

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
<nav class="bg-gray-900 text-white px-6 py-4 flex items-center justify-between fixed top-0 left-0 w-full z-50 shadow-md">
    <!-- Logo -->
    <div class="flex items-center space-x-4">
        <span class="font-bold text-xl uppercase">Poliban OBE</span>
    </div>
    
    <!-- User Menu -->
    <div class="flex items-center space-x-4 mr-6">
        <span class="hidden md:inline-block font-medium text-lg">
            {{ auth()->user()->name }}
        </span>
        <div class="relative">
            <button onclick="toggleDropdownProfil()" class="flex items-center focus:outline-none">
                <i class="bi bi-person-circle text-white text-2xl"></i>
                <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414L10 13.414 5.293 8.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </button>
            <div id="userDropdown" class="absolute right-0 mt-2 bg-white text-black rounded-md shadow-lg py-2 hidden w-48 z-50">
                <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100">
                    <i class="fas fa-sliders-h mr-2"></i> Account
                </a>
                <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100">
                    <i class="fas fa-cog mr-2"></i> Settings
                </a>
                <div class="border-t my-1"></div>
                <form action="{{ route('logout') }}" method="POST" onsubmit="clearSidebarState()">
                    @csrf
                    <button type="submit" class="w-full flex items-center px-4 py-2 hover:bg-gray-100 text-red-600 text-left">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<aside id="sidebar" class="w-[276px] bg-[#201F31] text-white p-5 pb-24 space-y-6 fixed top-16 left-0 h-[calc(100vh-4rem)] overflow-y-auto transform -translate-x-full md:translate-x-0 transition-transform duration-300">
    <!-- Header -->
    <div class="flex items-center justify-between mb-4 pt-2">
        <h2 class="text-xl font-bold">Dashboard Kaprodi</h2>
        <button class="md:hidden" onclick="toggleSidebar()">✖</button>
    </div>

    <!-- Search bar -->
    <div class="mb-4">
        <input id="searchInput" type="text" placeholder="Search..."
            class="w-full p-2 rounded bg-[#2c2b43] placeholder-gray-400 text-white focus:outline-none">
    </div>

    <!-- Navigation -->
    <ul class="space-y-2">
        <li data-title="Dashboard">
            <a href="{{ route('kaprodi.dashboard') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                <i class="bi bi-house-door mr-3"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="border-t border-gray-700 my-2"></li>

        <!-- Learning Outcomes -->
        <li>
            <p class="text-gray-400 uppercase text-xs font-semibold px-3 py-2">Learning Outcomes</p>
            <ul class="ml-2 space-y-1">
                <li data-title="Profil Lulusan">
                    <a href="{{ route('kaprodi.profillulusan.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                        <i class="bi bi-file-earmark-person mr-3"></i>
                        <span>Profil Lulusan</span>
                    </a>
                </li>
                <li data-title="CPL Prodi">
                    <a href="{{ route('kaprodi.capaianpembelajaranlulusan.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                        <i class="bi bi-check2-square mr-3"></i>
                        <span>CPL Prodi</span>
                    </a>
                </li>
                <li data-title="CPL - PL">
                    <a href="{{ route('kaprodi.pemetaancplpl.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                        <i class="bi bi-diagram-3 mr-3"></i>
                        <span>CPL - PL</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="border-t border-gray-700 my-2"></li>

        <!-- Curriculum Development -->
        <li>
            <p class="text-gray-400 uppercase text-xs font-semibold px-3 py-2">Curriculum</p>
            <ul class="ml-2 space-y-1">
                <li data-title="Bahan Kajian">
                    <a href="{{ route('kaprodi.bahankajian.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                        <i class="bi bi-journal-bookmark mr-3"></i>
                        <span>Bahan Kajian</span>
                    </a>
                </li>
                <li data-title="CPL - BK">
                    <a href="{{ route('kaprodi.pemetaancplbk.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                        <i class="bi bi-pin-map mr-3"></i>
                        <span>CPL - BK</span>
                    </a>
                </li>
                <li data-title="Mata Kuliah">
                    <a href="{{ route('kaprodi.matakuliah.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                        <i class="bi bi-book mr-3"></i>
                        <span>Mata Kuliah</span>
                    </a>
                </li>
                <li data-title="BK - MK">
                    <a href="{{ route('kaprodi.pemetaanbkmk.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                        <i class="bi bi-link-45deg mr-3"></i>
                        <span>BK - MK</span>
                    </a>
                </li>
                <li data-title="CPL - MK">
                    <a href="{{ route('kaprodi.pemetaancplmk.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                        <i class="bi bi-bar-chart mr-3"></i>
                        <span>CPL - MK</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="border-t border-gray-700 my-2"></li>

        <!-- Advanced Mapping -->
        <li>
            <p class="text-gray-400 uppercase text-xs font-semibold px-3 py-2">Advanced Mapping</p>
            <ul class="ml-2 space-y-1">
                <li data-title="CPL - MK - BK">
                    <a href="{{ route('kaprodi.pemetaancplmkbk.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                        <i class="bi bi-diagram-3 mr-3"></i>
                        <span>CPL - MK - BK</span>
                    </a>
                </li>
                <li data-title="Organisasi MK">
                    <a href="{{ route('kaprodi.matakuliah.organisasimk') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                        <i class="bi bi-columns mr-3"></i>
                        <span>Organisasi MK</span>
                    </a>
                </li>
                <li data-title="CPMK">
                    <a href="{{ route('kaprodi.capaianpembelajaranmatakuliah.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                        <i class="bi bi-list-check mr-3"></i>
                        <span>CPMK</span>
                    </a>
                </li>
                <li data-title="SUB CPMK">
                    <a href="{{ route('kaprodi.subcpmk.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                        <i class="bi bi-list-ol mr-3"></i>
                        <span>SUB CPMK</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="border-t border-gray-700 my-2"></li>

        <!-- Reports & Analysis -->
        <li>
            <p class="text-gray-400 uppercase text-xs font-semibold px-3 py-2">Reports & Analysis</p>
            <ul class="ml-2 space-y-1">
                <li data-title="Pemenuhan CPL">
                    <a href="{{ route('kaprodi.pemenuhancpl.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                        <i class="bi bi-percent mr-3"></i>
                        <span>Pemenuhan CPL</span>
                    </a>
                </li>
                <li data-title="Pemetaan CPL - CPMK - MK">
                    <a href="{{ route('kaprodi.pemetaancplcpmkmk.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                        <i class="bi bi-node-plus mr-3"></i>
                        <span>CPL - CPMK - MK</span>
                    </a>
                </li>
                <li data-title="Pemenuhan CPL - CPMK - MK">
                    <a href="{{ route('kaprodi.pemetaancplcpmkmk.pemenuhancplcpmkmk') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                        <i class="bi bi-pie-chart mr-3"></i>
                        <span>Pemenuhan CPL-CPMK-MK</span>
                    </a>
                </li>
                <li data-title="Pemetaan CPL - MK - CPMK">
                    <a href="{{ route('kaprodi.pemetaancplcpmkmk.pemetaanmkcplcpmk') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                        <i class="bi bi-graph-up mr-3"></i>
                        <span>CPL - MK - CPMK</span>
                    </a>
                </li>
                <li data-title="Pemetaan MK - CPMK - SubCPMK">
                    <a href="{{ route('kaprodi.pemetaanmkcpmksubcpmk.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                        <i class="bi bi-diagram-2 mr-3"></i>
                        <span>MK - CPMK - SubCPMK</span>
                    </a>
                </li>
                <li data-title="Bobot">
                    <a href="{{ route('kaprodi.bobot.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                        <i class="bi bi-speedometer2 mr-3"></i>
                        <span>Bobot</span>
                    </a>
                </li>
                <li data-title="Catatan">
                    <a href="{{ route('kaprodi.notes.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                        <i class="bi bi-sticky mr-3"></i>
                        <span>Catatan</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="border-t border-gray-700 my-2"></li>

        <!-- Logout -->
        <li>
            <form action="{{ route('logout') }}" method="POST" onsubmit="clearSidebarState()">
                @csrf
                <button type="submit" class="w-full flex items-center p-3 hover:bg-gray-700 rounded">
                    <i class="fas fa-sign-out-alt mr-3"></i>
                    <span>Logout</span>
                </button>
            </form>
            <script>
                 function clearSidebarState() {
                        localStorage.removeItem('activeSidebarItem');
                        localStorage.removeItem('sidebarScroll'); // Tambahan untuk reset posisi scroll
                    }
            </script>
        </li>
    </ul>
</aside>

<!-- Active Item Highlighting -->
<style>
    .sidebar-active {
        background-color: #374151;
        font-weight: bold;
    }
</style>

<!-- Simpan Posisis Sidebar -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const sidebar = document.getElementById('sidebar');

        // Set scroll dari localStorage
        const savedScrollTop = localStorage.getItem('sidebarScroll');
        if (savedScrollTop) {
            sidebar.scrollTop = parseInt(savedScrollTop);
        }

        // Simpan scroll saat digulir
        sidebar.addEventListener('scroll', function () {
            localStorage.setItem('sidebarScroll', sidebar.scrollTop);
        });
    });
</script>

<style>
    /* Tambahkan transition untuk smooth scrolling */
    #sidebar {
        scroll-behavior: smooth;
    }
    .sidebar-active {
        background-color: #374151;
        font-weight: bold;
        position: relative;
    }
    
    /* Optional: tambahkan indicator untuk active item */
    .sidebar-active::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 3px;
        background-color: #3B82F6;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const menuItems = document.querySelectorAll('#sidebar ul li[data-title] a');

        // Ambil item aktif dari localStorage, jika tidak ada, default ke "Dashboard"
        let activeTitle = localStorage.getItem('activeSidebarItem');
        if (!activeTitle) {
            activeTitle = "Dashboard";
            localStorage.setItem('activeSidebarItem', activeTitle);
        }

         // Highlight item yang sesuai
         menuItems.forEach(item => {
            if (item.parentElement.getAttribute('data-title') === activeTitle) {
                item.classList.add('sidebar-active');
            } else {
                item.classList.remove('sidebar-active');
            }
        });

        // Event saat diklik
        menuItems.forEach(item => {
            item.addEventListener('click', function () {
                const title = item.parentElement.getAttribute('data-title');
                localStorage.setItem('activeSidebarItem', title);
            });
        });
    });
</script>

<!-- Search Java -->
<script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const keyword = this.value.toLowerCase();
            const items = document.querySelectorAll('#sidebar ul li[data-title]');

            items.forEach(item => {
                const title = item.getAttribute('data-title').toLowerCase();
                if (title.includes(keyword)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        });
</script>

    <!-- Konetn utama -->
    <div class="flex-1 md:ml-64 p-6 pt-28">
        <!-- Toggle Button (Mobile) -->
        <div class="md:hidden mb-4">
            <button onclick="toggleSidebar()" class="bg-gray-800 text-white px-4 py-2 rounded">☰ Menu</button>
        </div>
        @yield('content')
    </div>

</body>
</html>