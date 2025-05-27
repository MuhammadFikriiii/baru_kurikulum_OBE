<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CapaianProfilLulusan;

class CapaianProfilLulusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CapaianProfilLulusan::insert([
            [
                'kode_cpl'=>'CPL-01',
                'deskripsi_cpl'=>'Mampu memahami cara kerja sistem berbasis komputer dan menerapkan berbagai algoritma/metode dalam pengembangan perangkat lunak (software engineering) untuk memecahkan masalah pada bidang energi dan industri pengolahan.',
                'status_cpl'=>'Kompetensi Utama Bidang'
            ],
            [
                'kode_cpl'=>'CPL-02',
                'deskripsi_cpl'=>'Mampu memahami konsep teoritis dalam penyelesaian  persoalan computing sebagai solusi pengelolaan proyek teknologi(ket : memecah yg kompleks menjadi simple dan berfungsi)  bidang informatika/ilmu komputer dengan memperhatikan ilmu pengetahuan dan perkembangan teknologi.',
                'status_cpl'=>'Kompetensi Utama Bidang'
            ],
            [
                'kode_cpl'=>'CPL-03',
                'deskripsi_cpl'=>'Mampu memahami konsep teoritis bidang pengetahuan Ilmu Komputer/Informatika dalam merancang dan mengimplementasikan aplikasi teknologi multi-platform yang relevan dengan kebutuhan pada bidang energi dan industri pengolahan dan masyarakat.',
                'status_cpl'=>'Kompetensi Utama Bidang'
            ],
            [
                'kode_cpl'=>'CPL-04',
                'deskripsi_cpl'=>'Mampu merancang dan mengimplementasikan kebutuhan computing dengan menggunakan berbagai metode/algoritma yang sesuai dalam permasalahan pada bidang energi dan industri pengolahan.',
                'status_cpl'=>'Kompetensi Utama Bidang'
            ],
            [
                'kode_cpl'=>'CPL-05',
                'deskripsi_cpl'=>'Mampu merancang, membangun dan mengimplementasikan user interface dan aplikasi interaktif dengan memperhatikan ilmu pengetahuan dan perkembangan teknologi digital.',
                'status_cpl'=>'Kompetensi Utama Bidang'
            ],
            [
                'kode_cpl'=>'CPL-06',
                'deskripsi_cpl'=>'Mampu merancang, membangun dan mengimplementasikan solusi berbasis computing multi-platform yang memenuhi kebutuhan computing pada bidang energi dan industri pengolahan.',
                'status_cpl'=>'Kompetensi Utama Bidang'
            ],
            [
                'kode_cpl'=>'CPL-07',
                'deskripsi_cpl'=>'Mampu melakukan instalasi, konfigurasi, serta perawatan jaringan komputer yang aman dan optimal.',
                'status_cpl'=>'Kompetensi Utama Bidang'
            ],
            [
                'kode_cpl'=>'CPL-08',
                'deskripsi_cpl'=>'Mampu menunjukkan sikap professional dalam aktualisasi bidang informatika baik secara mandiri maupun kelompok yang dilandasi semangat dan jiwa kewirausahaan.',
                'status_cpl'=>'Kompetensi Tambahan'
            ],
            [
                'kode_cpl'=>'CPL-09',
                'deskripsi_cpl'=>'Mampu mengkomunikasikan ide, konsep, dan hasil kerja secara efektif baik secara lisan maupun tulisan kepada pemangku kepentingan.',
                'status_cpl'=>'Kompetensi Tambahan'
            ],
        ]);
    }
}
