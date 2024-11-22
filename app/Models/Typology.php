<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//Models
use App\Models\Restaurant;

class Typology extends Model
{
    use HasFactory;

    protected $fillable = [
        'restaurant_id',
    ];
    
    public function restaurants() {
        return $this->belongsToMany(Restaurant::class);
    }
}
