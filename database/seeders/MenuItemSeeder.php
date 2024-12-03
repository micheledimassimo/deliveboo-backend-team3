<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\MenuItem;
use App\Models\Restaurant;
use Illuminate\Support\Facades\File;

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

        $json = File::get(database_path('seeders/menu_items.json'));
        $menuItems = json_decode($json, true);

        foreach ($menuItems as $restaurantName => $items) {
            $restaurant = Restaurant::where('restaurant_name', $restaurantName)->first();

            if ($restaurant) {
                foreach ($items as $item) {
                    $slug = MenuItem::getUniqueSlug($item['name']);
                    MenuItem::create([
                        'item_name' => $item['name'],
                        'slug' => $slug,
                        'description' => $item['description'],
                        'price' => $item['price'],
                        'image' => $item['image'],
                        'is_visible' => 1,
                        'restaurant_id' => $restaurant->id,
                    ]);
                }
            }
        }
    }
}


