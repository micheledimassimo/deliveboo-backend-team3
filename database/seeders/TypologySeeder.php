<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Helpers
use Illuminate\Support\Facades\Schema;

// Models
use App\Models\Typology;
use App\Models\Restaurant;
use PhpParser\Node\Stmt\For_;

class TypologySeeder extends Seeder


{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function () {
            Typology::truncate();
        });

        $alltypologys = [
            'Italiano',
            'Cinese',
            'Hamburgeria',
            'Pizzeria',
            'Sushi',
            'Paninoteca',
            'Kebab',
            'Messicano',
            'Ramen',
            'Pasticceria',
            'Gelateria',
            'Pub',
            'Carne',
            'Pesce',
            'Pasta',
            'Fast Food',  
            'Vegano',        
            'Mediterraneo',   
            'Vegetariano'      
        ];

        foreach ($alltypologys as $singletypology) {
            Typology::create([
                'typology_name' => $singletypology,
            ]);
        }

        $restaurants = Restaurant::all();

        $restaurantTypologies = [
            'McDonald\'s' => ['Hamburgeria', 'Carne', 'Fast Food'],
            'Burger King' => ['Hamburgeria', 'Carne', 'Fast Food'],
            'KFC' => ['Carne', 'Fast Food'],
            'Subway' => ['Paninoteca', 'Fast Food'],
            'Pizza Hut' => ['Pizzeria', 'Fast Food'],
            'Domino\'s Pizza' => ['Pizzeria', 'Fast Food'],
            'Starbucks' => ['Pub', 'Fast Food'],
            'Taco Bell' => ['Messicano', 'Fast Food'],
            'Wendy\'s' => ['Hamburgeria', 'Carne', 'Fast Food'],
            'Dunkin\' Donuts' => ['Pasticceria', 'Fast Food'],
            'Chipotle' => ['Messicano', 'Vegano', 'Fast Food'],
            'Panera Bread' => ['Paninoteca', 'Vegetariano'],
            'Five Guys' => ['Hamburgeria', 'Fast Food'],
            'Papa John\'s' => ['Pizzeria', 'Fast Food'],
            'Chick-fil-A' => ['Carne', 'Fast Food'],
            'Panda Express' => ['Cinese', 'Fast Food'],
            'Olive Garden' => ['Italiano', 'Vegetariano', 'Mediterraneo'],
            'Red Lobster' => ['Pesce', 'Fast Food'],
            'The Cheesecake Factory' => ['Mediterraneo', 'Vegetariano', 'Fast Food'],
            '140 Grammi' => ['Pasta'],
            'Old Wild West' => ['Hamburgeria', 'Carne'],
            'Yama Sushi Restaurant' => ['Sushi', 'Pasta', 'Ramen']
        ];

        foreach ($restaurants as $restaurant) {
            if (isset($restaurantTypologies[$restaurant->restaurant_name])) {
                $typologies = $restaurantTypologies[$restaurant->restaurant_name];

                $typologyIds = Typology::whereIn('typology_name', $typologies)->pluck('id')->toArray();

                $restaurant->typologies()->sync($typologyIds);
            }
        }
    }
}
