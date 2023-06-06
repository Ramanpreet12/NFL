<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AboutPage;
use Carbon\Carbon;

class AboutPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aboutRecords = [
            ['id' => 1 ,'image' => '' , 'content' => 'lorem' , 'created_at' => Carbon::now() , 'updated_at' => Carbon::now() ],

        ];
        AboutPage::insert($aboutRecords);
    }
}
