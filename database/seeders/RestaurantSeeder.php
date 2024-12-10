<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Support\Facades\File;

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

        $restaurantData = json_decode(File::get(database_path('seeders/restaurants.json')), true);

        $users = User::all();

        if ($users->count() < count($restaurantData)) {
            $this->command->error("There are not enough users to assign one restaurant to each user.");
            return;
        }

        foreach ($users as $index => $user) {
            if (!isset($restaurantData[$index])) {
                break;
            }

            $restaurant = $restaurantData[$index]; 
            $slug = Restaurant::getUniqueSlug($restaurant['name']); 

            Restaurant::create([
                'restaurant_name' => $restaurant['name'], 
                'address' => fake()->address(),
                'phone_number' => fake()->e164PhoneNumber() ,
                'img' => $restaurant['image_url'], 
                'slug' => $slug,
                'user_id' => $user->id,
            ]);
        }
    }
}
