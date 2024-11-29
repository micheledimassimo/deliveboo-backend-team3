<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Models

use App\Models\Order;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_name',
        'slug',
        'description',
        'price',
        'is_visible',
        'image',
        'restaurant_id'

    ];

    public function orders() {
        return $this->belongsToMany(Order::class)->withPivot('quantity');

    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public static function getUniqueSlug($item_name) {
        $originalSlug = str()->slug($item_name);

        $slug = $originalSlug;

        $existingMenuItem = MenuItem::where('slug', $slug)->first();

        $counter = 1;

        while($existingMenuItem != null) {
            $slug = $originalSlug.'-'.$counter;

            $existingMenuItem = MenuItem::where('slug', $slug)->first();

            $counter = $counter + 1;
        }

        return $slug;
    }
}
