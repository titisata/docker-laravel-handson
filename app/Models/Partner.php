<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'catch_copy',
        'address',
        'phone',
        'description',
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
}
