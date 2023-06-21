<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactPage;
use Carbon\Carbon;


class ContactPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ContactPageRecords = [
            ['id' => 1 , 'section_heading' => 'Contact Us' , 'location_heading' =>  'Head Office' ,'content' => 'lorem' ,  'image' => '' ,'contact_form_heading' => 'Club Enquiries' , 'social_links_heading' => 'Follow Us' ,  'status' => 'Active' , 'created_at' => Carbon::now() , 'updated_at' => Carbon::now() ],

        ];
        ContactPage::insert($ContactPageRecords);
    }
}
