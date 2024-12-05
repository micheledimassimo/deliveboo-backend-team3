<?php

namespace App\Http\Controllers\Admin;

use App\Models\Restaurant;
use App\Models\Typology;
use App\Models\Order;
use Illuminate\Http\Request;

// Helpers

use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $restaurants = Restaurant::get();
        return view('admin.restaurants.index', compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.restaurants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validateRequest($request);

        $data = $request->all();

        $data['slug'] = str()->slug($data['restaurant_name']);

        $restaurant = Restaurant::create($data);

        return redirect()->route('admin.restaurants.show', ['restaurant' => $restaurant->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $restaurant = Restaurant::with('menuItems')->where('slug', $slug)->firstOrFail();

        $this->authorize('view', $restaurant);

        $typologies = Typology::all();




        return view('admin.restaurants.show', compact('restaurant', 'typologies'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant)
    {

        $this->authorize('update', $restaurant);

        $typologies = Typology::all();

        return view('admin.restaurants.edit', compact('restaurant', 'typologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        $data = $this->validateRequest($request);

        $data = $request->all();

        $restaurantName = $data['restaurant_name'];

        $data['slug'] = Restaurant::getUniqueSlug($restaurantName);

        if (isset($data['typologies'])) {
            $restaurant->typologies()->sync($data['typologies']);
        }

        if (isset($data['img'])) {
            if ($restaurant->img) {
                // ELIMINA L'IMMAGINE PRECEDENTE
                Storage::delete($restaurant->img);
                $restaurant->img = null;
            }

            $restaurantImgPath = Storage::put('uploads', $data['img']);
            $data['img'] = $restaurantImgPath;
        }
        else if (isset($data['remove_img']) && $restaurant->img) {
            // ELIMINA L'IMMAGINE PRECEDENTE
            Storage::delete($restaurant->img);
            $restaurant->img = null;
        }

        $restaurant->update($data);

        return redirect()->route('admin.restaurants.show', ['restaurant' => $restaurant->slug]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        $this->authorize('delete', $restaurant);

        $restaurant->delete();

        return redirect()->route('admin.restaurants.index');
    }

    private function validateRequest($request){

        $request->validate([

            'restaurant_name' => 'required|min:3|max:128',
            'address' => 'required|min:3|max:128',
            'phone_number' => 'required|min:3|max:64|regex:/^[\d+\-() ]+$/',
            'img' => 'nullable|image|max:2048',
            'user_id' => 'nullable|exists:user,id',
            'typologies' => 'required|array|min:1|max:4',
            'typologies.*' => 'integer|exists:typologies,id',
        ]);
    }

    public function orders($slug)
    {

        $restaurant = Restaurant::with('menuItems')->where('slug', $slug)->firstOrFail();

        $this->authorize('view', $restaurant);

        $orders = Order::whereHas('menuItems', function ($query) use ($restaurant) {
            $query->where('restaurant_id', $restaurant->id);
        })->with(['menuItems' => function ($query) {
            $query->withPivot('quantity'); 
        }])->get();

        $orders = $orders->map(function ($order) {
            $totalPrice = $order->menuItems->reduce(function ($total, $menuItem) {
                $quantity = $menuItem->pivot->quantity ?? 1;
                $price = $menuItem->price ?? 0;

                return $total + ($quantity * $price);
            }, 0);

            return [
                'order_id' => $order->id,
                'total_price' => $totalPrice,
                'customer_email' => $order->customer_email ?? 'Non disponibile', 
                'customer_address' => $order->customer_address ?? 'Non disponibile', 
                'customer_number' => $order->customer_number ?? 'Non disponibile', 
                'customer_name' => $order->customer_name ?? 'Non disponibile', 
                'created_at' => $order->created_at,
                'menu_items' => $order->menuItems->map(function ($menuItem) {
                    return [
                        'item_name' => $menuItem->item_name,
                        'quantity' => $menuItem->pivot->quantity ?? 1, 
                    ];
                }),
            ];
        });

        $orders = $orders->sortByDesc('created_at');
        return view('admin.restaurants.orders', compact('restaurant', 'orders'));
}

    public function statistics($slug, Request $request)
    {
        $restaurant = Restaurant::where('slug', $slug)->firstOrFail();

        $selectedYear = $request->input('year', date('Y'));

        $menuItemIds = $restaurant->menuItems()->pluck('id');

        $ordersPerMonth = Order::join('menu_item_order', 'orders.id', '=', 'menu_item_order.order_id')
            ->whereIn('menu_item_order.menu_item_id', $menuItemIds)
            ->whereYear('orders.created_at', $selectedYear)
            ->selectRaw('MONTH(orders.created_at) as month, COUNT(DISTINCT orders.id) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $ordersData = array_fill(0, 12, 0);
        foreach ($ordersPerMonth as $order) {
            $ordersData[$order->month - 1] = $order->total;
        }

        $earningsPerMonth = Order::join('menu_item_order', 'orders.id', '=', 'menu_item_order.order_id')
            ->join('menu_items', 'menu_item_order.menu_item_id', '=', 'menu_items.id') // Unione con la tabella menu_items per ottenere il prezzo
            ->whereIn('menu_item_order.menu_item_id', $menuItemIds)
            ->whereYear('orders.created_at', $selectedYear)
            ->selectRaw('MONTH(orders.created_at) as month, SUM(menu_item_order.quantity * menu_items.price) as total') // Utilizza il prezzo dalla tabella menu_items
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $earningsData = array_fill(0, 12, 0);
        foreach ($earningsPerMonth as $earning) {
            $earningsData[$earning->month - 1] = $earning->total;
        }

        $years = Order::join('menu_item_order', 'orders.id', '=', 'menu_item_order.order_id')
            ->join('menu_items', 'menu_item_order.menu_item_id', '=', 'menu_items.id') 
            ->whereIn('menu_item_order.menu_item_id', $menuItemIds)
            ->selectRaw('YEAR(orders.created_at) as year')
            ->distinct()
            ->pluck('year');

        if ($request->ajax()) {
            return response()->json([
                'ordersData' => $ordersData,
                'earningsData' => $earningsData,
            ]);
        }
 
        return view('admin.restaurants.statistics', compact(
            'restaurant',
            'ordersData',
            'earningsData',
            'years',
            'selectedYear'
        ));
    }

}