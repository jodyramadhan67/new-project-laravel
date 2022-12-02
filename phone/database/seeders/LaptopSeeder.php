<?php

namespace Database\Seeders;

use App\Models\Laptop;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class LaptopSeeder extends Seeder
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
            $laptop = new Laptop;

            $laptop->brand = $faker->brand;
            $laptop->type = $faker->type;
            $laptop->imei = $faker->imei;
            $laptop->spec = $faker->spec;
        
            $laptop->save();
        }
    }
}
