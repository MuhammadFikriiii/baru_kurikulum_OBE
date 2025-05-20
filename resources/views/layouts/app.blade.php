<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kurikulum OBE')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
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

            <div class="relative p-4">
                <button onclick="toggleDropdownProfil()" class="flex items-center space-x-2 focus:outline-none">
                    <i class="bi bi-person-circle  text-white text-2xl"></i>
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
                    <a href="/" class="flex items-center px-4 py-2 hover:bg-gray-100 text-red-600">
                        <i class="fas fa-sign-out-alt mr-2"></i> Log Out
                    </a>
                </div>
            </div>

        </div>
    </nav>
   

    <!-- Sidebar -->
    <aside id="sidebar" class="w-64 bg-[#201F31] text-white p-5  space-y-6 fixed top-0 left-0 h-full overflow-y-auto transform -translate-x-full md:translate-x-0 transition-transform duration-300 z-40">
        <!-- Header -->
        <div class="flex items-center justify-between mb-4 pt-2 mt-16">
            <h2 class="text-xl font-bold">Dashboard Admin</h2>
            <button class="md:hidden" onclick="toggleSidebar()">✖</button>
        </div>

        <!-- Search bar -->
        <div>
            <input id="searchInput"  type="text" placeholder="Search..." class="w-full p-2 rounded bg-[#2c2b43] placeholder-gray-400 text-white focus:outline-none">
        </div>

        <!-- Navigation -->
        <ul class="space-y-1">
            <li data-title="Dashboard"> 
                <a href="{{ route('admin.dashboard') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                    <i class="bi bi-house-door"></i>
                    <span class="ml-2">Dashboard</span>
                </a>
            </li>
            <li data-title="Users">
                <a href="{{ route('admin.users.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                    <i class="bi bi-person"></i>
                    <span class="ml-2">Users</span>
                </a>
            </li>
            <li data-title="Register User">
                <a href="{{ route('admin.pendingusers.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                    <i class="bi bi-person-plus"></i>
                    <span class="ml-2">Register User</span>
                </a>
            </li>
            <li data-title="Jurusan"> 
                <a href="{{ route('admin.jurusan.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                    <i class="bi bi-building"></i>
                    <span class="ml-2">Jurusan</span>
                </a>
            </li>
            <li data-title="Prodi">
                <a href="{{ route('admin.prodi.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                    <i class="bi bi-mortarboard"></i>
                    <span class="ml-2">Prodi</span>
                </a>
            </li>
            <li data-title="Profil Lulusan">
                <a href="{{ route('admin.profillulusan.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                    <i class="bi bi-file-earmark-person"></i>
                    <span class="ml-2">Profil Lulusan</span>
                </a>
            </li>
            <li data-title="Capaian Profil Lulusan">
                <a href="{{ route('admin.capaianprofillulusan.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                    <i class="bi bi-check2-square"></i>
                    <span class="ml-2">Capaian Profil Lulusan</span>
                </a>
            </li>
            <li data-title="Pemetaan CPL-PL">
                <a href="{{ route('admin.pemetaancplpl.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                    <i class="bi bi-diagram-3"></i>
                    <span class="ml-2">Pemetaan CPL-PL</span>
                </a>
            </li>
            <li data-title="Bahan Kajian">
                <a href="{{ route('admin.bahankajian.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                    <i class="bi bi-journal-bookmark"></i>
                    <span class="ml-2">Bahan Kajian</span>
                </a>
            </li>
            <li data-title="Pemetaan CPL - BK">
                <a href="{{ route('admin.pemetaancplbk.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                    <i class="bi bi-pin-map"></i>
                    <span class="ml-2">Pemetaan CPL - BK</span>
                </a>
            </li>
            <li data-title="Mata Kuliah">
                <a href="{{ route('admin.matakuliah.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                    <i class="bi bi-book"></i>
                    <span class="ml-2">Mata Kuliah</span>
                </a>
            </li>
            <li data-title="Pemetaan CPL - MK">
                <a href="{{ route('admin.pemetaancplmk.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                    <i class="bi bi-bar-chart"></i>
                    <span class="ml-2">Pemetaan CPL - MK</span>
                </a>
            </li>
            <li data-title="Pemetaan BK - MK">
                <a href="{{ route('admin.pemetaanbkmk.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                    <i class="bi bi-folder2-open"></i>
                    <span class="ml-2">Pemetaan BK - MK</span>
                </a>
            </li>
            <li data-title="Pemetaan CPL - BK - MK">
                <a href="{{ route('admin.pemetaancplmkbk.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                    <i class="bi bi-folder2-open"></i>
                    <span class="ml-2">Pemetaan CPL - BK - MK</span>
                </a>
            </li>
            <li data-title="Organisasi MK">
                <a href="{{ route('admin.matakuliah.organisasimk') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                    <i class="bi bi-folder2-open"></i>
                    <span class="ml-2">Organisasi MK</span>
                </a>
            </li>
            <li data-title="CPMK">
                <a href="{{ route('admin.capaianpembelajaranmatakuliah.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                    <i class="bi bi-folder2-open"></i>
                    <span class="ml-2">CPMK</span>
                </a>
            </li>
            <li data-title="PEMETAAN CPL-CPMK-MK">
                <a href="{{ route('admin.pemetaancplcpmkmk.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                    <i class="bi bi-folder2-open"></i>
                    <span class="ml-2">PEMETAAN CPL-CPMK-MK</span>
                </a>
            </li>
            <li data-title="PEMENUHAN CP">
                <a href="{{ route('admin.pemenuhancpl.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                    <i class="bi bi-folder2-open"></i>
                    <span class="ml-2">PEMENUHAN CPL</span>
                </a>
            </li>
            <li data-title="Sub Cpmk">
                <a href="{{ route('admin.subcpmk.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                    <i class="bi bi-folder2-open"></i>
                    <span class="ml-2">Sub Cpmk</span>
                </a>
            </li>
            <li data-title="Pemenuhan CPL - CPMK - MK">
                <a href="{{ route('admin.pemetaancplcpmkmk.pemenuhancplcpmkmk') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                    <i class="bi bi-folder2-open"></i>
                    <span class="ml-2">Pemenuhan CPL - CPMK - MK</span>
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
    <script>
        document.getElementById('searchInput').addEventListener('keyup', function () {
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
