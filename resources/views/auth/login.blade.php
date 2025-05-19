<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br  from-blue-300 to-gray-100">

    <div class="min-h-screen flex items-center justify-center py-6 px-4">
      <div class="w-full max-w-4xl bg-white rounded-xl shadow-lg overflow-hidden flex flex-col md:flex-row">
        
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
            <hr class="bg-[#3094c6] mx-auto border-none h-1 w-1/3 mb-4">
            <p class="text-center text-[#3094c6] font-semibold ">Sistem Informasi Penyusun Kurikulum Berbasis OBE</p>
            
            @if($errors->any())
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    showToast("{{ $errors->first() }}", 'error');
                });
            </script>
            @endif
            
            <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-gray-700">Email</label>
                    <input type="email" name="email" class="w-full border border-gray-300 rounded-lg px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-[#3094c6]" required placeholder="Masukkan Gmail">
                </div>
                <div>
                    <label class="block text-gray-700">Password</label>
                    <input type="password" name="password" class="w-full border border-gray-300 rounded-lg px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-[#3094c6]" required placeholder="Masukkan Password">
                </div>
                <button href="/login" type="submit" class="w-full bg-[#3094c6] text-white py-2 rounded-lg hover:bg-[rgb(29,99,134)] transition-all">
                    Login
                </button>
                <p class="text-center mt-2">
                    <a href="/forgot-password" class="text-[#3094c6] hover:underline ">Forgot Password?</a>
                </p>
                <p class="text-center mt-2">
                    <a href="/signup" class="text-[#3094c6] hover:underline">Sign up?</a>
                </p>
            </form>
        </div>
    </div>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Function untuk show toast notification
        function showToast(message, type = 'success') {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
            
            Toast.fire({
                icon: type,
                title: message
            });
        }

        // Check for session messages
        document.addEventListener('DOMContentLoaded', function() {
        @if($errors->any())
            Swal.fire({
                icon: 'error',
                title: '{{ $errors->first() }}',
                showConfirmButton: false,
                timer: 2000,
                toast: true,
                position: 'top'
            });
        @endif
        
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 2000,
                toast: true,
                position: 'top'
            });
        @endif
    });
    </script>
</body>
</html>
