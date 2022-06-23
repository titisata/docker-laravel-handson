<?php

namespace App\Http\Controllers;

use App\Models\Goods;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        if ($keyword == '') {
            return view('search.goods');
        }

        $goods = Goods::search($keyword, per_page: 10);
        return view('search.goods_list', compact('goods'));
    }
}
