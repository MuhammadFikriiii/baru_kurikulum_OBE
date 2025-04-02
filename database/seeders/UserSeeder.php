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
                'role' => 'admin',
            ],
            [
                'name'=> 'Muhammad Fikri',
                'email'=> 'tpublicml@gmail.com',
                'password'=> bcrypt('123456'),
                'role' => 'admin',
            ],
            [
                'name'=>'Habibie Nugraha',
                'email'=>'nugraha21@gmail.com',
                'password'=> bcrypt('123456'),
                'role'=> 'admin',

            ]
        ]);
    }
}
