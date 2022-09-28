<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodsOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'partner_id',
        'goods_id',
        'user_id' ,
        'quantity',
        'goods_price',
        'total_price',
    ];


    public function goods()
    {
        return $this->belongsTo(Goods::class);
    }

    public function sum_price()
    {
        $sum_price = $this->goods_price * $this->quantity;
        return $sum_price;
    }
}
