<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-blue-300 to-gray-100 min-h-screen">

    <div class="fixed top-4 left-4 z-50">
        <a href="{{ url('/') }}" class="flex items-center text-white rounded-full px-3 py-2 shadow-md transition-all duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5  text-white " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
    </div>

    <div class="min-h-screen flex items-center justify-center py-6 px-4 sm:px-6 lg:px-8">
      <div class="w-full max-w-4xl bg-white rounded-xl shadow-lg overflow-hidden flex flex-col md:flex-row">
        
        <!-- Gambar -->
        <div class="md:w-1/2 w-full h-64 md:h-auto bg-cover bg-center relative" style="background-image: url('/image/Poliban.jpeg');">
        
            <div class="absolute inset-0 bg-black bg-opacity-30"></div>
         
            <div class="absolute bottom-4 left-4 right-4 text-white text-left">
                <h4 class="text-xs sm:text-sm md:text-base mb-1">Selamat Datang</h4>
                <hr class="border-t-2 border-white w-1/5 sm:w-1/5 mb-1">
                <h2 class="text-lg sm:text-xl md:text-2xl font-semibold mb-1 leading-tight">Sistem Kurikulum Berbasis OBE</h2>
                <h3 class="text-sm sm:text-base md:text-lg font-bold leading-tight">Politeknik Negeri Banjarmasin</h3>
            </div>
        </div>
        
    
        <div class="w-full md:w-1/2 p-6 sm:p-8 flex flex-col justify-center h-full">
            <h2 class="text-2xl sm:text-3xl font-bold text-center text-gray-700 mb-4">LOGIN</h2>
            <hr class="bg-[#3094c6] mx-auto border-none h-1 w-1/3 mb-4">
            <p class="text-center text-[#3094c6] font-semibold text-sm sm:text-base">Sistem Informasi Penyusun Kurikulum Berbasis OBE</p>
            
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
                    <label class="block text-[#87acd6]">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none mt-1">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input type="email" name="email" class="w-full border border-gray-300 rounded-lg px-3 py-2 mt-1 pl-10 focus:outline-none focus:ring-2 focus:ring-[#3094c6]" required placeholder="Masukkan Gmail">
                    </div>
                </div>
                <div>
                    <label class="block text-[#87acd6]">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none mt-1">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input type="password" name="password" class="w-full border border-gray-300 rounded-lg px-3 py-2 mt-1 pl-10 focus:outline-none focus:ring-2 focus:ring-[#3094c6]" required placeholder="Masukkan Password">
                    </div>
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