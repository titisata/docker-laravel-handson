<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;
    protected $table = 'foods';

    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * food_selectを取得
     *
     * @return Collection<FoodSelect>
     */

    public function foodselcts()
    {
        return $this->hasMany(FoodSelect::class);
    }

}
