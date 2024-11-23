<?php

namespace App\Http\Controllers\Admin;

use App\Models\Restaurant;
use Illuminate\Http\Request;

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
    public function show($id)
    {   
        $restaurant = Restaurant::with('menuItems')->findOrFail($id);
        return view('admin.restaurants.show', compact('restaurant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant)
    {
        return view('admin.restaurants.edit', compact('restaurant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Restaurant $restaurant)
    {   
        $data = $this->validateRequest($request);

        $data = $request->all();

        $restaurant->update($data);

        return redirect()->route('admin.restaurants.show', ['restaurant' => $restaurant->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();

        return redirect()->route('admin.restaurants.index');
    }

    private function validateRequest($request){

        $request->validate([

            'restaurant_name' => 'required|min:3|max:128',
            'address' => 'required|min:3|max:128',
            'phone_number' => 'required|min:3|max:64',
            'img' => 'nullable|image|max:2048',
            'user_id' => 'nullable|exists:user,id'
        ]);
    }
}
