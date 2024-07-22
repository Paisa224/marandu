<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Usuario específico
        DB::table('users')->insert([
            'name' => 'Segel',
            'username' => 'Segel',
            'email' => 'segel@example.com',
            'password' => Hash::make('segel123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Otros usuarios
        for ($i = 1; $i <= 9; $i++) {
            DB::table('users')->insert([
                'name' => "User $i",
                'username' => "user$i",
                'email' => "user$i@example.com",
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
