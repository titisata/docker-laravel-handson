<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'reserve_flag',
        'service',
        'regist_num',
        'main_image',
        'catch_copy',
        'address',
        'phone',
        'description',
        'background_color',
        'access',
    ];

    /**
     * 画像を取得
     *
     * @return Collection<Image>
     */

    public function images()
    {
        $imgaes = Image::where([
            ['table_name', '=', 'partners'],
            ['table_id', '=', $this->id],
        ])->get();
        return $imgaes;
    }

    /**
     * 体験を取得
     *
     * @return Collection<ExperienceFolder>
     */

    public function experiences()
    {
        return $this->hasMany(ExperienceFolder::class);
    }

    /**
     * グッズを取得
     *
     * @return Collection<GoodsFolder>
     */

    public function goods()
    {
        return $this->hasMany(GoodsFolder::class);
    }
}
