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
        // Itera attraverso tutti i ristoranti
        $restaurants = Restaurant::all();

        foreach ($restaurants as $restaurant) {
            // Crea un numero casuale di ordini per ogni ristorante
            foreach (range(1, rand(0, 10)) as $index) {
                $order = Order::create([
                    'customer_email' => fake()->email(),
                    'customer_address' => fake()->address(),
                    'customer_number' => fake()->phoneNumber(),
                    'customer_name' => fake()->name(),
                    'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
                    'total_price' => 0, // Calcolato successivamente
                ]);

                // Ottieni menuItems casuali del ristorante corrente
                $menuItems = $restaurant->menuItems()->inRandomOrder()->take(rand(1, 5))->get();

                $totalPrice = 0;
                $menuItemsWithQuantities = [];

                foreach ($menuItems as $menuItem) {
                    $quantity = fake()->numberBetween(1, 5);
                    $menuItemsWithQuantities[$menuItem->id] = ['quantity' => $quantity];
                    $totalPrice += $menuItem->price * $quantity;
                }

                // Associa i menuItems all'ordine tramite tabella pivot
                $order->menuItems()->attach($menuItemsWithQuantities);

                // Aggiorna il prezzo totale dell'ordine
                $order->update(['total_price' => $totalPrice]);
            }
        }
    }
}