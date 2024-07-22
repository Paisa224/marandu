<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TweetsTableSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('tweets')->insert([
                'user_id' => rand(1, 10),
                'content' => "Este es el tweet número $i.",
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
