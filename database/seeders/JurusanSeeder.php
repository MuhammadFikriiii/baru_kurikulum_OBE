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
                    'nama_jurusan'=> 'Jurusan Teknik Elektro',
                ],
                [
                    'nama_jurusan'=> 'Jurusan Teknik Sipil',
                ],
                [
                    'nama_jurusan'=> 'Jurusan Teknik Informatika',
                ],
        ]);
    }
}
