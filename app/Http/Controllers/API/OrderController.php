<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

//Helpers
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

//Mailables
use App\Mail\NewContact;
use App\Mail\NewOrder;

//Models
use App\Models\Restaurant;
class OrderController extends Controller
{   
    public function index(Request $request)
    {
        $restaurantSlug = $request->input('restaurant_slug');

        if (!$restaurantSlug) {
            return response()->json([
                'error' => 'Restaurant slug is required.',
            ], 400);
        }

        $ordersWithRestaurants = Order::whereHas('menuItems.restaurant', function ($query) use ($restaurantSlug) {
            $query->where('slug', $restaurantSlug);
        })
        ->with(['menuItems.restaurant'])
        ->get()
        ->map(function ($order) {

            $totalPrice = $order->menuItems->reduce(function ($total, $menuItem) {
            $quantity = $menuItem->pivot->quantity ?? 1; 
            $price = $menuItem->price ?? 0; 
            return $total + ($quantity * $price); 

            }, 0);
            return [
                'order_id' => $order->id,
                'total_price' => $totalPrice, 
                'menu_items' => $order->menuItems->map(function ($menuItem) {
                    return [
                        'item_name' => $menuItem->item_name,
                        'quantity' => $menuItem->pivot->quantity ?? null, 
                        'restaurant_slug' => $menuItem->restaurant->slug ?? null, 
                    ];
                }),
            ];
        });

        return response()->json($ordersWithRestaurants);
    }

    public function store(Request $request)
{
    $data = $request->validate([
        'restaurant_slug' => 'required|string',
        'customer.email' => 'required|email|max:255',
        'customer.address' => 'required|string|max:255',
        'customer.number' => 'required|string|min:10|max:18',
        'customer.name' => 'required|string|min:3|max:64',
        'total_price' => 'required|numeric|min:1',
        'items' => 'required|array',
        'items.*.id' => 'required|exists:menu_items,id',
        'items.*.quantity' => 'required|integer|min:1',
    ]);

    $restaurant = Restaurant::where('slug', $data['restaurant_slug'])->with('user')->first();

    if (!$restaurant) {
        return response()->json(['error' => 'Restaurant not found.'], 404);
    }

    $restaurantUserEmail = $restaurant->user->email ?? null;

    if (!$restaurantUserEmail) {
        return response()->json(['error' => 'Restaurant owner email not found.'], 404);
    }

    $order = Order::create([
        'restaurant_slug' => $data['restaurant_slug'],
        'customer_email' => $data['customer']['email'],
        'customer_address' => $data['customer']['address'],
        'customer_number' => $data['customer']['number'],
        'customer_name' => $data['customer']['name'],
        'total_price' => $data['total_price'],
    ]);

    $customerMail = $data['customer']['email'];
    Mail::to($customerMail)->send(new NewContact());

    Mail::to($restaurantUserEmail)->send(new NewOrder());

    foreach ($data['items'] as $item) {
        $order->menuItems()->attach($item['id'], ['quantity' => $item['quantity']]);
    }

    return response()->json([
        'success' => true,
        'data' => $order,
        'restaurant_user_email' => $restaurantUserEmail, 
    ]);
}


}

