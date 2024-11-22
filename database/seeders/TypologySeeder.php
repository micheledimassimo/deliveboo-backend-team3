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
            'Pub'
        ];

        foreach ($alltypologys as $singletypology) {
            $typology = Typology::create([
                'typology_name' => $singletypology,
            ]);

            $restaurantsIds = [];
            for( $i = 0; $i < rand(0, Restaurant::count()); $i++ ) {
                $randomRestaurant = Restaurant::inRandomOrder()->first();

                if(!in_array($randomRestaurant->id, $restaurantsIds)) {
                    $restaurantsIds[] = $randomRestaurant->id;
                }
            }

            $typology->restaurants()->sync( $restaurantsIds );
        }

        


    }
}
