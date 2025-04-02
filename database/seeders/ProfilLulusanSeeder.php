<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProfilLulusan;

class ProfilLulusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProfilLulusan::insert([
            [
                'kode_pl'=>'PL-001',
                'kode_prodi'=>'C0303',
                'deskripsi_pl'=>'(IABEE) Lulusan menguasai konsep dasar persoalan computing serta menerapkan prinsip-prinsip computing dan disiplin ilmu relevan lainnya untuk mengidentifikasi solusi bagi organisasi. (Pengetahuan)',
                'profesi_pl'=>'- PROGRAMMING AND SOFTWARE DEVELOPMENT (programmer, SUPERVISOR PEMROGRAM DATABASE,dll) 
                                - Network dan Infrastruktur (NETWORK SERVICES ADMINISTRATOR) 
                                - INTEGRATION APPLICATION SYSTEM (APPLICATION MANAGEMENT SUPERVISOR, ENTERPRISE RESOURCE PLANNING (ERP) - DEVELOPER)
                                - IT MOBILITY AND INTERNET OF THIGS(INTERNET DEVELOPER, WEB SITE DESIGNER)
                                - dll',
                'unsur_pl'=>'Pengetahuan',
                'keterangan_pl'=>'Kompetensi Utama Bidang',
                'sumber_pl'=>'19 Jan 2023 V 1.1 - PANDUAN KURIKULUM BERBASIS OBE INFORMATIKA Hal.65'
            ],
            [
                'kode_pl'=>'PL-002',
                'kode_prodi'=>'C0303',
                'deskripsi_pl'=>'(IABEE) Lulusan memiliki kemampuan untuk mendesain dan mengimplementasikan solusi menggunakan perangkat lunak yang memenuhi kebutuhan pengguna dengan pendekatan yang sesuai di bidang industri pengolahan. (Keterampilan Khusus)',
                'profesi_pl'=>'- PROGRAMMING AND SOFTWARE DEVELOPMENT (programmer, SUPERVISOR PEMROGRAM DATABASE,dll) 
                                - Network dan Infrastruktur (NETWORK SERVICES ADMINISTRATOR) 
                                - INTEGRATION APPLICATION SYSTEM (APPLICATION MANAGEMENT SUPERVISOR, ENTERPRISE RESOURCE PLANNING (ERP) - DEVELOPER)
                                - IT MOBILITY AND INTERNET OF THIGS(INTERNET DEVELOPER, WEB SITE DESIGNER)
                                - dll',
                'unsur_pl'=>'Keterampilan Khusus',
                'keterangan_pl'=>'Kompetensi Utama Bidang',
                'sumber_pl'=>'19 Jan 2023 V 1.1 - PANDUAN KURIKULUM BERBASIS OBE INFORMATIKA Hal.66'
            ],
        ]);
    }
}
