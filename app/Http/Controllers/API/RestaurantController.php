<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// models
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    public function index(){

        // $restaurants = Restaurant::get();

        // eager loading con with per portarsi dietro le categorie
        // paginazione per mostrarne 5 a pagina
        $restaurants = Restaurant::with('typologies')->paginate(5);

        return response()->json([
            'success' => true,
            'code' => 200,
            'data' => [
                'restaurants' => $restaurants
            ]
        ]);
    }
}
