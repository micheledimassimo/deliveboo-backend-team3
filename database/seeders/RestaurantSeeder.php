<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Helpers

use Illuminate\Support\Facades\Schema;

// Models

use App\Models\Restaurant;
use app\Models\User;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function () {
            Restaurant::truncate();
        });

        // Da riguardare

        for($i = 0; $i < 10; $i++) {
            $name = fake()->company();
            $slug = Restaurant::getUniqueSlug($name);
            $randomUser = User::inRandomOrder()->first();
            $restaurant = Restaurant::create([
                'restaurant_name' => $name,
                'address' => fake()->address(),
                'phone_number' => fake()->phoneNumber(),
                'slug' => $slug,
                'img' => 'https://cdn.vox-cdn.com/thumbor/dwuLlpmXjH9U1AJLSAt41nOzE1s=/1400x1400/filters:format(png)/cdn.vox-cdn.com/uploads/chorus_asset/file/22891216/Screen_Shot_2021_09_30_at_11.57.54_AM.png',
                'user_id' => $randomUser->id,
            ]);
            $usersIds = [];
            for($j = 0; $j < rand(0, User::count()); $j++) {
                $randomUser = User::inRandomOrder()->first();
                if (!in_array($randomUser->id, $usersIds)) {
                    $usersIds[] = $randomUser->id;
                }
        }
    }
}
}
