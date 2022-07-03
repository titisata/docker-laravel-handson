<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExperienceCartItem extends Model
{
    use HasFactory;

    public function experience()
    {
        return $this->belongsTo(Experience::class);
    }

    public function sum_price()
    {
        $ex = $this->experience;
        $price_adult = $ex->price_adult * $this->quantity_adult;
        $price_child = $ex->price_child * $this->quantity_child;
        return $price_adult + $price_child;
    }
}
