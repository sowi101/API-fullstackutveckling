<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        // For loop in which ten brand names are inserted into database
        for ($i = 0; $i < 10; $i++) {
            Brand::create([
                'name' => $faker->sentence(1)
            ]);
        }
    }
}
