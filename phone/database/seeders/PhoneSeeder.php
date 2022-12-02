<?php

namespace Database\Seeders;

use App\Models\Phone;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class PhoneSeeder extends Seeder
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
            $phone = new Phone;

            $phone->brand = $faker->brand;
            $phone->type = $faker->type;
            $phone->imei = $faker->imei;
            $phone->spec = $faker->spec;
        
            $phone->save();
        }
    }
}
