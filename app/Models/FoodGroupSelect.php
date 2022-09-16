<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodGroupSelect extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'food_group_id',
        'experience_folder_id',
    ];

    /**
     * フードグループを取得
     *
     * @return FoodGroup
     */

    public function foodgroup()
    {
        return $this->belongsTo(FoodGroup::class);
        // return '1111';
    }
}
