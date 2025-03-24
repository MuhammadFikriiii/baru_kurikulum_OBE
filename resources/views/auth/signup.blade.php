<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SignUp</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  
  <div class="min-h-screen py-40" style="background-image: linear-gradient(115deg, #e7c9ae, #ebeae6)">
    <div class="container mx-auto">
      <div class="w-8/12 bg-white rounded-xl mx-auto shadow-lg overflow-hidden">
        <div class="w-1/2" style="background-image: url('image/Poliban.jpeg');">
          <h1 class="text-white">Selamat Datang</h1>
          <div>
            <p class="text-white">Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
          </div>
        </div>
        <div class="w-1/2 py-16 px-12">
            <h2 class="text-3x1 mb-4">Sign-Up</h2>
            <p class="mb-4">
              Create your account.
            </p>
            <form action="#">
              <div class="grid grid-cols-2 gap-5">
                <input type="text" placeholder="First Name" class="border border-gray-400 py-1 px-2">
                <input type="text" placeholder="Last Name" class="border border-gray-400 py-1 px-2">
              </div>
              <div class="mt-5">
                <input type="text" placeholder="Email" class="border border-gray-400 py-1 px-2 w-full">
                <input type="password" placeholder="Password" class="border border-gray-400 py-1 px-2 w-full">
                <input type="password" placeholder="Confrim Password" class="border border-gray-400 py-1 px-2 w-full">
              </div>
              <div class="mt-5">
                <input type="checkbox" class="border border-gray-400">
                <span>
                  Saya menerima Ketentuan <a href="#" class="text-orange-300 font-semibold">Penggunaan</a> & <a href="#"  class="text-orange-300 font-semibold">Kebijakan Privasi</a>
                </span>
              </div>
              <div class="mt-5">
                  <button class="w-full bg-orange-400 text-white" >Sign-Up</button>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>

</body>

</html>