<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UserSeeder::class);
        //$this->call(FixtureTableSeeder::class);
        // $this->call(GeneralTableSeeder::class);
       // $this->call(BannerTableSeeder::class);
        //$this->call(TeamResultSeeder::class);
        //$this->call(LeaderboardSeeder::class);
    }
}
