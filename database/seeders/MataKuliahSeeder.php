<?php

namespace Database\Seeders;

use App\Models\MataKuliah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MataKuliah::insert([
            [
                'kode_mk'=>'C0320101',
                'nama_mk'=>'Aljabar Linier',
                'jenis_mk'=>'Matematika',
                'sks_mk'=>'2',
                'semester_mk'=>'1',
                'kompetensi_mk'=>'utama',
            ],
            [
                'kode_mk'=>'C0320201',
                'nama_mk'=>'Kalkulus',
                'jenis_mk'=>'Matematika',
                'sks_mk'=>'2',
                'semester_mk'=>'2',
                'kompetensi_mk'=>'utama',
            ],
            [
                'kode_mk'=>'C0320202',
                'nama_mk'=>'Matematika Diskrit',
                'jenis_mk'=>'Matematika',
                'sks_mk'=>'2',
                'semester_mk'=>'2',
                'kompetensi_mk'=>'utama',
            ],
            [
                'kode_mk'=>'C0320303',
                'nama_mk'=>'Metode Numerik',
                'jenis_mk'=>'Matematika',
                'sks_mk'=>'2',
                'semester_mk'=>'3',
                'kompetensi_mk'=>'utama',
            ],
            [
                'kode_mk'=>'C0320102',
                'nama_mk'=>'Logika Matematika',
                'jenis_mk'=>'Matematika',
                'sks_mk'=>'2',
                'semester_mk'=>'1',
                'kompetensi_mk'=>'utama',
            ],
            [
                'kode_mk'=>'C0320301',
                'nama_mk'=>'Probabilitas dan Statistik',
                'jenis_mk'=>'Matematika',
                'sks_mk'=>'2',
                'semester_mk'=>'3',
                'kompetensi_mk'=>'utama',
            ],
            [
                'kode_mk'=>'C03203208',
                'nama_mk'=>'Arsitektur Komputer',
                'jenis_mk'=>'Dasar TI',
                'sks_mk'=>'2',
                'semester_mk'=>'2',
                'kompetensi_mk'=>'utama',
            ],
            [
                'kode_mk'=>'C0320208',
                'nama_mk'=>'Organisasi Komputer',
                'jenis_mk'=>'Dasar TI',
                'sks_mk'=>'2',
                'semester_mk'=>'2',
                'kompetensi_mk'=>'utama',
            ],
            [
                'kode_mk'=>'C0320103',
                'nama_mk'=>'Sistem Informasi',
                'jenis_mk'=>'Dasar TI',
                'sks_mk'=>'3',
                'semester_mk'=>'2',
                'kompetensi_mk'=>'utama',
            ],
       ]);
    }
}
