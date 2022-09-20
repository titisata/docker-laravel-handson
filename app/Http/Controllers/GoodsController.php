<?php

namespace App\Http\Controllers;

use App\Models\GoodCartItem;
use App\Models\Goods;
use App\Models\GoodsCategory;
use App\Models\GoodsFolder;
use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;

class GoodsController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $category = $request->category;
        $categories = GoodsCategory::all();
        $images = Image::where('table_name', 'goods_category')->get();
        
        if ($keyword == '') {
            $food_goods_folders = GoodsFolder::where('recommend_flag', 1)->where('category1', '食べ物')->where('status', 1)->orderBy('recommend_sort_no', 'desc')->get();
            $drink_goods_folders = GoodsFolder::where('recommend_flag', 1)->where('category1', '飲み物')->where('status', 1)->orderBy('recommend_sort_no', 'desc')->get();
            $goods_goods_folders = GoodsFolder::where('recommend_flag', 1)->where('category1', '雑貨')->where('status', 1)->orderBy('recommend_sort_no', 'desc')->get();
            $images = Image::where('table_name', 'goods_category')->get();
            return view('search.goods', compact('food_goods_folders', 'drink_goods_folders', 'goods_goods_folders', 'categories', 'images'));
        }else{
            $categories = GoodsCategory::all();
            $img_category = GoodsCategory::where('name', $category)->first();
            $images = Image::where('table_name', 'goods_category')->where('table_id', $img_category->id)->first();
            $goods_folders = GoodsFolder::search($keyword, $category, per_page: 10);
            return view('search.goods_list', compact('goods_folders', 'categories', 'images'));

        }

    }

    public function post(Request $request)
    {

        if( Auth::user()==null){
            return view('auth.login');
        }
        
        
        $goods_id = $request->goods_id;
        $uid = Auth::user()->id;
        $quantity = $request->quantity;

        // TODO: 不正なGoods IDの場合の処理
        GoodCartItem::create([
            'goods_id' => $goods_id,
            'user_id' => $uid,
            'quantity' => $quantity,
        ]);

        return view('goods.cart_success');
    }

    public function show(string $id)
    {
        $user = Auth::user();
        $goods_folder = GoodsFolder::find($id);
        if ($goods_folder == null) {
            return abort(404);
        }
        $comments = $goods_folder->comments();
        $mycomment = $goods_folder->mycomment();
        return view('goods.detail', compact('user', 'goods_folder', 'comments', 'mycomment'));
    }
}
