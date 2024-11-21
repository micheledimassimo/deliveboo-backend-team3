<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
