<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            JurusanSeeder::class,
            ProdiSeeder::class,
            UserSeeder::class,
            TahunSeeder::class,
            ProfilLulusanSeeder::class,
            CapaianProfilLulusanSeeder::class,
            BahanKajianSeeder::class,
            CplPlSeeder::class,
            CplBkSeeder::class,
            MataKuliahSeeder::class,
            CplMkSeeder::class,
            BkMkSeeder::class,

        ]);
    }
}
