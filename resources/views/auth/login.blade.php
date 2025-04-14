<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen flex items-center justify-center bg-blue-300">
    
    <div class="w-full max-w-4xl flex flex-col md:flex-row bg-white rounded-lg shadow-2xl overflow-hidden">

      <!-- Gambar -->
      <div class="md:w-1/2 w-full h-64 md:h-auto bg-cover bg-center relative" style="background-image: url('/image/poliban.jpeg');">
        <!-- Overlay gelap -->
        <div class="absolute inset-0 bg-black bg-opacity-30"></div>
    
        <!-- Teks di atas gambar -->
        <div class="absolute bottom-4 left-4 right-4 text-white text-left">
            <h4 class="text-xs sm:text-sm md:text-base mb-1">Selamat Datang</h4>
            <hr class="border-t-2 border-white w-1/5 sm:w-1/5 mb-1">
            <h2 class="text-lg sm:text-xl md:text-2xl font-semibold mb-1 leading-tight">Sistem Kurikulum Berbasis OBE</h2>
            <h3 class="text-sm sm:text-base md:text-lg font-bold leading-tight">Politeknik Negeri Banjarmasin</h3>
        </div>
    </div>
    
      
        <!-- Form -->
        <div class="w-full md:w-1/2 p-8 flex flex-col justify-center h-full">

            <h2 class="text-3xl font-bold text-center text-gray-700 mb-4">LOGIN</h2>
            <hr class="bg-blue-500 mx-auto border-none h-1 w-1/3 mb-2">
            <p class="text-center text-blue-600 font-semibold mb-6">Sistem Informasi Penyusun Kurikulum Berbasis OBE</p>
            
            @if(session('sukses'))
            <div id="alert" class="bg-red-500 text-white px-4 py-2 rounded-md mb-4 text-center relative">
                <span class="font-bold">{{ session('sukses') }}</span>
                <button onclick="document.getElementById('alert').style.display='none'" 
                    class="absolute top-1 right-3 text-white font-bold text-lg">
                    &times;
                </button>
            </div>
            @endif
            
            <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-gray-700">Email</label>
                    <input type="email" name="email" class="w-full border border-gray-300 rounded-lg px-3 py-2 mt-1" required placeholder="Masukkan Gmail">
                </div>
                <div>
                    <label class="block text-gray-700">Password</label>
                    <input type="password" name="password" class="w-full border border-gray-300 rounded-lg px-3 py-2 mt-1" required placeholder="Masukkan Password">
                </div>
                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition-all">
                    Login
                </button>
                <p class="text-center mt-2">
                    <a href="/forgot-password" class="text-blue-600 hover:underline">Forgot Password?</a>
                </p>
                <p class="text-center mt-2">
                    <a href="/signup" class="text-blue-600 hover:underline">Sign up?</a>
                </p>
            </form>
        </div>
        
    </div>
    
</body>
</html>
