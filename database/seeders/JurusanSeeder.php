<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Jurusan;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jurusan::insert([
                [
                    'kode_jurusan'=>'J0101',
                    'nama_jurusan'=> 'Jurusan Teknik Elektro',
                ],
                [
                    'kode_jurusan'=> 'J0102',
                    'nama_jurusan'=> 'Jurusan Teknik Sipil',
                ],
        ]);
    }
}
