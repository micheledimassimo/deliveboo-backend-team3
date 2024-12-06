<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\MenuItem;
use App\Models\Restaurant;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $restaurants = Restaurant::all();

        foreach ($restaurants as $restaurant) {
            foreach (range(1, rand(5, 10)) as $index) {
                $order = Order::create([
                    'customer_email' => fake()->email(),
                    'customer_address' => fake()->address(),
                    'customer_number' => fake()->phoneNumber(),
                    'customer_name' => fake()->name(),
                    'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
                    'total_price' => 0, 
                ]);

                $menuItems = $restaurant->menuItems()->inRandomOrder()->take(rand(1, 5))->get();

                $totalPrice = 0;
                $menuItemsWithQuantities = [];

                foreach ($menuItems as $menuItem) {
                    $quantity = fake()->numberBetween(1, 5);
                    $menuItemsWithQuantities[$menuItem->id] = ['quantity' => $quantity];
                    $totalPrice += $menuItem->price * $quantity;
                }

                $order->menuItems()->attach($menuItemsWithQuantities);

                $order->update(['total_price' => $totalPrice]);
            }
        }
    }
}