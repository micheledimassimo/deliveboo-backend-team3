<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// models
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    public function index(Request $request){

        // $restaurants = Restaurant::get();

        // eager loading con with per portarsi dietro le categorie
        // paginazione per mostrarne 5 a pagina
        // Recupera il filtro dalle query parameters, se presente
        $typologyName= $request->query('typology_name');

        // Crea una query di base con il caricamento eager
        $query = Restaurant::with('typologies');

        // Se è stato specificato un filtro per la typology, aggiungilo alla query
        if ($typologyName) {
            $query->whereHas('typologies', function ($q) use ($typologyName) {
                $q->where('typology_name', $typologyName);
            });
        }
        $restaurants = $query->paginate(5);

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
