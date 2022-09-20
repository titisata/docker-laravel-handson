<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Food;

class FoodSelect extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'food_group_id',
        'food_id',
    ];

    /**
     * フードを取得
     *
     * @return Food
     */

    public function food()
    {
        return $this->belongsTo(Food::class);
        // return '1111';
    }
}
