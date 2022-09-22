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
        'user_id',
        'name',
        'price_adult',
        'price_child',
        'address',
        'description',
        'detail',
        'caution',
        'is_lodging',
        'is_before_lodging',
        'status',
        'recommend_flag',
        'category1',
    ];

    protected $dates = [
        'start_date',
        'end_date',
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

    //表示可能な体験をソート順に取得
    public function active_experiences()
    {
        return $this->hasMany(Experience::class)->where('status', '1')->orderBy('sort_no', 'asc');
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
     * お気に入りを取得
     *
     * @return Collection<Favorite>
     */

    public function favorite()
    {
        $favorites = Favorite::where([
            ['table_name', '=', 'experience_folders'],
            ['favorite_id', '=', $this->id],
        ])->first();
        return $favorites;
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
     * 自分のコメントを取得
     *
     * @return Collection<ExperienceComment>
     */

    public function mycomment()
    {
        $mycomment = ExperienceComment::where([
            ['experience_folder_id', '=', $this->id],
        ])->orderBy('created_at', 'desc')->first(['user_id']);
        return $mycomment;
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
     * HotelGroupを取得
     *
     * @return Collection<HotelGroup>
     */

    public function hotelgroups()
    {
        return $this->belongsToMany('App\Models\HotelGroup', 'hotel_group_selects', 'experience_folder_id', 'hotel_group_id');
    }

    /**
     * HotelGroupを取得
     *
     * @return Collection<FoodGroup>
     */

    public function foodgroups()
    {
        return $this->belongsToMany('App\Models\FoodGroup', 'food_group_selects', 'experience_folder_id', 'food_group_id');
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
     * @param ?string $category カテゴリ
     *
     * @param int $per_page 1ページ当たりの表示数
     * @return Collection<ExperienceFolder>
     */
    public static function search(string $date, ?string $category, int $per_page)
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

        // 宿泊あり・なしによる検索条件
        // if ($is_loding != "") {
        //     $where[] = ['is_lodging', '=', $is_lodging];
        // }

        $experienceFolders = ExperienceFolder::where($where)->orderBy("created_at", "desc")->paginate($per_page);

        return $experienceFolders;
    }
}
