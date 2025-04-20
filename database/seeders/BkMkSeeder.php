<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BkMkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['id_bk' => '1', 'kode_mk' => 'C0320101'],
            ['id_bk' => '2', 'kode_mk' => 'C0320201'],
            ['id_bk' => '3', 'kode_mk' => 'C0320201'],
            ['id_bk' => '4', 'kode_mk' => 'C0320202'],
            ['id_bk' => '5', 'kode_mk' => 'C0320303'],
            ['id_bk' => '6', 'kode_mk' => 'C0320101'],
            ['id_bk' => '7', 'kode_mk' => 'C0320102'],
            ['id_bk' => '8', 'kode_mk' => 'C0320102'],
            ['id_bk' => '6', 'kode_mk' => 'C0320101'],
            ['id_bk' => '7', 'kode_mk' => 'C0320303'],
            ['id_bk' => '8', 'kode_mk' => 'C0320202'],
            ['id_bk' => '9', 'kode_mk' => 'C0320201'],
            //prodilain
            ['id_bk' => '10', 'kode_mk' => 'C0320301'],
            ['id_bk' => '11', 'kode_mk' => 'C0320301'],
            ['id_bk' => '12', 'kode_mk' => 'C03203208'],
            ['id_bk' => '13', 'kode_mk' => 'C03203208'],
            ['id_bk' => '16', 'kode_mk' => 'C0320301'],
            ['id_bk' => '17', 'kode_mk' => 'C0320103'],
            ['id_bk' => '18', 'kode_mk' => 'C0320208'],
            ['id_bk' => '19', 'kode_mk' => 'C0320301'],
            ['id_bk' => '20', 'kode_mk' => 'C03203208'],
        ];
        DB::table('bk_mk')->insert($data);
    }
}
