<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel Logo">
</p>

<h1 align="center">📚 Sistem Kurikulum OBE - Poliban</h1>

<p align="center">
  Aplikasi manajemen kurikulum berbasis OBE (Outcome-Based Education) yang digunakan oleh tim admin, tim prodi, dan wadir 1 di Poliban.
</p>

---

## 🚀 Fitur Utama

- 🔐 Autentikasi dan otorisasi berdasarkan role (Admin, Tim, Kaprodi dan Wadir 1)
- 📅 Manajemen Tahun Akademik
- 🏫 Jurusan dan Program Studi
- 🎯 Profil Lulusan (PL) dan Capaian Pembelajaran Lulusan (CPL)
- 🧠 Bidang Kajian (BK) dan Mata Kuliah (MK)
- 📘 Capaian Pembelajaran Mata Kuliah (CPMK) & Sub-CPMK
- ⚖️ Pengelolaan Bobot CPL–MK
- 📝 Manajemen Catatan Wadir dan Kaprodi
- 🧭 Pemetaan CPL-PL, Pemetaan BK-MK, Pemetaan CPL-MK dan pemetaan lainnya
- 📊 Grafik visualisasi pemenuhan CPL per tahun
- 📥 Ekspor data ke Excel

---

## 🛠️ Instalasi

```bash
git clone https://github.com/username/baru_kurikulum_OBE.git
cd baru_kurikulum_OBE
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
