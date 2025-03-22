<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen flex items-center justify-center bg-gradient-to-r from-blue-500 to-indigo-600">

    <div class="w-full max-w-3xl flex bg-white rounded-lg shadow-2xl overflow-hidden">
        
        <!-- Sisi Kiri -->
        <div class="w-1/2 bg-red-500 flex items-center justify-center text-white text-3xl font-bold p-6">
            Welcome Back! 👋
        </div>

        <!-- Form Login -->
        <div class="w-1/2 p-8">
            <h2 class="text-2xl font-bold text-center text-gray-700">Masuk & Akses</h2>
            <p class="text-gray-500 text-center mb-6">Akses sistem lebih cepat dan efisien!</p>

            <!-- Notifikasi Error -->
            @if(session('error'))
                <div class="bg-red-500 text-white p-3 rounded mb-4 text-center">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Input Email -->
                <div>
                    <label class="block text-gray-700">Email</label>
                    <div class="flex items-center border border-gray-300 rounded-lg px-3 py-2 mt-1 bg-gray-100">
                        <span class="mr-2 text-gray-500">📧</span>
                        <input type="email" name="email" class="w-full outline-none bg-transparent" required placeholder="Masukkan email">
                    </div>
                </div>

                <!-- Input Password -->
                <div>
                    <label class="block text-gray-700">Password</label>
                    <div class="flex items-center border border-gray-300 rounded-lg px-3 py-2 mt-1 bg-gray-100">
                        <span class="mr-2 text-gray-500">🔒</span>
                        <input type="password" name="password" class="w-full outline-none bg-transparent" required placeholder="Masukkan password">
                    </div>
                </div>

                <!-- Notifikasi Error -->
                @if ($errors->any())
                <div class="bg-red-500 text-white p-3 rounded mb-4 text-center">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Tombol Login -->
                <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition-all">
                    Masuk
                </button>

                <!-- Lupa Password -->
                <p class="text-center text-gray-500 mt-2">
                    <a href="/forgot-password" class="text-blue-600 hover:underline">Lupa kata sandi?</a>
                </p>

                <!-- Login dengan Google -->
                <button class="w-full bg-gray-900 text-white py-2 rounded-lg flex items-center justify-center mt-2 hover:bg-gray-800 transition-all">
                    <img src="https://www.svgrepo.com/show/303108/google-icon-logo.svg" class="w-5 h-5 mr-2" alt="Google Logo">
                    Login dengan Google
                </button>
            </form>
        </div>

    </div>

</body>
</html>