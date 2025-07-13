<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'nip' => null,
                'nohp' => null,
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'role' => 'admin',
                'kode_prodi' => null,
                'status' => 'approved',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // [
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
            // [
            //     'name'=> 'Tim TL',
            //     'email'=> 'timtl@gmail.com',
            //     'password'=> bcrypt('123456'),
            //     'kode_prodi' => 'F0105',
            //     'role' => 'tim',
            // ],
        ]);
    }
}
