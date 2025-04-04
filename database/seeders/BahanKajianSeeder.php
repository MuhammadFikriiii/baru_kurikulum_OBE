<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BahanKajian;

class BahanKajianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BahanKajian::insert([
            [
                'kode_bk'=>'BK01',
                'nama_bk'=> 'Artificial Intelligence(AI)',
                'deskripsi_bk'=> '-',
                'referensi_bk'=> 'CSC2023',
                'status_bk'=> 'core',
                'knowledge_area'=> '-',
                'max_bk'=> '60',
                'min_bk'=>'40'
            ],
            [
                'kode_bk'=>'BK02',
                'nama_bk'=> 'Algorithmic Foundations (AL)',
                'deskripsi_bk'=> '-',
                'referensi_bk'=> 'CSC2023',
                'status_bk'=> 'elective',
                'knowledge_area'=> '-',
                'max_bk'=> '60',
                'min_bk'=>'40'
            ],
            [
                'kode_bk'=>'BK03',
                'nama_bk'=> 'Architecture and Organization (AR)',
                'deskripsi_bk'=> '-',
                'referensi_bk'=> 'CSC2023',
                'status_bk'=> 'elective',
                'knowledge_area'=> '-',
                'max_bk'=> '60',
                'min_bk'=>'40'
            ],
        ]);
    }
}
