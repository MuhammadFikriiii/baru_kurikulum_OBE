<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen flex items-center justify-center bg-blue-500">
    
    <div class="w-full max-w-4xl flex bg-white rounded-lg shadow-2xl overflow-hidden">

        <div class="w-1/2 p-8 flex flex-col justify-center">
            <h2 class="text-3xl font-bold text-center text-gray-700 mb-4">LOGIN</h2>
            <hr class=" bg-blue-500 mx-auto border-none h-1 w-full mb-2">
            <p class="text-center text-blue-600 font-semibold mb-6">Sistem Informasi Penyusun Kurikulum Berbasi OBE</p>
            
            @if(session('error'))
                <div class="bg-red-500 text-white p-3 rounded mb-4 text-center">
                    {{ session('error') }}
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
                    <a href="/signup" class="text-blue-600 hover:underline">sign up?</a>
                </p>
            </form>
        </div>

        <div class="w-1/2 bg-white flex items-center justify-center p-14">
            <img src="/image/polibannew.png" alt="Poliban" class="w-full h-auto">
        </div>
        
    </div>
    
</body>
</html>