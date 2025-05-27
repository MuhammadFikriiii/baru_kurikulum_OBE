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
                'kode_mk'=>'C0320104',
                'nama_mk'=>'Algoritma Pemrograman',
                'jenis_mk'=>'Pemrograman',
                'sks_mk'=>'3',
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
                'kode_mk'=>'C0320207',
                'nama_mk'=>'Struktur Data',
                'jenis_mk'=>'Pemrograman',
                'sks_mk'=>'3',
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
                'kode_mk'=>'C0320208',
                'nama_mk'=>'Arsitektur Komputer',
                'jenis_mk'=>'Dasar TI',
                'sks_mk'=>'2',
                'semester_mk'=>'2',
                'kompetensi_mk'=>'utama',
            ],
            [
                'kode_mk'=>'C0320103',
                'nama_mk'=>'Sistem Operasi',
                'jenis_mk'=>'Dasar TI',
                'sks_mk'=>'3',
                'semester_mk'=>'2',
                'kompetensi_mk'=>'utama',
            ],
            [
                'kode_mk'=>'C0320406',
                'nama_mk'=>'Kecerdasan Buatan',
                'jenis_mk'=>'Pemrograman',
                'sks_mk'=>'3',
                'semester_mk'=>'4',
                'kompetensi_mk'=>'utama',
            ],
            [
                'kode_mk'=>'C0320308',
                'nama_mk'=>'Rekayasa Perangkat Lunak',
                'jenis_mk'=>'Dasar TI',
                'sks_mk'=>'3',
                'semester_mk'=>'4',
                'kompetensi_mk'=>'utama',
            ],
            [
                'kode_mk'=>'C0320407',
                'nama_mk'=>'Teknologi Informasi Pada Bidang Energi dan Insdustri Pengolahan',
                'jenis_mk'=>'Dasar TI',
                'sks_mk'=>'3',
                'semester_mk'=>'4',
                'kompetensi_mk'=>'pendukung',
            ],
            [
                'kode_mk'=>'C0320203',
                'nama_mk'=>'Pemrograman Web',
                'jenis_mk'=>'Pemrograman',
                'sks_mk'=>'3',
                'semester_mk'=>'4',
                'kompetensi_mk'=>'utama',
            ],
            [
                'kode_mk'=>'C0320302',
                'nama_mk'=>'Pemrograman Mobile',
                'jenis_mk'=>'Pemrograman',
                'sks_mk'=>'3',
                'semester_mk'=>'4',
                'kompetensi_mk'=>'utama',
            ],
            [
                'kode_mk'=>'C0320304',
                'nama_mk'=>'Pemrograman dengan Internet of Things',
                'jenis_mk'=>'Pemrograman',
                'sks_mk'=>'3',
                'semester_mk'=>'4',
                'kompetensi_mk'=>'utama',
            ],
            [
                'kode_mk'=>'C0320205',
                'nama_mk'=>'Pemrograman Berorientasi Objek',
                'jenis_mk'=>'Pemrograman',
                'sks_mk'=>'3',
                'semester_mk'=>'4',
                'kompetensi_mk'=>'utama',
            ],
            [
                'kode_mk'=>'C0320601',
                'nama_mk'=>'Komputasi Paralel dan Terdistribusi',
                'jenis_mk'=>'Pemrograman',
                'sks_mk'=>'3',
                'semester_mk'=>'4',
                'kompetensi_mk'=>'utama',
            ],
            [
                'kode_mk'=>'C0320106',
                'nama_mk'=>'Organisasi Komputer',
                'jenis_mk'=>'Pemrograman',
                'sks_mk'=>'3',
                'semester_mk'=>'4',
                'kompetensi_mk'=>'utama',
            ],
       ]);
    }
}
