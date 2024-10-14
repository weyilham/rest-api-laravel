<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 10; $i++) {
            \App\Models\Product::create([
                'name' => $faker->name,
                'price' => $faker->numberBetween(100, 1000),
                'description' => $faker->sentence(6,true),
            ]);
        }
    }
}
