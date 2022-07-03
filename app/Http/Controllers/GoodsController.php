<?php

namespace App\Http\Controllers;

use App\Models\GoodCartItem;
use App\Models\Goods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $goods = Goods::find($id);
        if ($goods == null) {
            return abort(404);
        }
        return view('goods.detail', compact('goods'));
    }
}
