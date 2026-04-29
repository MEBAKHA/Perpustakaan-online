<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => "Admin Ganteng",
                'slug' => "admin-ganteng",
                'username' => "admin",
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin123'),
                'role' => 'admin'
            ],
            [
                'name' => "Muhammad Ammar Ayyasy",
                'slug' => "muhammad-ammar-ayyasy",
                'username' => "ammarayyasy",
                'email' => 'ammarmojur@gmail.com',
                'password' => bcrypt('ammar123'),
                'role' => 'user'
            ],
            [

                'name' => 'Test User',
                'slug' => 'test-user',
                'username' => 'test',
                'email' => 'test@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 'user'
            ]
        ]);


    }
}
