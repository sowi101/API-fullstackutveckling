<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        // Saves which categories and brands that exist in tables categories and brands
        $categories = Category::all()->pluck('id')->toArray();
        $brands = Brand::all()->pluck('id')->toArray();

        // For loop in which creates thirty products with all attributes that are inserted into database
        for ($i = 0; $i < 30; $i++) {
            Product::create([
                'article' => $faker->randomNumber(4),
                'name' => $faker->words(3, true),
                'description' => $faker->realText(300),
                'price' => $faker->randomNumber(2),
                'amount' => $faker->randomNumber(2),
                'category_id' => $faker->randomElement($categories),
                'brand_id' => $faker->randomElement($brands)
            ]);
        }
    }
}
