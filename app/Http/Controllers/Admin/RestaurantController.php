<?php

namespace App\Http\Controllers\Admin;

use App\Models\Restaurant;
use App\Models\Typology;
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

        return view('admin.restaurants.show', compact('restaurant'));
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
            'user_id' => 'nullable|exists:user,id'
        ]);
    }
}
