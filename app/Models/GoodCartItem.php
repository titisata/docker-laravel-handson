<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodCartItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'goods_id',
        'user_id' ,
        'quantity',
    ];

    public function goods()
    {
        return $this->belongsTo(Goods::class);
    }

    public function sum_price()
    {
        $goods = $this->goods;
        $sum_price = $goods->price * $this->quantity;
        return $sum_price;
    }
}
