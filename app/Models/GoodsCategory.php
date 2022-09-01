<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodsCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * 画像を取得
     *
     * @return Collection<Image>
     */

    public function images()
    {
        $imgaes = Image::where([
            ['table_name', '=', 'goods_category'],
            ['table_id', '=', $this->id],
        ])->get();
        return $imgaes;
    }
   
}
