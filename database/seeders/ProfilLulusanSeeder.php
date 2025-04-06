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
                'kode_pl'=>'PL01',
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
                'kode_pl'=>'PL02',
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
            [
                'kode_pl'=>'PL03',
                'kode_prodi'=>'C0303',
                'deskripsi_pl'=>'(IABEE) Lulusan memiliki kemampuan untuk mendesain dan mengimplementasikan solusi permasalahan pada sistem jaringan di bidang industri pengolahan. (Keterampilan Khusus)',
                'profesi_pl'=>'- PROGRAMMING AND SOFTWARE DEVELOPMENT (programmer, SUPERVISOR PEMROGRAM DATABASE,dll) 
                                - Network dan Infrastruktur (NETWORK SERVICES ADMINISTRATOR) 
                                - INTEGRATION APPLICATION SYSTEM (APPLICATION MANAGEMENT SUPERVISOR, ENTERPRISE RESOURCE PLANNING (ERP) - DEVELOPER)
                                - IT MOBILITY AND INTERNET OF THIGS(INTERNET DEVELOPER, WEB SITE DESIGNER)
                                - dll',
                'unsur_pl'=>'Keterampilan Khusus',
                'keterangan_pl'=>'Kompetensi Tambahan',
                'sumber_pl'=>'Permen No. 53 Tahun 2023 dan PENGEMBANGAN KURIKULUM KKNI BERDASARKAN OBE - BIDANG ILMU INFORMATIKA DAN KOMPUTER 2019 Hal. 26'
            ],
            [
                'kode_pl'=>'PL04',
                'kode_prodi'=>'C0303',
                'deskripsi_pl'=>'(KKNI) Lulusan mampu bekerjasama, berkomunikasi, dan berinovasi dalam perkerjaannya.',
                'profesi_pl'=>'- PROGRAMMING AND SOFTWARE DEVELOPMENT (programmer, SUPERVISOR PEMROGRAM DATABASE,dll) 
                                - Network dan Infrastruktur (NETWORK SERVICES ADMINISTRATOR) 
                                - INTEGRATION APPLICATION SYSTEM (APPLICATION MANAGEMENT SUPERVISOR, ENTERPRISE RESOURCE PLANNING (ERP) - DEVELOPER)
                                - IT MOBILITY AND INTERNET OF THIGS(INTERNET DEVELOPER, WEB SITE DESIGNER)
                                - dll',
                'unsur_pl'=>'Sikap dan Keterampilan Umum',
                'keterangan_pl'=>'Kompetensi Tambahan',
                'sumber_pl'=>'PENGEMBANGAN KURIKULUM KKNI BERDASARKAN OBE - BIDANG ILMU INFORMATIKA DAN KOMPUTER 2019 Hal. 26'
            ],
        ]);
    }
}
