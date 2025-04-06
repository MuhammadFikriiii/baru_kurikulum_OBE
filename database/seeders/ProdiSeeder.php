<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Prodi;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Prodi::insert([
            [
                'kode_jurusan'=>'J0101',
                'kode_prodi'=>'C0303',
                'nama_prodi'=>'Teknik Informatika'
            ],
            [
                'kode_jurusan'=>'J0102',
                'kode_prodi'=>'F0105',
                'nama_prodi'=>'Teknik Listrik'
            ],
        ]);
    }

}
