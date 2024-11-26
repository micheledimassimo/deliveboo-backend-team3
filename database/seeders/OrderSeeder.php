<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Order;
use App\Models\MenuItem;


class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(1, 10) as $index) {
            $order = Order::create([
                'customer_email' => fake()->email(),
                'customer_address' => fake()->address(),
                'customer_number' => fake()->phoneNumber(),
                'customer_name' => fake()->name(),
                'total_price' => fake()->randomFloat(2, 10, 100),
            ]);

            $menuItems = MenuItem::inRandomOrder()->take(3)->pluck('id');
            
            $menuItemsWithQuantities = [];
            foreach ($menuItems as $menuItemId) {
                $menuItemsWithQuantities[$menuItemId] = ['quantity' => fake()->numberBetween(1, 5)];
            }

            $order->menuItems()->attach($menuItemsWithQuantities);
        }
    }
}
