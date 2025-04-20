<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CplMkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['id_cpl' => '1', 'kode_mk' => 'C0320101'],
            ['id_cpl' => '1', 'kode_mk' => 'C0320201'],
            ['id_cpl' => '2', 'kode_mk' => 'C0320201'],
            ['id_cpl' => '3', 'kode_mk' => 'C0320202'],
            ['id_cpl' => '4', 'kode_mk' => 'C0320303'],
            ['id_cpl' => '5', 'kode_mk' => 'C0320101'],
            ['id_cpl' => '5', 'kode_mk' => 'C0320102'],
            ['id_cpl' => '6', 'kode_mk' => 'C0320102'],
            ['id_cpl' => '6', 'kode_mk' => 'C0320101'],
            ['id_cpl' => '7', 'kode_mk' => 'C0320303'],
            ['id_cpl' => '8', 'kode_mk' => 'C0320202'],
            ['id_cpl' => '9', 'kode_mk' => 'C0320201'],
            //prodilain
            ['id_cpl' => '10', 'kode_mk' => 'C0320301'],
            ['id_cpl' => '11', 'kode_mk' => 'C0320301'],
            ['id_cpl' => '12', 'kode_mk' => 'C03203208'],
            ['id_cpl' => '13', 'kode_mk' => 'C03203208'],
            ['id_cpl' => '16', 'kode_mk' => 'C0320301'],
            ['id_cpl' => '17', 'kode_mk' => 'C0320103'],
            ['id_cpl' => '18', 'kode_mk' => 'C0320208'],
        ];
        DB::table('cpl_mk')->insert($data);
    }
}
