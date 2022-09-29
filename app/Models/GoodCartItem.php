<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodCartItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'partner_id',
        'goods_id',
        'user_id' ,
        'quantity',
    ];

    public function goods()
    {
        return $this->belongsTo(Goods::class);
    }

    public function contact_info()
    {
        // $goods = $this->goods;
        // $folder = GoodsFolder::where('id',$goods->goods_folder_id)->first();
        // return $folder->name;

        $user = User::where('id',$this->partner_id)->first();
        $partner = Partner::where('user_id',$user->id)->first();
        return $partner->name;
    }

    public function sum_price()
    {
        $goods = $this->goods;
        $sum_price = $goods->price * $this->quantity;
        return $sum_price;
    }
}
