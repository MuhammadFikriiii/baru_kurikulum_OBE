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

        document.addEventListener("click", function(e) {
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

        document.addEventListener("click", function(event) {
            const button = event.target.closest("button");
            const dropdown = document.getElementById("userDropdown");
            if (!button && !event.target.closest("#userDropdown")) {
                dropdown.classList.add("hidden");
            }
        });
    </script>

</head>

<body class="">
    <nav class="bg-gray-900 text-white px-6 py-4 flex items-center justify-between fixed top-0 left-0 w-full z-50 shadow-md">
        <!-- Logo & Toggle -->
        <div class="flex items-center space-x-4">
            <span class="font-bold text-xl uppercase">Poliban OBE</span>
        </div>
        
        <!-- User Dropdown -->
        <div class="flex items-center space-x-4">
            <span class="hidden md:inline-block font-medium">{{ auth()->user()->name }}</span>
            <div class="relative">
                <button onclick="toggleDropdownProfil()" class="flex items-center focus:outline-none">
                    <i class="bi bi-person-circle text-white text-2xl"></i>
                    <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414L10 13.414 5.293 8.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
                <div id="userDropdown" class="absolute right-0 mt-2 bg-white text-black rounded-md shadow-lg py-2 hidden w-48 z-50">
                    <!-- Dropdown items -->
                </div>
            </div>
        </div>
    </nav>
  <!-- Sidebar -->
    <aside id="sidebar" class="w-64 bg-[#201F31] text-white p-5 pb-24 space-y-6 fixed top-16 left-0 h-[calc(100vh-4rem)] overflow-y-auto transform -translate-x-full md:translate-x-0 transition-transform duration-300">
        <!-- Header -->
        <div class="flex items-center justify-between mb-4 pt-2">
            <h2 class="text-xl font-bold">Dashboard Admin</h2>
            <button class="md:hidden" onclick="toggleSidebar()">✖</button>
        </div>

        <!-- Search bar -->
        <div class="mb-4">
            <input id="searchInput" type="text" placeholder="Search..."
                class="w-full p-2 rounded bg-[#2c2b43] placeholder-gray-400 text-white focus:outline-none">
        </div>

        <!-- Navigation -->
        <ul class="space-y-2">
            <!-- Dashboard -->
            <li data-title="Dashboard">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                    <i class="bi bi-house-door mr-3"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <li class="border-t border-gray-700 my-2"></li>

            <!-- User Management -->
            <li>
                <p class="text-gray-400 uppercase text-xs font-semibold px-3 py-2">User Management</p>
                <ul class="ml-2 space-y-1">
                    <li data-title="Users">
                        <a href="{{ route('admin.users.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                            <i class="bi bi-people mr-3"></i>
                            <span>Users</span>
                        </a>
                    </li>
                    <li data-title="Register User">
                        <a href="{{ route('admin.pendingusers.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                            <i class="bi bi-person-plus mr-3"></i>
                            <span>Register User</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Divider -->
            <li class="border-t border-gray-700 my-2"></li>

            <!-- Program Management -->
            <li>
                <p class="text-gray-400 uppercase text-xs font-semibold px-3 py-2">Program Management</p>
                <ul class="ml-2 space-y-1">
                    <li data-title="Jurusan">
                        <a href="{{ route('admin.jurusan.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                            <i class="bi bi-building mr-3"></i>
                            <span>Jurusan</span>
                        </a>
                    </li>
                    <li data-title="Prodi">
                        <a href="{{ route('admin.prodi.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                            <i class="bi bi-mortarboard mr-3"></i>
                            <span>Prodi</span>
                        </a>
                    </li>
                    <li data-title="Tahun">
                        <a href="{{ route('admin.tahun.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                            <i class="bi bi-calendar mr-3"></i>
                            <span>Tahun</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Divider -->
            <li class="border-t border-gray-700 my-2"></li>

            <!-- Learning Outcomes -->
            <li>
                <p class="text-gray-400 uppercase text-xs font-semibold px-3 py-2">Learning Outcomes</p>
                <ul class="ml-2 space-y-1">
                    <li data-title="Profil Lulusan">
                        <a href="{{ route('admin.profillulusan.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                            <i class="bi bi-file-earmark-person mr-3"></i>
                            <span>Profil Lulusan</span>
                        </a>
                    </li>
                    <li data-title="Capaian Profil Lulusan">
                        <a href="{{ route('admin.capaianprofillulusan.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                            <i class="bi bi-check2-square mr-3"></i>
                            <span>Capaian Profil Lulusan</span>
                        </a>
                    </li>
                    <li data-title="Pemetaan CPL-PL">
                        <a href="{{ route('admin.pemetaancplpl.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                            <i class="bi bi-diagram-3 mr-3"></i>
                            <span>Pemetaan CPL-PL</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Divider -->
            <li class="border-t border-gray-700 my-2"></li>

            <!-- Curriculum -->
            <li>
                <p class="text-gray-400 uppercase text-xs font-semibold px-3 py-2">Curriculum</p>
                <ul class="ml-2 space-y-1">
                    <li data-title="Bahan Kajian">
                        <a href="{{ route('admin.bahankajian.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                            <i class="bi bi-journal-bookmark mr-3"></i>
                            <span>Bahan Kajian</span>
                        </a>
                    </li>
                    <li data-title="Pemetaan CPL - BK">
                        <a href="{{ route('admin.pemetaancplbk.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                            <i class="bi bi-pin-map mr-3"></i>
                            <span>Pemetaan CPL - BK</span>
                        </a>
                    </li>
                    <li data-title="Mata Kuliah">
                        <a href="{{ route('admin.matakuliah.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                            <i class="bi bi-book mr-3"></i>
                            <span>Mata Kuliah</span>
                        </a>
                    </li>
                    <li data-title="Pemetaan CPL - MK">
                        <a href="{{ route('admin.pemetaancplmk.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                            <i class="bi bi-bar-chart mr-3"></i>
                            <span>Pemetaan CPL - MK</span>
                        </a>
                    </li>
                    <li data-title="Pemetaan BK - MK">
                        <a href="{{ route('admin.pemetaanbkmk.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                            <i class="bi bi-link-45deg mr-3"></i>
                            <span>Pemetaan BK - MK</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Divider -->
            <li class="border-t border-gray-700 my-2"></li>

            <!-- Advanced Mapping -->
            <li>
                <p class="text-gray-400 uppercase text-xs font-semibold px-3 py-2">Advanced Mapping</p>
                <ul class="ml-2 space-y-1">
                    <li data-title="Pemetaan CPL - BK - MK">
                        <a href="{{ route('admin.pemetaancplmkbk.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                            <i class="bi bi-diagram-3 mr-3"></i>
                            <span>Pemetaan CPL - BK - MK</span>
                        </a>
                    </li>
                    <li data-title="Organisasi MK">
                        <a href="{{ route('admin.matakuliah.organisasimk') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                            <i class="bi bi-columns mr-3"></i>
                            <span>Organisasi MK</span>
                        </a>
                    </li>
                    <li data-title="CPMK">
                        <a href="{{ route('admin.capaianpembelajaranmatakuliah.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                            <i class="bi bi-list-check mr-3"></i>
                            <span>CPMK</span>
                        </a>
                    </li>
                    <li data-title="Sub Cpmk">
                        <a href="{{ route('admin.subcpmk.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                            <i class="bi bi-list-ol mr-3"></i>
                            <span>Sub CPMK</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Divider -->
            <li class="border-t border-gray-700 my-2"></li>

            <!-- Reports -->
            <li>
                <p class="text-gray-400 uppercase text-xs font-semibold px-3 py-2">Reports</p>
                <ul class="ml-2 space-y-1">
                    <li data-title="PEMETAAN CPL-CPMK-MK">
                        <a href="{{ route('admin.pemetaancplcpmkmk.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                            <i class="bi bi-node-plus mr-3"></i>
                            <span>Pemetaan CPL-CPMK-MK</span>
                        </a>
                    </li>
                    <li data-title="PEMENUHAN CP">
                        <a href="{{ route('admin.pemenuhancpl.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                            <i class="bi bi-percent mr-3"></i>
                            <span>Pemenuhan CPL</span>
                        </a>
                    </li>
                    <li data-title="Pemenuhan CPL - CPMK - MK">
                        <a href="{{ route('admin.pemetaancplcpmkmk.pemenuhancplcpmkmk') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                            <i class="bi bi-pie-chart mr-3"></i>
                            <span>Pemenuhan CPL-CPMK-MK</span>
                        </a>
                    </li>
                    <li data-title="Pemenuhan MK - CPMK - CPL">
                        <a href="{{ route('admin.pemetaancplcpmkmk.pemetaanmkcpmkcpl') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                            <i class="bi bi-graph-up mr-3"></i>
                            <span>Pemenuhan MK-CPMK-CPL</span>
                        </a>
                    </li>
                    <li data-title="Pemenuhan MK - CPMK - SubCPMK">
                        <a href="{{ route('admin.pemetaanmkcpmksubcpmk.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                            <i class="bi bi-diagram-2 mr-3"></i>
                            <span>Pemenuhan MK-CPMK-SubCPMK</span>
                        </a>
                    </li>
                    <li data-title="Bobot">
                        <a href="{{ route('admin.bobot.index') }}" class="flex items-center p-3 hover:bg-gray-700 rounded">
                            <i class="bi bi-speedometer2 mr-3"></i>
                            <span>Bobot</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Divider -->
            <li class="border-t border-gray-700 my-2"></li>

            <!-- Logout -->
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center p-3 hover:bg-gray-700 rounded">
                        <i class="fas fa-sign-out-alt mr-3"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </li>
        </ul>
    </aside>

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
    <div class="flex-1 md:ml-64 p-6 pt-24">
        <!-- Toggle Button (Mobile) -->
        <div class="md:hidden mb-4">
            <button onclick="toggleSidebar()" class="bg-gray-800 text-white px-4 py-2 rounded">☰ Menu</button>
        </div>
        @yield('content')
    </div>
    @stack('scripts')
</body>
</html>
