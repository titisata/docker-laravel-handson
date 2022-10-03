<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Goods extends Model
{
    use HasFactory;

    protected $fillable = [
        'goods_folder_id',
        'name',
        'price',
        'description',
        'sort_no',
        'quantity',
        'status',
        
    ];

    public function folder()
    {
        return $this->belongsTo(ExperienceFolder::class);
    }

    /**
     * 未対応のお土産を取得
     *
     * @return Collection<GoodsOrder>
     */

    public function goods_orders()
    {
        return $this->hasMany(GoodsOrder::class)->where('status', '=', '未対応');
    }

    /**
     * 対応済みのお土産を取得
     *
     * @return Collection<GoodsOrder>
     */

    public function goods_ordered()
    {
        return $this->hasMany(GoodsOrder::class)->where('status', '!=', '未対応');
    }
}
