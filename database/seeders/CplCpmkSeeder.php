<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CplCpmkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cpl_cpmk')->insert([
            ['id_cpl' => 1, 'id_cpmk' => 1],
            ['id_cpl' => 1, 'id_cpmk' => 2],
            ['id_cpl' => 2, 'id_cpmk' => 3],
            ['id_cpl' => 2, 'id_cpmk' => 4],
            ['id_cpl' => 3, 'id_cpmk' => 5],
            ['id_cpl' => 3, 'id_cpmk' => 6],
            ['id_cpl' => 4, 'id_cpmk' => 7],
            ['id_cpl' => 4, 'id_cpmk' => 8],
            ['id_cpl' => 5, 'id_cpmk' => 9],
            ['id_cpl' => 5, 'id_cpmk' => 10],
            ['id_cpl' => 5, 'id_cpmk' => 11],
            ['id_cpl' => 6, 'id_cpmk' => 12],
            ['id_cpl' => 6, 'id_cpmk' => 13],
            ['id_cpl' => 6, 'id_cpmk' => 14],
            ['id_cpl' => 7, 'id_cpmk' => 15],
            ['id_cpl' => 7, 'id_cpmk' => 16],
            ['id_cpl' => 7, 'id_cpmk' => 17],
            ['id_cpl' => 8, 'id_cpmk' => 18],
            ['id_cpl' => 8, 'id_cpmk' => 19],
            ['id_cpl' => 9, 'id_cpmk' => 20],
            ['id_cpl' => 9, 'id_cpmk' => 21],
        ]);
    }
}
