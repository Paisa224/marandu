<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FollowersTableSeeder extends Seeder
{
    public function run()
    {
        $followers = [
            ['following_id' => 1, 'follower_id' => 2],
            ['following_id' => 2, 'follower_id' => 3],
            ['following_id' => 3, 'follower_id' => 4],
            ['following_id' => 4, 'follower_id' => 5],
            ['following_id' => 5, 'follower_id' => 6],
           
        ];

        foreach ($followers as $follower) {
            DB::table('followers')->updateOrInsert(
                ['following_id' => $follower['following_id'], 'follower_id' => $follower['follower_id']],
                ['created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
            );
        }
    }
}
