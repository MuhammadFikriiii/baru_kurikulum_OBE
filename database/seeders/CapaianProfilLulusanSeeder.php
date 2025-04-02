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
            
        ]);
    }
}
