<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Goods extends Model
{
    use HasFactory;
    /**
     * 検索を行う
     *
     * @param string $keyword 検索ワード
     * @param integer $per_page 1ページ当たりの表示数
     * @return Collection<Goods>
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

        $places = Goods::where($where);
        $places = $places->orderBy("created_at", "desc")->paginate($per_page);

        return $places;
    }
}
