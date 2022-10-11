<?php

namespace App\Http\Controllers;

use App\Models\GoodCartItem;
use App\Models\Goods;
use App\Models\GoodsCategory;
use App\Models\GoodsFolder;
use Illuminate\Http\Request;
use App\Http\Requests\GoodsRequest;
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
        
        if ($keyword == '' && GoodsCategory::where('name', $category)->first() == '') {

            $i=0;
            $goods_folders = array();
            foreach( $categories as $category){
                //カテゴリ別に配列に入れる
                $goods_folders[$i] = GoodsFolder::where('recommend_flag', 1)->where('category1', $category->name )->where('status', 1)->orderBy('recommend_sort_no', 'asc')->get();
                $i++;
            }
            
            $images = Image::where('table_name', 'goods_category')->get();
            return view('search.goods', compact('goods_folders', 'categories', 'images'));
            
        }elseif( GoodsCategory::where('name', $category)->first() == ''){   

            $categories = GoodsCategory::all();
            $goods_folders = GoodsFolder::search($keyword, per_page: 10);
            $category = 'カテゴリー選択なし';
            $images = Image::where('table_name', 'goods_category')->get();

            return view('search.goods_list', compact('goods_folders', 'categories', 'keyword', 'category', 'images'));

        }elseif( $keyword == ''){   

            $categories = GoodsCategory::all();
            $goods_folders = GoodsFolder::category_search($category, per_page: 10);
            $keyword = 'キーワード指定なし';
            $img_category = GoodsCategory::where('name', $category)->first();
            $images = Image::where('table_name', 'goods_category')->where('table_id', $img_category->id)->get();
           
            return view('search.goods_list', compact('goods_folders', 'categories', 'keyword', 'category', 'images'));

        }else{
            
            $categories = GoodsCategory::all();
            $img_category = GoodsCategory::where('name', $category)->first();
            $images = Image::where('table_name', 'goods_category')->where('table_id', $img_category->id)->get();
            $goods_folders = GoodsFolder::all_search($keyword, $category, per_page: 10);
            return view('search.goods_list', compact('goods_folders', 'categories', 'images', 'keyword', 'category'));

        }

    }

    public function post(GoodsRequest $request)
    {

        if( Auth::user()==null){
            return view('auth.login');
        }
        $uid = Auth::user()->id;
        $partner_id = $request->user_id;
        $item_count = $request->item_count; 
        $result = $request->result;

        for ($i = 0; $i < $item_count; $i++){
            $goods_id = $request->goods_id[$i];
            $quantity = $request->quantity[$i];

            if($quantity==0){
                continue;
            }

            // TODO: 不正なGoods IDの場合の処理
            Goods::where('id', $goods_id)->decrement('quantity',$quantity);
            
            GoodCartItem::create([
                'partner_id' => $partner_id,
                'goods_id' => $goods_id,
                'user_id' => $uid,
                'quantity' => $quantity,
            ]);
        }
        
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
