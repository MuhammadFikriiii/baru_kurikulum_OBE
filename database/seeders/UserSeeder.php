<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            
            [
                'name'=> 'Admin',
                'email'=> 'admin@gmail.com',
                'password'=> bcrypt('123456'),
                'kode_prodi' => null,
                'role' => 'admin',
            ],
            //  [
            //     'name'=>'wadir1',
            //     'email'=>'wadir1@gmail.com',
            //     'password'=> bcrypt('123456'),
            //     'kode_prodi' => null,
            //     'role'=> 'wadir1',
            // ],
            // [
            //     'name'=>'Kaprodi TI',
            //     'email'=>'kaproditi@gmail.com',
            //     'password'=> bcrypt('123456'),
            //     'kode_prodi' => 'C0303',
            //     'role'=> 'kaprodi',
            // ],
            // [
            //     'name'=>'Tim TI',
            //     'email'=>'timti@gmail.com',
            //     'password'=> bcrypt('123456'),
            //     'kode_prodi'=>'C0303',
            //     'role'=> 'tim',
            // ],
            // [
            //     'name'=> 'Kaprodi TL',
            //     'email'=> 'kaproditl@gmail.com',
            //     'password'=> bcrypt('123456'),
            //     'kode_prodi' => 'F0105',
            //     'role' => 'kaprodi',
            // ],
            //             [
            //     'name'=> 'Tim TL',
            //     'email'=> 'timtl@gmail.com',
            //     'password'=> bcrypt('123456'),
            //     'kode_prodi' => 'F0105',
            //     'role' => 'tim',
            // ],
        ]);
    }
}
