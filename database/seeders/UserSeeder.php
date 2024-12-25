<?php

namespace Database\Seeders;

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
        DB::table('tbl_users')->insert([
            [
                'username' => 'adminsistem',
                'password' => Hash::make('admin123'), 
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // [
            //     'email' => 'amil@.com',
            //     'password' => Hash::make('password'), 
            //     'role' => 'amil',
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ]
        ]);
    }
}