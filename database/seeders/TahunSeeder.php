<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TahunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tahun')->insert([
            [
                'nama_kurikulum' => 'Kurikulum 2025',
                'tahun' => '2025',
            ],
        ]);
    }
}