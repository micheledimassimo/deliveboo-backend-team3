<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;

class OrderController extends Controller
{   

    public function index(){

    }

    public function store(Request $request) {
        $data = $request->validate([
            'customer_email' => 'required|email|max:255',
            'customer_address' => 'required|string|max:255',
            'customer_number' => 'required|string|min:10|max:15',
            'customer_name' => 'required|string|min:3|max:64',
            'total_price' => 'required|numeric|min:1',
        ]);
        $order = Order::create($data);
        
        return response()->json([
            'success' => true,
            'data' => $order
        ]);
    }
}
