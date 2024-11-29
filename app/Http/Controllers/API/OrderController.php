<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{   
    public function index(Request $request)
    {
        // Recupera lo slug del ristorante dalla richiesta
        $restaurantSlug = $request->input('restaurant_slug');

        // Verifica se lo slug è stato fornito
        if (!$restaurantSlug) {
            return response()->json([
                'error' => 'Restaurant slug is required.',
            ], 400);
        }

        // Filtra gli ordini in base allo slug del ristorante
        $ordersWithRestaurants = Order::whereHas('menuItems.restaurant', function ($query) use ($restaurantSlug) {
            $query->where('slug', $restaurantSlug);
        })
        ->with(['menuItems.restaurant'])
        ->get()
        ->map(function ($order) {

            $totalPrice = $order->menuItems->reduce(function ($total, $menuItem) {
            $quantity = $menuItem->pivot->quantity ?? 1; // Quantità (default 1 se non specificata)
            $price = $menuItem->price ?? 0; // Prezzo (default 0 se non specificato)
            return $total + ($quantity * $price); // Somma al totale

            }, 0);
            return [
                'order_id' => $order->id,
                'total_price' => $totalPrice, // Prezzo totale
                'menu_items' => $order->menuItems->map(function ($menuItem) {
                    return [
                        'item_name' => $menuItem->item_name,
                        'quantity' => $menuItem->pivot->quantity ?? null, // Corretto accesso alla quantità
                        'restaurant_slug' => $menuItem->restaurant->slug ?? null, // Gestione null
                    ];
                }),
            ];
        });

        return response()->json($ordersWithRestaurants);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'restaurant_slug' => 'required|string',
            'customer.email' => 'required|email|max:255',
            'customer.address' => 'required|string|max:255',
            'customer.number' => 'required|string|min:10|max:15',
            'customer.name' => 'required|string|min:3|max:64',
            'total_price' => 'required|numeric|min:1',
            'items' => 'required|array',
            'items.*.id' => 'required|exists:menu_items,id', 
            'items.*.quantity' => 'required|integer|min:1', 
        ]);
        
        $order = Order::create([
            'restaurant_slug' => $data['restaurant_slug'],
            'customer_email' => $data['customer']['email'],
            'customer_address' => $data['customer']['address'],
            'customer_number' => $data['customer']['number'],
            'customer_name' => $data['customer']['name'],
            'total_price' => $data['total_price'],
        ]);

        foreach ($data['items'] as $item) {
            $order->menuItems()->attach($item['id'], ['quantity' => $item['quantity']]);
        }

        return response()->json([
            'success' => true,
            'data' => $order
        ]);
    }
}