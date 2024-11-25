<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Models

use App\Models\MenuItem;
use App\Models\Typology;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'restaurant_name',
        'address',
        'phone_number',
        'slug',
        'img',
        'user_id',
        'typology_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function menuItems() {
        return $this->hasMany(MenuItem::class);
    }

    public function typologies() {
        return $this->belongsToMany(Typology::class);
    }

    // Helper functions

    public static function getUniqueSlug($restaurant_name) {
        $originalSlug = str()->slug($restaurant_name);

        $slug = $originalSlug;

        $existingRestaurant = Restaurant::where('slug', $slug)->first();

        $counter = 1;

        while($existingRestaurant != null) {
            $slug = $originalSlug.'-'.$counter;

            $existingRestaurant = Restaurant::where('slug', $slug)->first();

            $counter = $counter + 1;
        }

        return $slug;
    }
}
