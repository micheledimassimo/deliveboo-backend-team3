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

use function PHPUnit\Framework\isEmpty;

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
            // ci dava errore T.T AIUTO
            // 'regex:/qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNMèéòçà°ù§[]#¶-.,;:|\!"£$%&()=?^[^/]+*/'
            'restaurant-name' => ['required', 'string','min:1', 'max:128'],
            'address' => ['required', 'string','min:1', 'max:128'],
            'phone-number' => ['required', 'string','min:5', 'max:64'],
            'img' => ['nullable', 'image', 'max:2048']
        ]);

        $data = $request->all();

        
        if (isset($data['restaurant-name']) && isset($data['address']) && isset($data['phone-number']) ) {
            $user = User::create([
                'first_name' => $data['first-name'],
                'last_name' => $data['last-name'],
                'email' => $data['email'],
                'password'=> Hash::make($data['password']),
                'p_iva'=> $data['p-iva'],
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

        $restaurantName = $data['restaurant-name'];
        $restaurantSlug = Restaurant::getUniqueSlug($restaurantName);
        if (isset($data['first-name']) && isset($data['last-name']) && isset($data['email']) && isset($data['password']) && isset($data['p-iva'])) {
            $restaurant = Restaurant::create([
                'restaurant_name' => $data['restaurant-name'],
                'address' => $data['address'],
                'phone_number' => $data['phone-number'],
                'slug' => $restaurantSlug,
                'user_id' => $user->id,
                'img' => $data['img']
            ]);
        }

        
        if (in_array('Italiano', $data)) {
            $restaurant->typologies()->attach('1');
        }
        if (in_array('Cinese', $data)) {
            $restaurant->typologies()->attach('2');
        }
        if (in_array('Hamburgeria', $data)) {
            $restaurant->typologies()->attach('3');
        }
        if (in_array('Pizzeria', $data)) {
            $restaurant->typologies()->attach('4');
        }
        if (in_array('Sushi', $data)) {
            $restaurant->typologies()->attach('5');
        }
        if (in_array('Paninoteca', $data)) {
            $restaurant->typologies()->attach('6');
        }
        if (in_array('Kebab', $data)) {
            $restaurant->typologies()->attach('7');
        }
        if (in_array('Messicano', $data)) {
            $restaurant->typologies()->attach('8');
        }
        if (in_array('Ramen', $data)) {
            $restaurant->typologies()->attach('9');
        }
        if (in_array('Pasticceria', $data)) {
            $restaurant->typologies()->attach('10');
        }
        if (in_array('Gelateria', $data)) {
            $restaurant->typologies()->attach('11');
        }
        if (in_array('Pub', $data)) {
            $restaurant->typologies()->attach('12');
        }
        if (in_array('Carne', $data)) {
            $restaurant->typologies()->attach('13');
        }
        if (in_array('Pesce', $data)) {
            $restaurant->typologies()->attach('14');
        }
        if (in_array('Pasta', $data)) {
            $restaurant->typologies()->attach('15');
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('admin.restaurants.show', $restaurant->slug);
    }
}
