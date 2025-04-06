<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SignUp</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  
 
    <div class="min-h-screen py-50 flex items-center justify-center" style="background-image: linear-gradient(115deg, rgb(238, 203, 157), #ebeae6)">
      <div class="w-8/12 bg-white rounded-xl shadow-lg overflow-hidden flex flex-row-reverse">
      
        <!-- Bagian Form -->
        <div class="w-1/2 py-16 px-12">
          <h2 class="text-3xl mb-4">Sign-Up</h2>
          <p class="mb-4">Create your account.</p>
          <form action="#">
            <div class="grid grid-cols-2 gap-5">
              <input type="text" placeholder="First Name" class="border border-gray-400 py-1 px-2">
              <input type="text" placeholder="Last Name" class="border border-gray-400 py-1 px-2">
            </div>
            
            <div class="mt-5">
              <input type="text" placeholder="Email" class="border border-gray-400 py-1 px-2 w-full">
            </div>
            <div class="mt-5">
              <input type="password" placeholder="Password" class="border border-gray-400 py-1 px-2 w-full">
            </div>
            <div class="mt-5">
              <input type="password" placeholder="Confirm Password" class="border border-gray-400 py-1 px-2 w-full">
            </div>
          
            <div class="mt-5">
              <input type="checkbox" class="border border-gray-400">
              <span>
                Saya menerima Ketentuan <a href="#" class="text-orange-300 font-semibold">Penggunaan</a> & 
                <a href="#" class="text-orange-300 font-semibold">Kebijakan Privasi</a>
              </span>
            </div>
            <div class="mt-5">
              <button class="w-full bg-orange-400 text-white py-2">Sign-Up</button>
            </div>
          </form>
        </div>

      <!-- Bagian Gambar -->
      <div class="w-1/2 bg-cover bg-center" style="background-image: url('/image/poliban.jpeg');"> </div>
     </div>

    </div>    
      
  

</body>

</html>