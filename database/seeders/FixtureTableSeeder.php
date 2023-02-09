<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fixture;
use Carbon\Carbon;

class FixtureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fixtureRecords = [
            ['id' => 1 , 'season_id' => 1 , 'first_team' => 'eagles' , 'second_team' => 'cowboys' , 'week' => '3' ,
                'date' => Carbon::create('2023' , '02' , '10') , 'time' =>  Carbon::now()->toTimeString() , 'time_zone' => 'am'  ,'created_at' => Carbon::now() ,  'updated_at' => Carbon::now()
            ] ,
            ['id' => 2 , 'season_id' => 1 , 'first_team' => 'banglas' , 'second_team' => 'ravens' , 'week' => '3' ,
            'date' => Carbon::create('2023' , '02' , '12') , 'time' => Carbon::now()->toTimeString(), 'time_zone' => 'pm' ,'created_at' => Carbon::now() ,  'updated_at' => Carbon::now()
            ] ,
            ['id' => 3 , 'season_id' => 1 , 'first_team' => 'panthers' , 'second_team' => 'texans' , 'week' => '3' ,
            'date' =>Carbon::create('2023' , '02' , '13'), 'time' => Carbon::now()->toTimeString(), 'time_zone' => 'am','created_at' => Carbon::now() ,  'updated_at' => Carbon::now()
             ],
        ];
        Fixture::insert($fixtureRecords);
    }
}
