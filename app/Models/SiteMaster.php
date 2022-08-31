<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteMaster extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'open_flag',
        'service',
        'shop_num',
        'regist_num',
        'recommend_limit',
        'comment',
        'main_image',
        'site_color',
        'sales_copy',
    ];

     /**
     * 画像を取得
     *
     * @return Collection<Image>
     */

    public function images()
    {
        $imgaes = Image::where([
            ['table_name', '=', 'site_masters'],
            ['table_id', '=', $this->id],
        ])->get();
        return $imgaes;
    }


   
}
