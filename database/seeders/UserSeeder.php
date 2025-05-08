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
            [
                'name'=> 'Muhammad Fikri',
                'email'=> 'tpublicml@gmail.com',
                'password'=> bcrypt('123456'),
                'kode_prodi' => null,
                'role' => 'admin',
            ],
            [
                'name'=>'Habibie Nugraha',
                'email'=>'nugraha21@gmail.com',
                'password'=> bcrypt('123456'),
                'kode_prodi' => null,
                'role'=> 'admin',
            ],
            [
                'name'=>'wadir1',
                'email'=>'wadir1@gmail.com',
                'password'=> bcrypt('123456'),
                'kode_prodi' => null,
                'role'=> 'wadir1',
            ],
            [
                'name'=>'timti1',
                'email'=>'timti1@gmail.com',
                'password'=> bcrypt('123456'),
                'kode_prodi'=>'C0303',
                'role'=> 'tim',
            ],
        ]);
    }
}
