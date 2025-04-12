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
          <form action="{{ route('signup.store') }}" method="POST">
            @csrf
            <div class="mt-5">
              <input type="text" name="name" placeholder="Nama Lengkap" class="border border-gray-400 py-1 px-2 w-full"
                value="{{ old('name') }}" required>
            </div>
            
            <div class="mt-5">
              <input type="text" name="email" placeholder="Email" class="border border-gray-400 py-1 px-2 w-full"
                value="{{ old('email') }}" required>
            </div>

            <div class="mt-5">
              <input type="text" name="password" placeholder="Masukkan Password" class="border border-gray-400 py-1 px-2 w-full"
                value="{{ old('password') }}" required>
            </div>

            <div class="mt-5">
              <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required class="border border-gray-400 py-1 px-2 w-full">
            </div>

            <div class="mt-5">
              <label for="kode_prodi" class="form-label">Program Studi</label>
              <select name="kode_prodi" class="form-select" required class="border border-gray-400">
                  <option value="">-- Pilih Prodi --</option>
                  @foreach($prodis as $prodi)
                      <option value="{{ $prodi->kode_prodi }}" {{ old('kode_prodi') == $prodi->kode_prodi ? 'selected' : '' }}>
                          {{ $prodi->nama_prodi }}
                      </option>
                  @endforeach
              </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Peran</label>
            <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                <option value="">-- Pilih Peran --</option>
                <option value="kaprodi" {{ old('role') == 'kaprodi' ? 'selected' : '' }}>Kaprodi</option>
                <option value="tim" {{ old('role') == 'tim' ? 'selected' : '' }}>Tim</option>
            </select>
        </div>
          
            <div class="mt-5">
              <input type="checkbox" class="border border-gray-400">
              <span>
                Saya menerima Ketentuan <a href="#" class="text-orange-300 font-semibold">Penggunaan</a> & 
                <a href="#" class="text-orange-300 font-semibold">Kebijakan Privasi</a>
              </span>
            </div>
            <div class="mt-5">
              <button type="submit" class="">Daftar</button>
              <a href="{{ route('login') }}" class="">Sudah punya akun?</a>
            </div>
          </form>
        </div>

      <!-- Bagian Gambar -->
      <div class="w-1/2 bg-cover bg-center" style="background-image: url('/image/poliban.jpeg');"> </div>
     </div>

    </div>    
</body>

</html>