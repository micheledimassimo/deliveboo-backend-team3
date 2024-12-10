<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Models

use App\Models\MenuItem;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_email',
        'customer_address',
        'customer_number',
        'customer_name',
        'total_price'
    ];

    public function menuItems() {
        return $this->belongsToMany(MenuItem::class)->withPivot('quantity');

    }
}


