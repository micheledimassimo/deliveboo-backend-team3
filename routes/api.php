<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// controllers
use App\Http\Controllers\API\RestaurantController;
use App\Http\Controllers\API\MenuItemController;
use App\Http\Controllers\API\TypologyController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\BraintreeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//

// per evitare conflitti con le rotte di web, aggiungo prefisso name

Route::name('api.')->group(function(){

    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });

    // Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurants.index');

    // Route::get('/restaurants/{slug}', [RestaurantController::class, 'show'])->name('restaurants.show');

    Route::resource('restaurants', RestaurantController::class)->only([
        'index',
        'show'
    ]);

    Route::resource('menuItems', MenuItemController::class)->only([
        'index',
        'show'
    ]);

    Route::resource('typologies', TypologyController::class)->only([
        'index',
        'show'
    ]);

    Route::resource('orders', OrderController::class)->only([
        'index',
        'show',
        'store'
    ]);

    Route::get('/braintree/token', [BraintreeController::class, 'generateToken']);
    Route::post('/braintree/checkout', [BraintreeController::class, 'processPayment']);
    
});
