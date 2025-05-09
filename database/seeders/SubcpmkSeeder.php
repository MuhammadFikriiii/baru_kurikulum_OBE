<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SubCpmk;

class SubcpmkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubCPmk::insert([
            [
                'id_cpmk' => 1,
                'sub_cpmk' => 'SUBCPMK01',
                'uraian_cpmk' => 'Belum Diisi'
            ],
            [
                'id_cpmk' => 1,
                'sub_cpmk' => 'SUBCPMK02',
                'uraian_cpmk' => 'Belum Diisi'
            ]
        ]);
    }
}
