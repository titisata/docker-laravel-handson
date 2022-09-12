<?php

namespace App\Http\Controllers;

use App\Models\ExperienceCartItem;
use App\Models\ExperienceReserve;
use App\Models\GoodCartItem;
use App\Models\Goods;
use App\Models\GoodsOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $uid = Auth::user()->id;
        $experienceCartItems = ExperienceCartItem::where('user_id', $uid)->orderBy('updated_at')->get();
        $goodCartItems = GoodCartItem::where('user_id', $uid)->orderBy('updated_at')->get();
        $price = 0;
        foreach ($experienceCartItems as $experienceCartItem) {
            $price += $experienceCartItem->sum_price();
        }
        foreach ($goodCartItems as $goodCartItem) {
            $price += $goodCartItem->sum_price();
        }
        return view('cart.list', compact('experienceCartItems', 'goodCartItems', 'price'));
    }

    public function confirm()
    {
        $uid = Auth::user()->id;
        $experienceCartItems = ExperienceCartItem::where('user_id', $uid)->orderBy('updated_at')->get();
        $goodCartItems = GoodCartItem::where('user_id', $uid)->orderBy('updated_at')->get();
        $price = 0;
        foreach ($experienceCartItems as $experienceCartItem) {
            $price += $experienceCartItem->sum_price();
        }
        foreach ($goodCartItems as $goodCartItem) {
            $price += $goodCartItem->sum_price();
        }
        return view('cart.cofirm', compact('experienceCartItems', 'goodCartItems', 'price'));
    }

    public function purchase()
    {
        $uid = Auth::user()->id;
        $experienceCartItems = ExperienceCartItem::where('user_id', $uid)->orderBy('updated_at')->get();
        $goodCartItems = GoodCartItem::where('user_id', $uid)->orderBy('updated_at')->get();
        $price = 0;
        foreach ($experienceCartItems as $experienceCartItem) {
            $price += $experienceCartItem->sum_price();
        }
        foreach ($goodCartItems as $goodCartItem) {
            $price += $goodCartItem->sum_price();
        }
        return view('cart.purchase', compact('price'));
    }

    public function delete_experience(Request $request)
    {
        $uid = Auth::user()->id;
        $item_id = $request->id;
        // TODO: UIDの確認を入れる
        ExperienceCartItem::destroy($item_id);
        return response()->json(['message'=>'success']);
    }

    public function delete_goods(Request $request)
    {
        $uid = Auth::user()->id;
        $item_id = $request->id;
        // TODO: UIDの確認を入れる
        GoodCartItem::destroy($item_id);
        return response()->json(['message'=>'success']);
    }

    public function purchase_post(Request $request)
    {
        $uid = Auth::user()->id;
        $experienceCartItems = ExperienceCartItem::where('user_id', $uid)->orderBy('updated_at')->get();
        $goodCartItems = GoodCartItem::where('user_id', $uid)->orderBy('updated_at')->get();

        foreach ($experienceCartItems as $experienceCartItem) {
            ExperienceReserve::create([
                'user_id' => $uid,
                'experience_id' => $experienceCartItem->experience_id,
                'hotel_group_id' => $experienceCartItem->hotel_group_id,
                'food_group_id' => $experienceCartItem->food_group_id,
                'hotel_id' => null,
                'food_id' => null,
                'comment' => 'コメントはありません',
                'message' => $experienceCartItem->message,
                'status' => '対応待ち',
                'quantity_child' => $experienceCartItem->quantity_child,
                'quantity_adult' => $experienceCartItem->quantity_adult,
                'start_date' =>  $experienceCartItem->start_date,
                'end_date' =>  $experienceCartItem->end_date,
            ]);
        }
        foreach ($goodCartItems as $goodCartItem) {
            GoodsOrder::create([
                'goods_id' => $goodCartItem->goods_id,
                'user_id' => $uid,
                'quantity' => $goodCartItem->quantity,
            ]);
        }

        ExperienceCartItem::where('user_id', $uid)->delete();
        GoodCartItem::where('user_id', $uid)->delete();

        return view('cart.success');
    }
}
