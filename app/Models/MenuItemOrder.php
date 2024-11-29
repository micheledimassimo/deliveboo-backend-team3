<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItemOrder extends Model
{
    use HasFactory;

    protected $fillable = ['menu_item_id', 'quantity'];
}
