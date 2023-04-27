<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use Faker\Generator as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $users= collect(User::all()->modelKeys());
        $data = [];

        for ($i = 0; $i < 1000; $i++) {
            $data[] = [
                'team_id' => $faker->numberBetween($min = 1, $max = 50),
                'group' => 'Z',
                'name' =>   $faker->name(),
                'email' => $faker->email(),
                'email_verified_at' => now(),
                'password' => $faker->password(),
                'photo' => $faker->imageUrl(),
                'gender' => $faker->randomElement(['male', 'female']),
                'dob' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'age' => '' ,
                'phone_number' =>  $faker->phoneNumber(),
                'social_document_id' => '',
                'status' => $faker->randomElement(['active', 'inactive']),
                'role_as' => 0,

                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ];
        }

        $chunks = array_chunk($data, 500);

        foreach ($chunks as $chunk) {
            User::insert($chunk);
        }
    }
}
