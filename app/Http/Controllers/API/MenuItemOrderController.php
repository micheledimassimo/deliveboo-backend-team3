<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\MenuItemOrder; // Il modello per la tabella menu_item_order
use App\Models\MenuItem; 
use App\Models\Order;

class MenuItemOrderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'menu_items' => 'required|array',
            'menu_items.*.menu_item_id' => 'required|integer|exists:menu_items,id',
            'menu_items.*.quantity' => 'required|integer|min:1',
        ]);

        foreach ($data['menu_items'] as $menuItem) {
            MenuItemOrder::create([
                'menu_item_id' => $menuItem['menu_item_id'],
                'quantity' => $menuItem['quantity'],
            ]);
        }

        return response()->json(['message' => 'Ordine salvato con successo!'], 201);
    }
}
