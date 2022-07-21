<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodsFolder extends Model
{
    use HasFactory;


    /**
     * グッズを取得
     *
     * @return Collection<Goods>
     */

    public function goods()
    {
        return $this->hasMany(Goods::class);
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
     * コメントを取得
     *
     * @return Collection<ExperienceComment>
     */

    public function comments()
    {
        $comments = GoodsComment::where([
            ['goods_folder_id', '=', $this->id],
        ])->orderBy('created_at', 'desc')->get();
        return $comments;
    }

    /**
     * 検索を行う
     *
     * @param string $keyword 検索ワード
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

        // ジャンルでの検索条件
        // if ($keyword != '') {
        //     $where[] = ['name', 'like', "%$keyword%"];
        // }

        $places = GoodsFolder::where($where);
        $places = $places->orderBy("created_at", "desc")->paginate($per_page);

        return $places;
    }
}
