<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kurikulum OBE')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex bg-white">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white h-screen p-5 space-y-6 fixed">
        <h2 class="text-xl font-bold">Dashboard Admin</h2>
        <ul>
            <li>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2 p-3 hover:bg-gray-700 rounded">
                    <span>🏠</span>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.users.index') }}" class="flex items-center space-x-2 p-3 hover:bg-gray-700 rounded">
                    <span>👥</span>
                    <span>Users</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.jurusan.index') }}" class="flex items-center space-x-2 p-3 hover:bg-gray-700 rounded">
                    <span>👥</span>
                    <span>Jurusan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.prodi.index') }}" class="flex items-center space-x-2 p-3 hover:bg-gray-700 rounded">
                    <span>👥</span>
                    <span>Prodi</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.profillulusan.index') }}" class="flex items-center space-x-2 p-3 hover:bg-gray-700 rounded">
                    <span>👥</span>
                    <span>Profil Lulusan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.capaianprofillulusan.index') }}" class="flex items-center space-x-2 p-3 hover:bg-gray-700 rounded">
                    <span>👥</span>
                    <span>Capaian Profil Lulusan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.pemetaancplpl.index') }}" class="flex items-center space-x-2 p-3 hover:bg-gray-700 rounded">
                    <span>👥</span>
                    <span>Pemetaan CPL-PL</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.bahankajian.index') }}" class="flex items-center space-x-2 p-3 hover:bg-gray-700 rounded">
                    <span>👥</span>
                    <span>Bahan Kajian</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.pemetaancplbk.index') }}" class="flex items-center space-x-2 p-3 hover:bg-gray-700 rounded">
                    <span>👥</span>
                    <span>Pemetaan CPL - BK</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.matakuliah.index') }}" class="flex items-center space-x-2 p-3 hover:bg-gray-700 rounded">
                    <span>👥</span>
                    <span>Mata Kuliah</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.pemetaancplmk.index') }}" class="flex items-center space-x-2 p-3 hover:bg-gray-700 rounded">
                    <span>👥</span>
                    <span>Pemetaan CPL - MK</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.pemetaanbkmk.index') }}" class="flex items-center space-x-2 p-3 hover:bg-gray-700 rounded">
                    <span>👥</span>
                    <span>Pemetaan BK - MK</span>
                </a>
            </li>
        </ul>
    </aside>

    <!-- Konten Utama -->
    <div class="flex-1 ml-64 p-6">
        @yield('content')
    </div>

</body>
</html>
