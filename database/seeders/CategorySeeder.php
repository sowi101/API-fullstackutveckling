<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        // For loop in which creates ten category names that are inserted into database
        for ($i = 0; $i < 10; $i++) {
            Category::create([
                'name' => $faker->sentence(1)
            ]);
        }
    }
}
