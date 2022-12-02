<?php

namespace Database\Seeders;

use App\Models\Watch;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i=0; $i < 20; $i++) {
        	$watch = new Watch;

            $watch->series = $faker->randomNumber(9);
        	$watch->type = $faker->type;
        	$watch->year = rand(2010,2021);
        	$watch->phone_id = rand(1,20);
        	$watch->tablet_id = rand(1,20);
        	$watch->laptop_id = rand(1,4);
        	$watch->qty = rand(10,20);
        	$watch->price = rand(1000000,2000000);

        	$watch->save();
        }
    }
}
