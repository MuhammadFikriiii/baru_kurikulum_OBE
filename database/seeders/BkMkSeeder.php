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
            ['id_bk' => '7', 'kode_mk' => 'C0320101'],
            ['id_bk' => '7', 'kode_mk' => 'C0320201'],
            ['id_bk' => '7', 'kode_mk' => 'C0320202'],
            ['id_bk' => '7', 'kode_mk' => 'C0320303'],
            ['id_bk' => '7', 'kode_mk' => 'C0320102'],
            ['id_bk' => '7', 'kode_mk' => 'C0320301'],

            ['id_bk' => '3', 'kode_mk' => 'C0320208'],

            ['id_bk' => '3', 'kode_mk' => 'C0320106'],
            ['id_bk' => '14', 'kode_mk' => 'C0320106'],

            ['id_bk' => '9', 'kode_mk' => 'C0320103'],

            ['id_bk' => '11', 'kode_mk' => 'C0320308'],

            ['id_bk' => '13', 'kode_mk' => 'C0320407'],
            ['id_bk' => '17', 'kode_mk' => 'C0320407'],

            ['id_bk' => '2', 'kode_mk' => 'C0320104'],
            ['id_bk' => '10', 'kode_mk' => 'C0320104'],

            ['id_bk' => '2', 'kode_mk' => 'C0320207'],
            ['id_bk' => '10', 'kode_mk' => 'C0320207'],

            ['id_bk' => '10', 'kode_mk' => 'C0320203'],
            ['id_bk' => '15', 'kode_mk' => 'C0320203'],

            ['id_bk' => '10', 'kode_mk' => 'C0320302'],
            ['id_bk' => '15', 'kode_mk' => 'C0320302'],

            ['id_bk' => '15', 'kode_mk' => 'C0320304'],

            ['id_bk' => '5', 'kode_mk' => 'C0320205'],

            ['id_bk' => '16', 'kode_mk' => 'C0320601'],

            ['id_bk' => '1', 'kode_mk' => 'C0320406'],
            ['id_bk' => '2', 'kode_mk' => 'C0320406'],
        ];
        DB::table('bk_mk')->insert($data);
    }
}
