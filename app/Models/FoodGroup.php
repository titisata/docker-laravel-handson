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

    public function experiencefolder()
    {
        return $this->belongsToMany('App\Models\ExperienceFolder', 'hotel_group_selects', 'food_group_id', 'experience_folder_id');
    }
}
