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
                    'nama_kajur' => 'Dr. Ir. Budi Santoso, M.T.',
                    'nama_jurusan'=> 'Jurusan Teknik Elektro',
                ],
                [
                    'nama_kajur' => 'Dr. Ir. Siti Aminah, M.T.',
                    'nama_jurusan'=> 'Jurusan Teknik Sipil',
                ],
                [
                    'nama_kajur' => 'Dr. Ir. Joko Prasetyo, M.T.',
                    'nama_jurusan'=> 'Jurusan Teknik Informatika',
                ],
        ]);
    }
}
