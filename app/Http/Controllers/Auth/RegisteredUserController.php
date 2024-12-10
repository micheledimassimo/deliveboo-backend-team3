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

use Illuminate\Support\Facades\Storage;


//Models
use App\Models\User;
use App\Models\Restaurant;
use App\Models\Typology;

use function PHPUnit\Framework\isEmpty;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {   
        $typologies = Typology::all();

        return view('auth.register', compact('typologies'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => ['required', 'string','min:3', 'max:32'],
            'last_name' => ['required', 'string','min:3', 'max:32'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed','min:8', 'max:64', Rules\Password::defaults()],
            'p_iva' => ['required', 'string', 'min:11', 'max:11', 'regex:/^\d{11}$/'],
            'restaurant_name' => ['required', 'string','min:2', 'max:128'],
            'address' => ['required', 'string','min:5', 'max:128'],
            'phone_number' => ['required', 'string','min:5', 'max:64', 'regex:/^[\d+\-() ]+$/'],
            'img' => ['nullable', 'image', 'max:2048'],
            'typologies' => 'required|array|min:1|max:4', 
            'typologies.*' => 'integer|exists:typologies,id', 
        ]);

        $data = $request->all();
        
        if (isset($data['restaurant_name']) && isset($data['address']) && isset($data['phone_number']) ) {
            $user = User::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'password'=> Hash::make($data['password']),
                'p_iva'=> $data['p_iva'],
            ]);
        }

        if (isset($data['img'])) {
            $imgPath = Storage::put('uploads', $data['img']);
            $data['img'] = $imgPath;
        }
        else{

            $imgPath = null;
            $data['img'] = $imgPath;
        }

        $restaurantName = $data['restaurant_name'];
        $restaurantSlug = Restaurant::getUniqueSlug($restaurantName);
        if (isset($data['first_name']) && isset($data['last_name']) && isset($data['email']) && isset($data['password']) && isset($data['p_iva'])) {
            $restaurant = Restaurant::create([
                'restaurant_name' => $data['restaurant_name'],
                'address' => $data['address'],
                'phone_number' => $data['phone_number'],
                'slug' => $restaurantSlug,
                'user_id' => $user->id,
                'img' => $data['img']
            ]);
        }
        
        if (isset($data['typologies']) && is_array($data['typologies'])) {
            $typologies = Typology::whereIn('id', $data['typologies'])->get();
        
            $restaurant->typologies()->attach($typologies->pluck('id')->toArray());
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('admin.restaurants.show', $restaurant->slug);
    }
}
