<?php

namespace Database\Seeders;

use App\Models\Tablet;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class TabletSeeder extends Seeder
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
            $Tablet = new Tablet;

            $Tablet->brand = $faker->brand;
            $Tablet->type = $faker->type;
            $Tablet->imei = $faker->imei;
            $Tablet->spec = $faker->spec;
        
            $Tablet->save();
        }
    }
}
