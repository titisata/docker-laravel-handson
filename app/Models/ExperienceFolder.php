<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExperienceFolder extends Model
{
    use HasFactory;

    public $experinces = [];

    /**
     * 体験を取得
     *
     * @return Collection<Experience>
     */

    public function experiences()
    {
        return $this->hasMany('App\Models\Experience');
    }

    /**
     * 画像を取得
     *
     * @return Collection<Image>
     */

    public function images()
    {
        $imgaes = Image::where([
            ['table_name', '=', 'experience_folders'],
            ['table_id', '=', $this->id],
        ])->get();
        return $imgaes;
    }

    /**
     * FoodGroupを取得
     *
     * @return Collection<FoodGroup>
     */

    public function foodGroup()
    {
        return $this->hasMany(FoodGroup::class);
    }

    /**
     * HotelGroupを取得
     *
     * @return Collection<HotelGroup>
     */

    public function hotelGroup()
    {
        return $this->hasMany(HotelGroup::class);
    }
    /**
     * 検索を行う
     *
     * @param string $date 検索日付
     * @param int $per_page 1ページ当たりの表示数
     * @return Collection<ExperienceFolder>
     */
    public static function search(string $date, int $per_page)
    {
        // $where = [];

        // // フリーワードでの検索条件
        // if ($date != '') {
        //     $where[] = ['start_date', '>', $date];
        //     $where[] = ['end_date', '<', $date];
        // }

        $experinceFolders = ExperienceFolder::orderBy("created_at", "desc")->paginate($per_page);

        return $experinceFolders;
    }
}
