<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price_adult',
        'price_child',
    ];
}
