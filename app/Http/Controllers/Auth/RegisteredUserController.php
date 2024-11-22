<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;


//Models
use App\Models\User;
use App\Models\Restaurant;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first-name' => ['required', 'string','min:1', 'max:32'],
            'last-name' => ['required', 'string','min:1', 'max:32'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed','min:3', 'max:64', Rules\Password::defaults()],
            'p-iva' => ['required', 'string', 'min:11', 'max:11'],
            'restaurant-name' => ['required', 'string','min:1', 'max:128'],
            'address' => ['required', 'string','min:1', 'max:128'],
            'phone-number' => ['required', 'string','min:5', 'max:64'],
        ]);

        $data = $request->all();

        $user = User::create([
            'first_name' => $data['first-name'],
            'last_name' => $data['last-name'],
            'email' => $data['email'],
            'password'=> Hash::make($data['password']),
            'p_iva'=> $data['p-iva'],
            
        ]);

        $restarantName = $data['restaurant-name'];
        $restarantSlug = str()->slug($restarantName);
        $restaurant = Restaurant::create([
            'restaurant_name' => $data['restaurant-name'],
            'address' => $data['address'],
            'phone_number' => $data['phone-number'],
            'slug' => $restarantSlug,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
