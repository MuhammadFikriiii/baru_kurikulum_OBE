<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CplPlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['id_cpl' => '1', 'id_pl' => 1],
            ['id_cpl' => '1', 'id_pl' => 2],
            ['id_cpl' => '2', 'id_pl' => 1],
            ['id_cpl' => '3', 'id_pl' => 2],
            ['id_cpl' => '4', 'id_pl' => 3],
            ['id_cpl' => '5', 'id_pl' => 2],
            ['id_cpl' => '5', 'id_pl' => 4],
            ['id_cpl' => '6', 'id_pl' => 1],
            ['id_cpl' => '6', 'id_pl' => 2],
            ['id_cpl' => '7', 'id_pl' => 3],
            ['id_cpl' => '8', 'id_pl' => 4],
            ['id_cpl' => '9', 'id_pl' => 4],
            //prodilain
            ['id_cpl' => '10', 'id_pl' => 5],
            ['id_cpl' => '11', 'id_pl' => 6],
            ['id_cpl' => '12', 'id_pl' => 5],
            ['id_cpl' => '13', 'id_pl' => 6],
            ['id_cpl' => '14', 'id_pl' => 7],
            ['id_cpl' => '15', 'id_pl' => 6],
            ['id_cpl' => '15', 'id_pl' => 8],
            ['id_cpl' => '16', 'id_pl' => 5],
            ['id_cpl' => '16', 'id_pl' => 6],
            ['id_cpl' => '17', 'id_pl' => 7],
            ['id_cpl' => '18', 'id_pl' => 8],
            ['id_cpl' => '18', 'id_pl' => 8],
        ];
        DB::table('cpl_pl')->insert($data);
    }
}
