<?php

namespace App\Http\Controllers;

use App\Models\GoodCartItem;
use App\Models\Goods;
use App\Models\GoodsFolder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoodsController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        if ($keyword == '') {
            $food_goods_folders = GoodsFolder::where('recommend_flag', 1)->where('category1', 'food')->orderBy('recommend_sort_no', 'desc')->get();
            $drink_goods_folders = GoodsFolder::where('recommend_flag', 1)->where('category1', 'drink')->orderBy('recommend_sort_no', 'desc')->get();
            $goods_goods_folders = GoodsFolder::where('recommend_flag', 1)->where('category1', 'goods')->orderBy('recommend_sort_no', 'desc')->get();
            return view('search.goods', compact('food_goods_folders', 'drink_goods_folders', 'goods_goods_folders'));
        }

        $goods = GoodsFolder::search($keyword, per_page: 10);
        return view('search.goods_list', compact('goods_folders'));
    }

    public function post(Request $request)
    {
        $id = $request->id;
        $uid = Auth::user()->id;
        $quantity = $request->quantity;

        // TODO: 不正なGoods IDの場合の処理
        GoodCartItem::create([
            'goods_id' => $id,
            'user_id' => $uid,
            'quantity' => $quantity,
        ]);
        return view('goods.cart_success');
    }

    public function show(string $id)
    {
        $goods_folder = GoodsFolder::find($id);
        if ($goods_folder == null) {
            return abort(404);
        }
        $comments = $goods_folder->comments();
        return view('goods.detail', compact('goods_folder', 'comments'));
    }
}
