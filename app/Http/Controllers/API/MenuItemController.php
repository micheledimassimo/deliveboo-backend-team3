<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// models
use App\Models\MenuItem;

class MenuItemController extends Controller
{
    public function index(){

        // paginazione per mostrarne 5 a pagina
        $menuItems = MenuItem::paginate(5);

        return response()->json([
            'success' => true,
            'code' => 200,
            'menuItems' => $menuItems
        ]);
    }

    public function show(string $slug){
        $menuItem = MenuItem::where('slug', $slug)->first();

        if($menuItem){
            return response()->json([
                'success' => true,
                'code' => 200,
                'menuItem' => $menuItem
            ]);
        }
        else{
            return response()->json([
                'success' => false,
                'code' => 404,
                'message' => 'MenuItem non trovato'
            ]);
        }
    }
}
