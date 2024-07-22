<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FollowersTableSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 20; $i++) {
            $following_id = rand(1, 10);
            $follower_id = rand(1, 10);

            // Evitar que un usuario se siga a sí mismo
            if ($following_id != $follower_id) {
                DB::table('followers')->insert([
                    'following_id' => $following_id,
                    'follower_id' => $follower_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
