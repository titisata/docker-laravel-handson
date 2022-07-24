<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExperienceFolder extends Model
{
    use HasFactory;

    public $experinces = [];


    protected $fillable= [
        'average_rate',
    ];

    /**
     * 体験を取得
     *
     * @return Collection<Experience>
     */

    public function experiences()
    {
        return $this->hasMany(Experience::class);
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
     * パートナーを取得
     *
     * @return Partner
     */

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    /**
     * コメントを取得
     *
     * @return Collection<ExperienceComment>
     */

    public function comments()
    {
        $comments = ExperienceComment::where([
            ['experience_folder_id', '=', $this->id],
        ])->orderBy('created_at', 'desc')->get();
        return $comments;
    }

    /**
     * 全予約を取得
     *
     * @return Collection<ExperienceReserve>
     */

    public function reserves()
    {
        return $this->hasManyThrough(ExperienceReserve::class, Experience::class);
    }

    /**
     * 日程を取得
     *
     * @return Collection<Schedule>
     */

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
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
     * その日が休みかどうか
     *
     * @return bool
     */

    public function is_holiday(string $date)
    {
        $date = new DateTime($date);
        $where = [];

        if ($date != '') {
            $where[] = ['date', '=', $date];
            $where[] = ['is_holiday', '=', 1];
            $where[] = ['experience_folder_id', '=', $this->id];
        }

        $schedule = Schedule::where($where)->get();

        return count($schedule) > 0;
    }

    /**
     * 検索を行う
     *
     * @param string $date 検索日付
     * @param string $category カテゴリ
     * @param int $per_page 1ページ当たりの表示数
     * @return Collection<ExperienceFolder>
     */
    public static function search(string $date, string $category, int $per_page)
    {
        $date = new DateTime($date);
        $where = [];

        // フリーワードでの検索条件
        if ($date) {
            $where[] = ['start_date', '<', $date];
            $where[] = ['end_date', '>', $date];
        }

        // カテゴリによる検索条件
        if ($category) {
            $where[] = ['category1', '=', $category];
        }

        $experienceFolders = ExperienceFolder::where($where)->orderBy("created_at", "desc")->paginate($per_page);

        return $experienceFolders;
    }
}
