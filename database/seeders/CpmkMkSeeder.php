<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CpmkMkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cpmk_mk')->insert([
            ['id_cpmk' => 1, 'kode_mk' => 'C0320104'],
            ['id_cpmk' => 1, 'kode_mk' => 'C0320207'],
            ['id_cpmk' => 1, 'kode_mk' => 'C0320406'],
        ]);
    }
}
