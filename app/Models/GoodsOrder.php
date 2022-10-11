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
        'contact_info',
        'goods_price',
        'total_price',
        'status',
        'delivery_company',
        'delivery_number',
        'from_name',
        'from_postal_code',
        'from_pref_id',
        'from_city',
        'from_town',
        'from_building',
        'from_phone_number',
        'to_name',
        'to_postal_code',
        'to_pref_id',
        'to_city',
        'to_town',
        'to_building',
        'to_phone_number',
        'payment_id',
    ];


    public function goods()
    {
        return $this->belongsTo(Goods::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    public function sum_price()
    {
        $sum_price = $this->goods_price * $this->quantity;
        return $sum_price;
    }
}
