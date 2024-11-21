<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Helpers
use Illuminate\Support\Facades\Schema;

// Models
use App\Models\Typology;

class TypologySeeder extends Seeder


{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* Schema::withoutForeignKeyConstraints(function () {
            Typology::truncate();
        }); */

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
        }
    }
}
