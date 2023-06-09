<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodsFolder extends Model
{
    use HasFactory;


    protected $fillable= [
        'user_id',
        'name',
        'description',
        'caution',
        'detail',
        'phone',
        'category1',
        'category2',
        'category3',
        'recommend_flag',
        'recommend_sort_no',
        'average_rate',
        'price',
    ];

    /**
     * グッズを取得
     *
     * @return Collection<Goods>
     */

    public function goods()
    {
        return $this->hasMany(Goods::class);
    }

    public function active_goods()
    {
        return $this->hasMany(Goods::class)->where('status', '1');
    }

    /**
     * 画像を取得
     *
     * @return Collection<Image>
     */

    public function images()
    {
        $imgaes = Image::where([
            ['table_name', '=', 'goods_folders'],
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
     * ユーザーからパートナーを取得
     *
     * @return User
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * コメントを取得
     *
     * @return Collection<GoodsComment>
     */

    public function comments()
    {
        $comments = GoodsComment::where([
            ['goods_folder_id', '=', $this->id],
        ])->orderBy('created_at', 'desc')->get();
        return $comments;
    }

    /**
     * 全てのコメントを取得
     *
     * @return Collection<GoodsComment>
     */

    public function all_comments()
    {
        $all_comments = GoodsComment::where([
            ['goods_folder_id', '=', $this->id],
        ])->orderBy('created_at', 'desc')->get();
        return $all_comments;
    }

     /**
     * 自分のコメントを取得
     *
     * @return Collection<GoodsComment>
     */

    public function mycomment()
    {
        $mycomment = GoodsComment::where([
            ['goods_folder_id', '=', $this->id],
        ])->orderBy('created_at', 'desc')->first(['user_id']);
        return $mycomment;
    }

    /**
     * 検索を行う
     *
     * @param string $keyword 検索ワード
     * @param ?string $category カテゴリ
     * @param integer $per_page 1ページ当たりの表示数
     * @return Collection<GoodsFolder>
     */
    public static function search(string $keyword, int $per_page)
    {
        $where = [];

        // フリーワードでの検索条件
        if ($keyword != '') {
            $where[] = ['name', 'like', "%$keyword%"];
        }

        $places = GoodsFolder::where($where);
        $places = $places->orderBy("created_at", "desc")->paginate($per_page);

        return $places;
    }

    /**
     * カテゴリ検索を行う
     *
     * @param string $keyword 検索ワード
     * @param ?string $category カテゴリ
     * @param integer $per_page 1ページ当たりの表示数
     * @return Collection<GoodsFolder>
     */
    public static function category_search(string $category, int $per_page)
    {
        $where = [];

        // カテゴリによる検索条件
        if ($category) {
            $where[] = ['category1', '=', $category];
        }

        $places = GoodsFolder::where($where);
        $places = $places->orderBy("created_at", "desc")->paginate($per_page);

        return $places;
    }

     /**
     * 検索を行う
     *
     * @param string $keyword 検索ワード
     * @param ?string $category カテゴリ
     * @param integer $per_page 1ページ当たりの表示数
     * @return Collection<GoodsFolder>
     */
    public static function all_search(string $keyword, ?string $category, int $per_page)
    {
        $where = [];

        // フリーワードでの検索条件
        if ($keyword != '') {
            $where[] = ['name', 'like', "%$keyword%"];
        }

        // カテゴリによる検索条件
        if ($category) {
            $where[] = ['category1', '=', $category];
        }

        $places = GoodsFolder::where($where);
        $places = $places->orderBy("created_at", "desc")->paginate($per_page);

        return $places;
    }
}
