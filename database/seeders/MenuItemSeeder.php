<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Helpers
use Illuminate\Support\Facades\Schema;

//Models

use App\Models\MenuItem;
use App\Models\Restaurant;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function() {
            MenuItem::truncate();
        });

        for ($i = 0; $i < 20; $i ++){

            $name = fake()->word(2);
            $slug = str()->slug($name);

            /* Prendo una categoria casuale dal db */
            $randomRestaurantId = null;
            $randomRestaurant = Restaurant::inRandomOrder()->first();
            $randomRestaurantId = $randomRestaurant->id;


            MenuItem::create([

            'item_name'=> $name,
            'slug'=> $slug,
            'description' => fake()->paragraph(),
            'price'=> fake()->randomFloat(2, 1, 99),
            'is_visible'=> fake()->boolean(70),
            'image'=> fake()->word(3),
            'restaurant_id' => $randomRestaurantId

            ]);

        }
    }
}
