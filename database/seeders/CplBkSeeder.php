<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CplBkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cpl_bk')->insert([
            ['id_bk' => 1, 'id_cpl' => '1'],
            ['id_bk' => 2, 'id_cpl' => '1'],
            ['id_bk' => 3, 'id_cpl' => '2'],
            ['id_bk' => 4, 'id_cpl' => '3'],
            ['id_bk' => 5, 'id_cpl' => '4'],
            ['id_bk' => 6, 'id_cpl' => '5'],
            ['id_bk' => 7, 'id_cpl' => '5'],
            ['id_bk' => 8, 'id_cpl' => '6'],
            ['id_bk' => 9, 'id_cpl' => '6'],
            ['id_bk' => 5, 'id_cpl' => '7'],
            ['id_bk' => 4, 'id_cpl' => '8'],
            ['id_bk' => 10, 'id_cpl' => '9'],
            // prodilain
            ['id_bk' => 11, 'id_cpl' => '10'],
            ['id_bk' => 12, 'id_cpl' => '11'],
            ['id_bk' => 13, 'id_cpl' => '12'],
            ['id_bk' => 14, 'id_cpl' => '13'],
            ['id_bk' => 15, 'id_cpl' => '14'],
            ['id_bk' => 16, 'id_cpl' => '15'],
            ['id_bk' => 17, 'id_cpl' => '15'],
            ['id_bk' => 18, 'id_cpl' => '16'],
            ['id_bk' => 19, 'id_cpl' => '16'],
            ['id_bk' => 20, 'id_cpl' => '17'],
            ['id_bk' => 20, 'id_cpl' => '18'],
        ]);
    }
}
