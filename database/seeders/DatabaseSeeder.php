<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\TweetsTableSeeder;
use Database\Seeders\TweetLikesTableSeeder;
use Database\Seeders\FollowersTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            TweetsTableSeeder::class,
            TweetLikesTableSeeder::class,
            FollowersTableSeeder::class,
        ]);
    }
}
