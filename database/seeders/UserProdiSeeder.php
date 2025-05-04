<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserProdi;

class UserProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserProdi::insert([
            
            [
                'name'=> 'timti1',
                'email'=> 'timti1@gmail.com',
                'kode_prodi'=> 'C0303',
                'password'=> bcrypt('123456'),
                'role' => 'tim',
                'status' => 'approved',
            ],
            [
                'name'=> 'kaproditi1',
                'email'=> 'kaproditi1@gmail.com',
                'kode_prodi'=> 'C0303',
                'password'=> bcrypt('123456'),
                'role' => 'kaprodi',
                'status' => 'approved',
            ],
            [
                'name'=> 'timtl1',
                'email'=> 'timtl1@gmail.com',
                'kode_prodi'=> 'F0105',
                'password'=> bcrypt('123456'),
                'role' => 'tim',
                'status' => 'approved',
            ],
            [
                'name'=> 'timsikc1',
                'email'=> 'timsikc1@gmail.com',
                'kode_prodi'=> 'C0505',
                'password'=> bcrypt('123456'),
                'role' => 'tim',
                'status' => 'approved',

            ]
        ]);
    }
}
