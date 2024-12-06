<?php

namespace App\Http\Controllers\Admin;

use App\Models\MenuItem;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Helpers

use Illuminate\Support\Facades\Storage;

class MenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menuItems = MenuItem::get();

        return view('admin.menu_items.index', compact('menuItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.menu_items.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validateRequest($request);

        $data = $request->all();

        $data['slug'] = MenuItem::getUniqueSlug($data['item_name']);

        if (isset($data['image'])) {
            $menuItemImage = Storage::put('uploads', $data['image']);
            $data['image'] = $menuItemImage;
        }

        $restaurant = Restaurant::where('slug', $request->restaurant_slug)->firstOrFail();

        $data['restaurant_id'] = $restaurant->id;

        $menuItem = MenuItem::create($data);

        return redirect()->route('admin.restaurants.show', ['restaurant' => $restaurant->slug]);

    }

    /**
     * Display the specified resource.
     */
    public function show(MenuItem $menuItem)
    {
        return view('admin.menu_items.show', compact('menuItem'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MenuItem $menuItem)
    {
        return view('admin.menu_items.edit', compact('menuItem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MenuItem $menuItem)
    {

        $data = $this->validateRequest($request);

        $data = $request->all();

        $data['slug'] = MenuItem::getUniqueSlug($data['item_name']);

        if (isset($data['image'])) {
            if ($menuItem->image) {
                // ELIMINA L'IMMAGINE PRECEDENTE
                Storage::delete($menuItem->image);
                $menuItem->image = null;
            }

            $imagePath = Storage::put('uploads', $data['image']);
            $data['image'] = $imagePath;
        }
        else if (isset($data['remove_image']) && $menuItem->image) {
            // ELIMINA L'IMMAGINE PRECEDENTE
            Storage::delete($menuItem->image);
            $menuItem->image = null;
        }

        $data['is_visible'] = $request->has('is_visible') ? true : false;

        $restaurant = Restaurant::where('slug', $request->restaurant_slug)->firstOrFail();

        $data['restaurant_id'] = $restaurant->id;

        $menuItem->update($data);

        return redirect()->route('admin.restaurants.show', ['restaurant' => $restaurant->slug]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, MenuItem $menuItem)
    {

        if ($menuItem->image) {
            // ELIMINA L'IMMAGINE PRECEDENTE
            Storage::disk('public')->delete($menuItem->image);
        }

        $menuItem->delete();

        $restaurant = $menuItem->restaurant()->first();
        $data['restaurant_id'] = $restaurant->id;

        return redirect()->route('admin.restaurants.show', [$restaurant->slug]);
    }

    private function validateRequest($request){

        $request->validate([

            'item_name' => 'required|min:3|max:255',
            'description' => 'required|min:10|max:1024',
            'price'=> 'required|numeric|min:0.01|max:999',
            'is_visible' => 'nullable|boolean',
            'image' => 'nullable|image|max:1024',
            'restaurant_id' => 'nullable|exists:restaurants,id',
        ]);
    }
}
