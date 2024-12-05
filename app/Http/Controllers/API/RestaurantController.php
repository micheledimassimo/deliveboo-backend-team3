<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// models
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    public function index(Request $request){
        $typologyNames= $request->query('typology_name');

        $typologyNames = $typologyNames ? explode(',', $typologyNames) : [];

        $query = Restaurant::with('typologies');

        if (!empty($typologyNames)) {
            foreach ($typologyNames as $typologyName) {
                $query->whereHas('typologies', function ($q) use ($typologyName) {
                    $q->where('typology_name', $typologyName);
                });
            }
        }
        $restaurants = $query->paginate(8);

        return response()->json([
            'success' => true,
            'code' => 200,
            'data' => [
                'restaurants' => $restaurants
            ]
        ]);
    }

    public function show(string $slug){
        $restaurant = Restaurant::with('typologies', 'menuItems')->where('slug', $slug)->first();

        if($restaurant){
            return response()->json([
                'success' => true,
                'code' => 200,
                'data' => [
                    'restaurant' => $restaurant
                ]
            ]);
        }
        else{
            return response()->json([
                'success' => false,
                'code' => 404,
                'message' => 'Ristorante non trovato'
            ]);
        }

    }
}
